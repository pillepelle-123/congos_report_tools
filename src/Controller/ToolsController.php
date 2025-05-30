<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Plugin;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Tools Controller
 *
 * @property \App\Model\Table\ToolsTable $Tools
 * @property \App\Model\Entity\Tool $Tool
 */
class ToolsController extends AppController
{
    public $tool;
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
        $query = $this->Tools->find();

        $tools = $this->paginate($query);

        $title = parent::getTitle();
        $this->set('title', 'Admin: Tools');

        $this->set([
            'entities' => $tools,
        ]);
    }

    public function selectTool()
    {
        $query = $this->Tools->find();
        $tools = $this->paginate($query);

        // if ($this->getRequest()->getData('tool_id')) {
            $tool_id = $this->getRequest()->getData('tool_id');
        // }

        if ($this->getRequest()->is('post')) {
            $tool_id = $this->getRequest()->getData('tool_id');
            if (!$tool_id) {
                $this->Flash->warning(__('Bitte wähle ein Tool aus'));
                return $this->redirect($this->referer());
            }
            try {
                $tool = $this->Tools->get($tool_id);
                $this->getRequest()->getSession()->write(['crt.tool'=> $tool]);
                return $this->redirect(['action' => 'selectReport']);
            } catch (RecordNotFoundException $e) {
                $this->Flash->error(__('Tool not found.'));
                return $this->redirect($this->referer());
            }
        }

        $user = $this->my_user;
        $title = parent::getTitle();
        $this->set('title', 'Tools');
        $this->set(compact('tools', 'user'));

    }

    // public function storeTool()
    // {
    //     // $session = $this->getRequest()->getSession();
    //     $tool_id = $this->getRequest()->getQuery();
    //     try { 
    //         $tool = $this->Tools->get($tool_id);
    //     } catch (RecordNotFoundException $e) {
    //         if ($this->getRequest()->getSession()->read('crt.tool')) {
    //             $tool = $this->getRequest()->getSession()->read('crt.tool');
    //             return $this->redirect(['action' => 'selectReport']);
    //         }
    //         $this->Flash->error(__('Tool not found.'));
    //         return $this->redirect(['action' => 'selectTool']);
    //     }

    //     $this->getRequest()->getSession()->write(['crt.tool'=> $tool]);

    //     return $this->redirect(['action' => 'selectReport']);
    // }
    

    public function selectReport()
    {
        // debug($this->referer());
        // die();
        if ($this->getRequest()->is('post') && $this->referer() === '/tools') {
            $tool_id = $this->getRequest()->getData('tool_id');
            if (!$tool_id) {
                $this->Flash->warning(__('Bitte wähle ein Tool aus'));
                return $this->redirect($this->referer());
            }
            try {
                $tool = $this->Tools->get($tool_id);
                $this->getRequest()->getSession()->write(['crt.tool'=> $tool]);
                return $this->redirect(['action' => 'selectReport']);
            } catch (RecordNotFoundException $e) {
                $this->Flash->error(__('Tool not found.'));
                return $this->redirect($this->referer());
            }
        }

        $tool = null;
        $tool_id = $this->getRequest()->getQuery();
        if (!$tool_id) {
            if ($this->getRequest()->getSession()->read('crt.tool')) {
                $tool = $this->getRequest()->getSession()->read('crt.tool');
            } else {
                $this->Flash->error(__('No tool selected.'));
                return $this->redirect($this->referer());
            }
        }
        if (!$tool) {
            try { 
                $tool = $this->Tools->get($tool_id);
            } catch (RecordNotFoundException $e) {
                $this->Flash->error(__('Tool not found.'));
                return $this->redirect($this->referer());
            }
            $this->getRequest()->getSession()->write(['crt.tool'=> $tool]);
        }


        // Neue Report-Instanz, die die den vom User ausgewählten Report repräsentiert
        $report = $this->fetchTable('Reports')->newEmptyEntity();
        //$tool_controller = $this->getRequest()->getQuery('tool');
        // $tool = $this->getRequest()->getSession()->read('crt.tool');
        // debug($tool_controller);

        // if (!$tool) {
        //     return $this->redirect(['action' => 'selectReport']);
        // }

        if($this->getRequest()->is('post')) {
            $report_id = $this->getRequest()->getData('selected_report');

            if (!$report_id) {
                $this->Flash->warning(__('Bitte wähle einen Report aus'));
                return $this->redirect($this->referer());
            }
            // debug($this->getRequest()->getData('selected_report'));
            // die();

            $report = $this->my_reports->find('all')
                ->where(['Reports.id' => $report_id])
                ->first();
            // $report = $this->fetchTable('Reports')->newEntity($this->getRequest()->getData());
            // debug($report);
            // die();

            if (!$report) {
                $this->Flash->error(__('Report not found.'));
                return $this->redirect($this->referer());
            }

            $this->getRequest()->getSession()->write(['crt.report'=> $report]);
            return $this->redirect(['plugin' => 'QueryExpander'/* $tool->get('plugin') */, 'controller' => 'QueryExpander' /*$tool->get('controller')*/, 'action' => 'queries']);
        }

        parent::setPaginationConfig(['field' => 'created', 'direction' => 'desc']);
        $reports = $this->paginate($this->my_reports);
        // $this->getRequest()->getSession()->write(['crt.tool'=> $tool]);
        $title = parent::getTitle();
        $this->set('title', 'Select Report');
        $this->set('tool', $tool);
        $this->set(compact('reports', 'report'));
    }

    // public function processSelection()
    // {
    //     $request = $this->getRequest()->getData('selected_report');

    //     if(!isset($request)) {
    //         $this->Flash->warning(__('Bitte wähle einen Report aus'));
    //         // return $this->redirect(['action' => 'selectReport']);
    //         return $this->redirect($this->referer());
    //     }

    //     $report = $this->my_reports->find('all')
    //         ->where(['Reports.id' => $request])
    //         ->first();

    //     // $tool = $this->getRequest()->getSession()->read('crt.tool');
    //     // // debug($tool->get('plugin'));
    //     // // debug($tool->get('controller'));

    //     // $a = Plugin::isLoaded('QueryExpander');
    //     // $b = Plugin::loaded();

    //     // debug($tool);       
    //     // debug($a);
    //     // debug($b);
    //     // die();
    //     if ($report) {

    //         $this->getRequest()->getSession()->write(['crt.report'=> $report]);
    //         return $this->redirect(['plugin' => 'QueryExpander'/* $tool->get('plugin') */, 'controller' => 'QueryExpander' /*$tool->get('controller')*/, 'action' => 'queries']);
    //     } else {
    //         $this->Flash->error(__('No report selected.'));
    //         return $this->redirect(['action' => 'selectReport']);
    //     }
    // }

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
        // $type = $this->getRequest()->getParam('type');
        $type = $this->getRequest()->getQuery('type');
        // CrudComponent aufrufrufen
        $newEntity = $this->Crud->add([]);

        if ($this->getRequest()->is('post')) {
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
        $this->Crud->setQuery();
        $entity = $this->Crud->edit($id);
        $this->set(compact('entity'));
        return $this->redirect(['action' => 'view', $id]);
        // $tool = $this->Tools->get($id, contain: []);
        // if ($this->getRequest()->is(['patch', 'post', 'put'])) {
        //     $tool = $this->Tools->patchEntity($tool, $this->getRequest()->getData());
        //     if ($this->Tools->save($tool)) {
        //         $this->Flash->success(__('The tool has been saved.'));

        //         return $this->redirect(['action' => 'index']);
        //     }
        //     $this->Flash->error(__('The tool could not be saved. Please, try again.'));
        // }
        // $this->set(compact('tool'));
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
        $this->getRequest()->allowMethod(['post', 'delete']);
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
