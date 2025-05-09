<?php
namespace App\View\Helper;

use Cake\View\Helper;

class UserInfoHelper extends Helper
{
    //protected $identity;
    public array $helpers = ['Authentication.Identity']; // Load the helper here

    protected $user;
    protected $reports;
    protected $identity;

    protected array $_defaultConfig = [
    ];

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->identity = $this->getView()->getRequest()->getAttribute('identity');

        //$identity = $this->request->getAttribute('identity');

        $this->user = \Cake\ORM\TableRegistry::getTableLocator()->get('Users')->find()
        ->where(['id' => $this->identity->get('id')])
        ->contain(['Reports'])
        ->first();

        $this->reports = $this->user->get('reports');
    }

    public function getInfo($page = null, $requests = null/*, $user = null*/): array
    {
        // $report_names = [];
        // foreach ($page->get('reports') as $report) {
        //     $report_names[] = $report->get('name');
        // }

        // debug($page->Identity->get('id'));
        // die();

        return array(
            'user' => $this->user,//$page->Identity->get('id'),
            'controller' => $requests->getParam('controller'),
            'action' => $requests->getParam('action'),
            'parameter' => $requests->getParam('pass.0'),
            'template' => $page->getTemplate(),
            'title' => $page->get('title'),
            'plugin' => $requests->getParam('plugin'),
            'reports' => $this->reports, //->get('name'),
        );
    }
}