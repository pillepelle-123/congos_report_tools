<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Plugin;
use Cake\Datasource\Exception\RecordNotFoundException;

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

        $this->loadComponent('Crud');



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
        $this->set('title', 'Admin: Tools');

        $this->set([
            'entities' => $tools,
        ]);
    }

    public function selectTool()
    {
        $query = $this->Tools->find();
        $tools = $this->paginate($query);

        $user = $this->my_user;
        $this->set('title', 'Tools');
        $this->set(compact('tools', 'user'));

    }

    public function storeTool()
    {
        // $session = $this->request->getSession();
        $tool_id = $this->request->getQuery();
        try { 
            $tool = $this->Tools->get($tool_id);
        } catch (RecordNotFoundException $e) {
            $this->Flash->error(__('Tool not found.'));
            return $this->redirect(['action' => 'selectTool']);
        }

        $this->request->getSession()->write(['crt.tool'=> $tool]);

        return $this->redirect(['action' => 'selectReport']);
    }
    

    public function selectReport()
    {
        // Neue Report-Instanz, die die den vom User ausgewählten Report repräsentiert
        $report = $this->reports_table->newEmptyEntity();
        //$tool_controller = $this->request->getQuery('tool');
        $tool = $this->request->getSession()->read('crt.tool');
        // debug($tool_controller);

        if (!$tool) {
            return $this->redirect(['action' => 'selectReport']);
        }


        $reports = $this->paginate($this->my_reports);
        // $this->request->getSession()->write(['crt.tool'=> $tool]);

        $this->set('title', 'Select Report');
        $this->set('tool', $tool);
        $this->set(compact('reports', 'report'));
    }

    public function processSelection()
    {
        $request = $this->request->getData('selected_report');

        if(!isset($request)) {
            $this->Flash->warning(__('Bitte wähle einen Report aus'));
            // return $this->redirect(['action' => 'selectReport']);
            return $this->redirect($this->referer());
        }

        $report = $this->my_reports->find('all')
            ->where(['Reports.id' => $request])
            ->first();

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
        $this->Crud->setQuery();
        $entity = $this->Crud->view($id);
        
        $this->set([
            'entity' => $entity
        ]);
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
        // CrudComponent aufrufrufen
        $newEntity = $this->Crud->add([]);

        if ($this->request->is('post')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('newEntity', 'type'));

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


    // public function initMenu()
    // {
    //     $this->autoRender = false; // Kein Template rendern
    //     $menuNodesTable = $this->getTableLocator()->get('MenuNodes');

    //     // Zuerst alle vorhandenen Einträge löschen (optional)
    //     $menuNodesTable->deleteAll([]);

    //     $menuData = [
    //         [
    //             'title' => 'Home',
    //             'controller' => 'Pages',
    //             'action' => 'display',
    //             'url' => '/',
    //             'children' => [
    //                 [
    //                     'title' => 'Tools',
    //                     'controller' => 'Tools',
    //                     'action' => 'index',
    //                     'children' => [
    //                         ['title' => 'View', 'controller' => 'Tools', 'action' => 'view'],
    //                         ['title' => 'Add', 'controller' => 'Tools', 'action' => 'add'],
    //                     ],
    //                 ],
    //                 [
    //                     'title' => 'Users',
    //                     'controller' => 'Users',
    //                     'action' => 'index',
    //                     'children' => [
    //                         ['title' => 'View', 'controller' => 'Users', 'action' => 'view'],
    //                     ],
    //                 ],
    //             ],
    //         ],
    //     ];

    //     $this->saveMenuTree($menuData);
    //     echo "Menüstruktur erfolgreich importiert!";
    // }

    // private function saveMenuTree(array $data, ?int $parentId = null): void
    // {
    //     $menuNodesTable = $this->getTableLocator()->get('MenuNodes');

    //     foreach ($data as $item) {
    //         $children = $item['children'] ?? [];
    //         unset($item['children']);

    //         $node = $menuNodesTable->newEntity([
    //             'title' => $item['title'],
    //             'controller' => $item['controller'] ?? null,
    //             'action' => $item['action'] ?? null,
    //             'url' => $item['url'] ?? null,
    //             'plugin' => $item['plugin'] ?? null,
    //             'parent_id' => $parentId
    //         ]);

    //         if ($menuNodesTable->save($node)) {
    //             if (!empty($children)) {
    //                 $this->saveMenuTree($children, $node->id);
    //             }
    //         } else {
    //             debug($node->getErrors()); // Fehler anzeigen
    //         }
    //     }
    // }

}
