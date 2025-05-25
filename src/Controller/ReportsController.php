<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;


/**
 * Reports Controller
 *
 * //@property \App\Model\Table\ReportsTable $Reports
 */
class ReportsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
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

        $entities->selectAlso([
            'xml_length' => $entities->func()->length(['xml' => 'identifier']),
        ]);

        parent::setPaginationConfig(['field' => 'created', 'direction' => 'desc']);
        $entities = $this->paginate($entities);

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
    
    public function viewSample($id = null) 
    {
        $this->Crud->setQuery();
        $entity = $this->Crud->view($id); //42
        $this->set(['entity' => $entity]);
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
        $type = $this->getRequest()->getQuery('type');
        $users = $this->fetchTable('Users')->find('all');
        // CrudComponent aufrufrufen
        $newEntity = $this->Crud->add([]);

        if($this->getRequest()->getQuery('referer')) {
            list($controller, $action) = explode('.', $this->getRequest()->getQuery('referer'));
        }

        if ($this->getRequest()->is('post')) {
            if  (!empty($controller) && !empty($action)) {
                return $this->redirect(['controller' => $controller, 'action' => $action]);
            } else {
                return $this->redirect(['action' => 'index']);
            }
            
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
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            return $this->redirect(['action' => 'view', $id]);
        }
        // $report = $this->reports_table->get($id, contain: ['Users']);
        // if ($this->getRequest()->is(['patch', 'post', 'put'])) {
        //     // debug($this->getRequest()->getData());
        //     $report = $this->reports_table->patchEntity($report, $this->getRequest()->getData());
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
        $this->getRequest()->allowMethod(['post', 'delete']);
        $this->Crud->delete($id);

        return $this->redirect(url: $this->referer());
    }

}