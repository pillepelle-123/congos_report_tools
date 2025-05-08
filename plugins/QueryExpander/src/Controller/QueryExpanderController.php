<?php
declare(strict_types=1);

namespace QueryExpander\Controller;

use QueryExpander\Controller\AppController;

/**
 * QueryExpander Controller
 *
 */
class QueryExpanderController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->QueryExpander->find();
        $queryExpander = $this->paginate($query);

        $this->set(compact('queryExpander'));
    }

    public function queries() {
        debug(var: 'Controller (Action queries) des QueryExpander erreicht!'); 

    }
    /**
     * View method
     *
     * @param string|null $id Query Expander id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $queryExpander = $this->QueryExpander->get($id, contain: []);
        $this->set(compact('queryExpander'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $queryExpander = $this->QueryExpander->newEmptyEntity();
        if ($this->request->is('post')) {
            $queryExpander = $this->QueryExpander->patchEntity($queryExpander, $this->request->getData());
            if ($this->QueryExpander->save($queryExpander)) {
                $this->Flash->success(__('The query expander has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The query expander could not be saved. Please, try again.'));
        }
        $this->set(compact('queryExpander'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Query Expander id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $queryExpander = $this->QueryExpander->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $queryExpander = $this->QueryExpander->patchEntity($queryExpander, $this->request->getData());
            if ($this->QueryExpander->save($queryExpander)) {
                $this->Flash->success(__('The query expander has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The query expander could not be saved. Please, try again.'));
        }
        $this->set(compact('queryExpander'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Query Expander id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $queryExpander = $this->QueryExpander->get($id);
        if ($this->QueryExpander->delete($queryExpander)) {
            $this->Flash->success(__('The query expander has been deleted.'));
        } else {
            $this->Flash->error(__('The query expander could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
