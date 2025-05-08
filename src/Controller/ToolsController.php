<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Plugin;

/**
 * Tools Controller
 *
 * @property \App\Model\Table\ToolsTable $Tools
 * @property \Cake\ORM\Table $ToolsTable
 * @property \App\Model\Entity\Tool $Tool
 */
class ToolsController extends AppController
{
    public $tool;
    public function initialize(): void
    {
        parent::initialize();
        $this->ToolsTable = $this->fetchTable('Tools');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Tools->find();
        $tools = $this->paginate($query);

        $user = $this->my_user;
        $this->set('title', 'Tools');
        $this->set(compact('tools', 'user'));
    }

    public function selectReport()
    {
        // Neue Report-Instanz, die die den vom User ausgewählten Report repräsentiert
        $report = $this->reports_table->newEmptyEntity();
        $tool_controller = $this->request->getQuery('tool');
        // $tool = $this->query->find()->contain(['Reports'])->where(['id' => $id])->first();
        $id = 1;
        $tool = $this->Tools->find('all')
            ->where(['controller' => $tool_controller])
            ->first();

        $reports = $this->paginate($this->my_reports);
        $this->request->getSession()->write(['crt.tool'=> $tool]);

        $this->set('title', 'Select Report');
        $this->set('tool', $this->tool);
        $this->set(compact('reports', 'report'));
    }

    public function processSelection()
    {
        $report = $this->request->getData('selected_report');
        // $tool_controller = $this->request->getQuery('tool');
        // debug($report);
        // die();

        $tool = $this->request->getSession()->read('crt.tool');
        // debug($tool->get('plugin'));
        // debug($tool->get('controller'));

        $a = Plugin::isLoaded('Tools/QueryExpander');
        $b = Plugin::loaded();


        if ($report) {
            $this->request->getSession()->write(['crt.report'=> $report]);
            return $this->redirect(['plugin' => 'QueryExpander'/* $tool->get('plugin') */, 'controller' => 'QueryExpander' /*$tool->get('controller')*/, 'action' => 'queries']);
        } else {
            $this->Flash->error(__('No report selected.'));
            return $this->redirect(['action' => 'selectReport']);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Tool id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tool = $this->Tools->get($id, contain: []);
        $this->set(compact('tool'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tool = $this->Tools->newEmptyEntity();
        if ($this->request->is('post')) {
            $tool = $this->Tools->patchEntity($tool, $this->request->getData());
            if ($this->Tools->save($tool)) {
                $this->Flash->success(__('The tool has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tool could not be saved. Please, try again.'));
        }
        $this->set(compact('tool'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tool id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tool = $this->Tools->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tool = $this->Tools->patchEntity($tool, $this->request->getData());
            if ($this->Tools->save($tool)) {
                $this->Flash->success(__('The tool has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tool could not be saved. Please, try again.'));
        }
        $this->set(compact('tool'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tool id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tool = $this->Tools->get($id);
        if ($this->Tools->delete($tool)) {
            $this->Flash->success(__('The tool has been deleted.'));
        } else {
            $this->Flash->error(__('The tool could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
