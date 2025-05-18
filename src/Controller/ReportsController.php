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
    // public function index()
    // {
    //     parent::setQuery(['Users'], true);
    //     parent::setPaginationOrder('created', 'desc');
    //     parent::index();
    //     $this->set('title', 'My Reports');
    // }

    public function index()
    {
        $this->Crud->setQuery(['Users']);
        $entities = $this->Crud->index();
        parent::setPaginationConfig(['field' => 'created', 'direction' => 'desc'], '10');
        $entities = $this->paginate($entities);
        // parent::setPaginationOrder('created', 'desc');


        $this->set(['title' => 'Admin: Reports', 'entities' => $entities]);

    }

    // public function indexAdmin()
    // {
    //     parent::setQuery(['Users'], false);
    //     parent::setPaginationOrder('created', 'desc');
    //     // parent::index();
    //     $this->set('title', 'Admin: Reports');
    // }
    
    /**
     * View method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // parent::view($id);

        // User zu Report finden
        $user = $this->users_table->find('all')
            ->where(['id' => parent::getEntity() ->user_id]);
        $user = $this->paginate($user);
        $this->set(compact('user'));

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $users = $this->fetchTable('Users')->find('all');
        // CrudComponent aufrufrufen
        $newEntity = $this->Crud->add([]);

        if ($this->request->is('post')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('newEntity', 'users'));

        // $this->set(compact('newEntity'));

// #################################################################
        // $users = parent::getOtherEntitiesSelectQuery('Users');
        // $name = $this->name;
        // $requ = $this->request;

        // $newEntity = $this->Crud->add($this->name, $this->request);

        // if ($this->request->is('post')) {
        //     return $this->redirect(['action' => 'index']);
        // }
        // $this->set(compact('newEntity', 'users'));

        // $users = parent::getOtherEntitiesSelectQuery('Users');

        // parent::add();

        // if ($this->request->is('post')) {
        //     return $this->redirect(['action' => 'index']);
        // } 
        // $this->set(compact('users' ));

// #################################################################


        // $users = parent::getOtherEntitiesSelectQuery('Users');
        // if ($this->request->is('post')) {
        //     parent::add();

        //     if ($this->identity->get('role') === 'admin') {
        //         return $this->redirect(['action' => 'indexAdmin']);
        //     } else {
        //         return $this->redirect(['action' => 'index']);
        //     }
        // }
        // $this->set(compact('users' ));


        // #######################################################
        // // $report = parent::getTable()->newEmptyEntity();
        // // $report = $this->reports_table->newEmptyEntity();
        // if ($this->request->is('post')) {
        //     $requestData = $this->request->getData();
        //     $report = $this->Reports->patchEntity($report, $this->request->getData());
        //     if ($this->Reports->save($report)) {
        //         $this->Flash->success(__('The report has been saved.'));

        //         if ($this->identity->get('role') === 'admin') {
        //             return $this->redirect(['action' => 'indexAdmin']);
        //         } else {
        //             return $this->redirect(['action' => 'index']);
        //         }
        //         //return $this->redirect(['action' => 'index']);
        //     }
        //     $this->Flash->error(__('The report could not be saved. Please, try again.'));
        // }
        // $users = $this->all_users;
        // $this->set(compact('report' , 'users' ));
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
        $report = $this->reports_table->get($id, contain: ['Users']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            debug($this->request->getData());
            $report = $this->reports_table->patchEntity($report, $this->request->getData());
            if ($this->reports_table->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'view', $report->id]);
            }
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
        }
        $users = $this->all_users;
        $this->set(compact('report', 'users'));
    }

    // public function edit($id = null)
    // {
    //     $user = $this->users_table->get($id, contain: ['Reports']);
    //     // $user = $this->users_table->find()->contain(['Reports'])->where(['id' => $id])->first();

    //     // $this->viewBuilder()->setOption('serialize', [$table_alias, 'tableAlias']);
    //     if ($this->getRequest()->is(['patch', 'post', 'put'])) {

    //         $user = $this->users_table->patchEntity($user, $this->request->getData());
    //         if ($this->users_table->save($user)) {
    //             $this->Flash->success(__d('cake_d_c/users', 'The user has been saved'));

    //             //return $this->redirect([$this->referer()]);
    //         } else {
    //             $this->Flash->error(__d('cake_d_c/users', 'The user could not be saved'));
    //         }
    //     }
    //     $this->set(compact('user'));
    // }

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
        $report = $this->Reports->get($id);
        if ($this->Reports->delete($report)) {
            $this->Flash->success(__('The report has been deleted.'));
        } else {
            $this->Flash->error(__('The report could not be deleted. Please, try again.'));
        }
        
        if(str_contains($this->referer(), '/reports/view/') || str_contains($this->referer(), '/reports/edit/')) {
            if ($this->identity->get('role') === 'admin') {
                return $this->redirect(['action' => 'indexAdmin']);
            } else {
                return $this->redirect(['action' => 'index']);
            }
        }
        return $this->redirect(url: $this->referer());
    }

}