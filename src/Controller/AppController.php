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
    protected $identity;
    protected $my_user; // beinhaltet auch die Reports des Users
    protected $all_users;
    protected $users_table;
    protected $all_reports;
    protected $reports_table;
    protected $my_reports;
    protected $tools_table;
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
        
        $this->viewBuilder()->setHelpers(helpers: ['Authentication.Identity']); // wichtig für Views!

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
                ->orderBy(['Reports.modified' => 'DESC'])
                ->contain(['Users']);
            // Alle Apps
            $this->tools_table = $this->fetchTable('Tools');
        }

        $this->paginate = [
            'limit' => 10, // Max. 25 Einträge pro Seite
            'maxLimit' => 100 // Absolute Obergrenze (falls per URL manipuliert)
        ];
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
        }
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
