<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\ORM\Query\SelectQuery;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $helpers = ['Html', 'Form', 'Flash'];
    protected $identity;
    protected $my_user; // beinhaltet auch die Reports des Users
    protected $all_users;
    protected $users_table;
    protected $all_reports;
    protected $reports_table;
    protected $my_reports;
    protected $tools_table;

    protected $model_name; // z. B. 'Reports', 'Users', etc.
    protected Entity $entity;
    protected Entity $entities;
    protected Table $table;
    protected SelectQuery $query;

    // protected $tableContain = [];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Breadcrumb');
        $this->loadComponent('Crud', [
            'model_name' => $this->name,
            'request' => $this->request
        ]);
        // $this->Crud->initialize(['model_name' => $this->name, 'request' => $this->request]);

        
        $this->viewBuilder()->setHelpers(helpers: ['Authentication.Identity']); // wichtig für Views!
        // $this->viewBuilder()->setHelpers(helpers: ['SessionLink']); // wichtig für Views!

        $this->identity = $this->request->getAttribute('identity') ?? [];
   
        if($this->identity) {
            // Datenbank-Abfragen
            $this->users_table = $this->fetchTable('Users');
            // Alle User
            $this->all_users = $this->users_table->find()
                ->contain(['Reports']);
            // Mein User
            $this->my_user = $this->users_table->get($this->identity['id'], [
                'contain' => ['Reports'],
            ]);  
            // Alle Reports
            $this->reports_table = $this->fetchTable('Reports');
            $this->all_reports = $this->reports_table->find()
                ->contain(['Users']);
            // Meine Reports
            $this->my_reports = $this->reports_table->find()
                ->where(['user_id' => $this->identity['id']])
                ->contain(['Users']);
            // Alle Apps
            $this->tools_table = $this->fetchTable('Tools');
            // $this->all_tools = $this->tools_table->find()
            $modelName = $this->name; // z. B. 'Reports', 'Users', etc.

            $this->paginate = [
            'limit' => 10,
            'maxLimit' => 100
            ];
            // Für Pages gibt es keine Tabellen, daher wird hier übersprungen
            $this->model_name = $this->name;
            if (\Cake\ORM\TableRegistry::getTableLocator()->exists($this->name)) {
                $this->table = $this->{$this->name};
            }
        }
    }

    public function index()
    {
        try {
            $entities = $this->paginate($this->query);
            // Dynamisch an die View übergeben
            $this->set('entities', $entities);
            // _serialize() gibt die Entity als JSON zurück, das ist perfekt für einen API-Call (dann ist das Template nicht nötig)
            $this->set('_serialize', ['entities']);
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Keine Einträge gefunden.');
            return $this->referer();
        }
    }

    // public function view($id = null)
    // {
    //     $modelName = $this->name; // z. B. 'Reports', 'Users', etc.
    //     // $this->table // bei Bedarf: Tabelle laden

    //     try {
    //         $this->entity = $this->$modelName->get($id);

    //         // Dynamisch an die View übergeben
    //         $this->set('entity', $this->entity);
    //         // _serialize() gibt die Entity als JSON zurück, das ist perfekt für einen API-Call (dann ist das Template nicht nötig)
    //         $this->set('_serialize', ['entity']);
    //     } catch (RecordNotFoundException $e) {
    //         $this->Flash->error('Eintrag nicht gefunden.');
    //         return $this->referer();
    //     }
    // }

    // public function add() {
    //     $table = $this->getTable();
    //     $newEntity = $table->newEmptyEntity();
    //     if ($this->request->is('post')) {
    //         // $A = $this->Reports;
    //         $newEntity = $table->patchEntity($newEntity, $this->request->getData());
    //         if ($this->Reports->save($newEntity)) {
    //             $this->Flash->success(__('The report has been saved.'));
    //         } else {
    //             $this->Flash->error(__('The report could not be saved. Please, try again.'));
    //         }
    //     }
    //     $this->set('newEntity', $newEntity);
    //     // return $newEntity;
    // }

    public function getEntity(): Entity 
    {
        return $this->entity;
    }

    public function getTable(): Table 
    {
        return $this->{$this->name};
    }

    // public function setQuery(array $contain, bool $only_user_data): void
    // {
    //     // $this->query = $this->{$this->name}->find('all')
    //     //     ->where($only_user_data ? ['user_id' => $this->identity['id']] : ['1' => '1'])
    //     //     ->contain($contain);

    //     $this->query = $this->{$this->name}->find('all')
    //         ->where($only_user_data ? ['user_id' => $this->identity['id']] : ['1' => '1'])
    //         ->contain($contain);
    // }

    // public function setContain($contain): void
    // {
    //     $this->tableContain = $contain;
    // }
    public function setPaginationConfig(array $order, string $limit = '10'): void
    {

        if ($order) {
            $this->paginate = array_merge($this->paginate, 
                ['order' => [$order['field'] => $order['direction']]]
            );
        }
        if ($limit) {
            $this->paginate = array_merge($this->paginate, 
                ['limit' => $limit]
            );
        }
    }

    public function getOtherEntitiesSelectQuery(string $table, array $contain = []): SelectQuery
    {
        $tables = $this->fetchTable($table);
        return 
            $tables->find()
                ->contain($contain);
    }

    public function beforeRender(\Cake\Event\EventInterface $event)
    {
        parent::beforeRender($event);
        
        // Auto-generate title for Templates if not already set
        if (!$this->viewBuilder()->getVar('title')) {

            $controller = $this->request->getParam('controller');
            $action = $this->request->getParam('action');
            if ($action !== 'index') {
                $controller = substr($controller, 0, -1);
            } else {
                $action = 'List of';
            }
            
            $this->set('title', ucfirst($action) . ' ' . ucfirst($controller));
        };


        // ######################################
        // ############ Breadcrumbs
        // ######################################

        // // MenuNodes laden
        // $menuNodes = TableRegistry::getTableLocator()->get('MenuNodes');

        // // Versuchen, den aktuellen Menüpunkt zu finden
        // $current = $menuNodes->find()
        //     ->where([
        //         'controller' => $this->request->getParam('controller'),
        //         'action' => $this->request->getParam('action'),
        //         //'plugin' => $this->request->getParam('plugin') ? $this->request->getParam('plugin') : '' // kann auch null sein
        //     ])
        //     ->first();

        // // Breadcrumbs aufbauen (falls gefunden)
        // $breadcrumbs = [];
        // if ($current) {
        //     $breadcrumbs = $menuNodes->find('path', ['for' => $current->id])->toArray();
        // }

        // $this->set('breadcrumbs', $breadcrumbs);
        $this->set('breadcrumbs', $this->Breadcrumb->getBreadcrumbs(
            $this->request->getParam('controller'),
            $this->request->getParam('action'),
            $this->request->getParam('plugin')
        ));
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $clickpath = $this->request->getSession()->read('clickpath', []);
        
        array_unshift($clickpath, [
            'url' => $this->request->getUri()->getPath(),
            'time' => time()
        ]);
        
        $this->request->getSession()->write('clickpath', array_slice($clickpath, 0, 10));
    }

}
