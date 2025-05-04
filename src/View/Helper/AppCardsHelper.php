<?php
namespace App\View\Helper;

use Cake\View\Helper;

class AppCardsHelper extends Helper
{
    //protected $identity;
    public array $helpers = ['Authentication.Identity']; // Load the helper here

    protected array $_defaultConfig = [
        'cards' => []
    ];

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $identity = $this->_View->getRequest()->getAttribute('identity');

        $identity_id = '';
        if ($identity) {
            $identity_id = $identity->get('id');
        }
        
        $this->_defaultConfig['cards'] = [
            [
                'header' => 'Run CRT App', 
                'description' => 'Der eigentliche Zauber',
                'controller' => 'Pages',
                'action' => 'test',
                'role' => 'user',
                'icon'=> '/img/icons/crt_ffffff.png',
            ],
            [
                'header' => 'My Reports', 
                'description' => 'Anzeigen, anlegen, editieren und löschen von Reports',
                'controller' => 'Reports',
                'action' => 'index',
                'role' => 'user',
                'icon'=> '/img/icons/reports_ffffff.svg',
            ],
            [
                'header' => 'My User Settings', 
                'description' => 'Ändern von Benutzerdaten, wie E-Mail, Passwort, Avatar...',
                'controller' => 'Users',
                'action' => 'edit/' . $identity_id,
                'role' => 'user',
                'icon' => '/img/icons/user_settings_ffffff.svg',
            ],
            [
                'header' => 'Admin: Users', 
                'description' => 'Anzeigen, anlegen, editieren und löschen von Usern',
                'controller' => 'Users',
                'action' => 'index',
                'plugin' => 'CakeDC/Users',
                'role' => 'admin',
                'icon'=> '/img/icons/admin_users_ffffff.svg',
        
            ],
            [
                'header' => 'Admin: Reports', 
                'description' => 'Anzeigen, anlegen, editieren und löschen von Reports',
                'controller' => 'Reports',
                'action' => 'index',
                'role' => 'admin',
                'icon'=> '/img/icons/admin_reports_ffffff.svg',
            ],
        ];
    }

    public function getCards($role = null): array
    {
        if ($role) {
            if ($role === 'admin') {
                return array_filter($this->_defaultConfig['cards'], function($card) use ($role) {
                    return $role === 'admin' ? $card['role'] === 'admin' || $card['role'] === 'user' : $card['role'] === $role;
                });
            }
            // return array_filter($this->_defaultConfig['cards'], function($card) use ($role) {
            //     return $card['role'] === $role;
            // });
        }
        return $this->_defaultConfig['cards'];
    }

    public function renderCard(array $app_card): string
    {
        return $this->getView()->element('app_card', compact('app_card'));
    }

    public function renderAll($role = null): string
    {
        $html = '';
        foreach ($this->getCards($role) as $app_card) {
            $html .= $this->renderCard($app_card);
        }
        return $html;
    }
}