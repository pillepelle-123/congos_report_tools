<?php 

use function PHPUnit\Framework\isEmpty;

 // foreach ($app_cards as $app_card) {
//$plugin = isset($app_card['plugin']) ? 'plugin' => $app_card['plugin'] : '';
//echo $app_card['header'] . ' -- ' . $app_card['plugin'];

//$paramArray = isset($app_card['tool']) ? ['tool' => $app_card['tool']] : '' ;
// if ($user['role'] === 'admin' && $this->Identity->get('role') === 'admin' || $user['role'] === 'user') {
    $role = $user['role'];
    $name = $tool['name'];
    $plugin_name = $tool['plugin'];
    $icon = $tool['icon'];
    $description = $tool['description'];
    
    // $color = isset($tool['color']) ? ' style="background-color:'.$tool['color'].';"' : '';
    $icon = $tool['icon'];
    $description = $tool['description'];

    // $content = '<div class="app-card-'.$app_card['role'].'"><header'.$color.'><h3>'.$app_card['header'].'</h3><img src="'.$app_card['icon'].'" width="32" height="32"></header><div>'.$app_card['description'].'</div></div>';
    $content = "<div class=\"tool-card-{$plugin_name}\"><header><h3>{$name}</h3><img src=\"{$icon}\" width=\"32\" height=\"32\"></header><div>{$description}</div></div>";                
    
    echo $this->Html->link(
        $content, 
        // isset($tool['url']) ? $tool['url'] : 
        // (isset($tool['plugin']) ? array('plugin' => $plugin_name) : array()) +
        array('plugin' => false, 'controller'=> 'Tools' /*$tool['controller']*/, 'action'=> 'selectReport' /*$tool['action']*/, '?' => ['tool' => $tool['plugin']]),
        array('escape' => false)
        
    ); 
// }
//}