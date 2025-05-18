<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class BreadcrumbComponent extends Component
{
    public function getBreadcrumbs($controller, $action, $plugin = null)
    {
        $menuTable = $this->getController()->getTableLocator()->get('MenuNodes');
        
        // Aktuellen Menüpunkt finden
        $currentNode = $menuTable->find()
            ->where([
                'controller' => $controller,
                'action' => $action,
                //'plugin' => $plugin ? $plugin : ''
            ])
            ->first();
        
        if (!$currentNode) {
            return [];
        }
        
        // Pfad vom aktuellen Knoten bis zur Wurzel holen
        return $menuTable->find('path', ['for' => $currentNode->id])
            ->toArray();
    }
}

// class BreadcrumbComponent extends Component
// {
//     public function initialize(array $config): void
//     {
//         parent::initialize($config);
//     }

//     public function getBreadcrumbs($controller, $action, $plugin = null)
//     {
//         $menuTable = $this->getController()->getTableLocator()->get('MenuNodes');
        
//         $currentNode = $menuTable->find()
//             ->where([
//                 'controller' => $controller,
//                 'action' => $action,
//                 'plugin' => $plugin
//             ])
//             ->first();
            
//         if (!$currentNode) {
//             return [];
//         }
        
//         $path = $menuTable->find('path', ['for' => $currentNode->id])
//             ->toArray();
            
//         return $path;
//     }
// }