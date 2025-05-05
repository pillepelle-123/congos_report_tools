<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 */
class ReportsController extends AppController
{
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
        $reports = $this->paginate($this->my_reports);

        $this->set(compact('reports'));
        $this->set('title', 'My Reports');
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
        $report = $this->Reports->get($id, contain: ['Users']);
        $this->set(compact('report'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $report = $this->Reports->newEmptyEntity();
        if ($this->request->is('post')) {
            $requestData = $this->request->getData();
            $report = $this->Reports->patchEntity($report, $this->request->getData());
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'index']);
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
        $report = $this->reports_table->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $report = $this->Reports->patchEntity($report, $this->request->getData());
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
        }
        $users = $this->Reports->Users->find('list', limit: 200)->all();
        $this->set(compact('report', 'users'));
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
        $report = $this->Reports->get($id);
        if ($this->Reports->delete($report)) {
            $this->Flash->success(__('The report has been deleted.'));
        } else {
            $this->Flash->error(__('The report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'listUser']);
    }
}
