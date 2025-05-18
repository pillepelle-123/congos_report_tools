<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;


/**
 * Reports Controller
 *
 * //@property \App\Model\Table\ReportsTable $Reports
 * @property \Cake\ORM\Table $ReportsTable
 */
class ReportsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->ReportsTable = $this->fetchTable('Reports');

        $this->loadComponent('Crud');

    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Crud->setQuery(true, ['Users']);
        $entities = $this->Crud->index();
        parent::setPaginationConfig(['field' => 'created', 'direction' => 'desc']);
        $entities = $this->paginate($entities);
        // parent::setPaginationOrder('created', 'desc');

        $this->set(['title' => 'My Reports', 'entities' => $entities]);

    }

    public function indexAdmin()
    {
        $this->Crud->setQuery(false, ['Users']);
        $entities = $this->Crud->index();
        parent::setPaginationConfig(['field' => 'created', 'direction' => 'desc']);
        $entities = $this->paginate($entities);
        // parent::setPaginationOrder('created', 'desc');

        $this->set(['title' => 'Admin: Reports', 'entities' => $entities]);
    }
    
    /**
     * View method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // CrudComponent Funktionen aufrufrufen
        $this->Crud->setQuery();
        $entity = $this->Crud->view($id);
        

        $user = $this->fetchTable('Users')->find('all')
            ->where(['id' => $entity->user_id]);
        $this->paginate = array(
            'order' => array( 
            'created' => 'desc'
            )
        );
        $user = $this->paginate($user);

        $this->set([
            'entity' => $entity,
            'user' => $user,
        ]);

        // $user = $this->users_table->find('all')
        //     ->where(['id' => $id]);
        // $user = $this->paginate($user);
        // $this->set(compact('user'));

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // $type = $this->request->getParam('type');
        $type = $this->request->getQuery('type');
        $users = $this->fetchTable('Users')->find('all');
        // CrudComponent aufrufrufen
        $newEntity = $this->Crud->add([]);

        if ($this->request->is('post')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('newEntity', 'users', 'type'));

    }

    /**
     * Edit method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Crud->setQuery();
        $entity = $this->Crud->edit($id);
        $users = $this->fetchTable('Users')->find('all');

        $this->set(compact('entity', 'users'));


        // $report = $this->reports_table->get($id, contain: ['Users']);
        // if ($this->request->is(['patch', 'post', 'put'])) {
        //     // debug($this->request->getData());
        //     $report = $this->reports_table->patchEntity($report, $this->request->getData());
        //     if ($this->reports_table->save($report)) {
        //         $this->Flash->success(__('The report has been saved.'));

        //         return $this->redirect(['action' => 'view', $report->id]);
        //     }
        //     $this->Flash->error(__('The report could not be saved. Please, try again.'));
        // }
        // $users = $this->all_users;
        // $this->set(compact('report', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->Crud->delete($id);

        return $this->redirect(url: $this->referer());
    }

}