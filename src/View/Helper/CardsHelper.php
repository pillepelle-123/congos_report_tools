<?php
namespace App\View\Helper;

use Cake\View\Helper;

class CardsHelper extends Helper
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
        
        $this->_defaultConfig['home'] = [
            [
                'color'=> 'var(--color-crt-grau-stufe-7)',
                'header' => 'Run CRT App', 
                'description' => 'Der eigentliche Zauber',
                //'url' => '/tools',
                'controller' => 'Tools',
                'action' => '',
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
                'action' => 'settings/' . $identity_id,
                'role' => 'user',
                'icon' => '/img/icons/user_settings_ffffff.svg',
            ],
                        [
                'header' => 'Admin: Tools', 
                'description' => 'Anzeigen, anlegen, editieren und löschen von Usern',
                'controller' => 'Tools',
                'action' => 'list',
                //'plugin' => 'CakeDC/Users',
                'role' => 'admin',
                'icon'=> '/img/icons/admin_tools_ffffff.svg',
        
            ],
            [
                'header' => 'Admin: Users', 
                'description' => 'Anzeigen, anlegen, editieren und löschen von Usern',
                'controller' => 'Users',
                'action' => 'index',
                //'plugin' => 'CakeDC/Users',
                'role' => 'admin',
                'icon'=> '/img/icons/admin_users_ffffff.svg',
        
            ],
            [
                'header' => 'Admin: Reports', 
                'description' => 'Anzeigen, anlegen, editieren und löschen von Reports',
                'controller' => 'Reports',
                'action' => 'indexAdmin',
                'role' => 'admin',
                'icon'=> '/img/icons/admin_reports_ffffff.svg',
            ],
        ];
        $this->_defaultConfig['tools'] = [
            [
                'color'=> 'var(--color-crt-waldgrün)',
                'header' => 'Query Expander',
                'description' => 'Erweitere Queries um Kopien von bestehenden Data Items und ändere deren Namen und Expression mittels Search & Replace.',
                'controller' => 'Tools',
                'action' => 'selectReport',
                'tool' => 'queryExpander',
                'role' => 'user',
                'icon'=> '/img/icons/tool_query_expander_ffffff.svg',
            ],
        ];
    }

    public function getCards($domain = null, $role = null): array
    {
        if ($role) {
            if ($role === 'admin') {
                return array_filter($this->_defaultConfig[$domain], function($card) use ($role) {
                    return $role === 'admin' ? $card['role'] === 'admin' || $card['role'] === 'user' : $card['role'] === $role;
                });
            }
            // return array_filter($this->_defaultConfig['cards'], function($card) use ($role) {
            //     return $card['role'] === $role;
            // });
        }
        return $this->_defaultConfig[$domain];
    }

    public function renderHomeCard(array $home_card): string
    {
        return $this->getView()->element('home_card', compact('home_card'));
    }

    public function renderAllHome($domain = null, $role = null): string
    {
        $html = '';
        foreach ($this->getCards($domain, $role) as $card) {
            $html .= $this->renderHomeCard($card);
        }
        return $html;
    }

    public function renderToolCard($tool = null): string
    {
        // $tool['role'] = $this->Identity->get('role');
        // $tool['color'] = 'var(--color-crt-waldgrün)';
    
        return $this->getView()->element('tool_card', compact('tool'));
    }

    //     public function renderAllTool($domain = null, $role = null): string
    // {
    //     $html = '';
    //     foreach ($this->getCards($domain, $role) as $card) {
    //         $html .= $this->renderToolCard($card);
    //     }
    //     return $html;
    // }
}