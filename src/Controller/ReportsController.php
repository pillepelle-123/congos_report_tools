<?php
declare(strict_types=1);

namespace App\Controller;

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
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // $query = $this->Reports->find()
        //     ->contain(['Users']);
        // if ($this->identity->get('role') === 'admin') { 
        //     $query->where(['user_id IS NOT' => null]);
        // } else {
        //     $query->where(['user_id' => $this->identity->get('id')]);
        // }

        $reports = $this->paginate($this->all_reports);

        $this->set(compact('reports'));
        $this->set('title', 'Reports');
    }

    
    public function listAdmin() {
        $reports = $this->paginate($this->all_reports);

        $this->set(compact('reports'));
        $this->set('title', 'Admin: Reports');
    }

    public function listUser() {
        // $reports = $this->my_reports;
        // debug($reports);
        // die();
        $this->set('title', 'My Reports');

        $reports = $this->paginate($this->my_reports);

        $this->set([
            'entities' => $reports,
            'users' => $this->all_users,
        ]);
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
        parent::view($id);
        $report = $this->reports_table->get($id, [
        'contain' => ['Users']
        ]);


        $user = $this->users_table->find('all')
            ->where(['id' => $report->user_id]);

        // Übergeben von Related Entities als PaginatedResultSet 
        $user = $this->paginate($user);
        $this->set([
            'entity' => $report,
            'user' => $user,
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $report = $this->reports_table->newEmptyEntity();
        if ($this->request->is('post')) {
            $requestData = $this->request->getData();
            $report = $this->Reports->patchEntity($report, $this->request->getData());
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                if ($this->identity->get('role') === 'admin') {
                    return $this->redirect(['action' => 'listAdmin']);
                } else {
                    return $this->redirect(['action' => 'listUser']);
                }
                //return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
        }
        $users = $this->all_users;
        $this->set(compact('report' , 'users' ));
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
            $report = $this->reports_table->patchEntity($report, $this->request->getData());
            if ($this->reports_table->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect($this->referer());
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
                return $this->redirect(['action' => 'listAdmin']);
            } else {
                return $this->redirect(['action' => 'listUser']);
            }
        }
        return $this->redirect(url: $this->referer());
    }

}