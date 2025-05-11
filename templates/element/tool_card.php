<?php 

use function PHPUnit\Framework\isEmpty;

 // foreach ($home_cards as $home_card) {
//$plugin = isset($home_card['plugin']) ? 'plugin' => $home_card['plugin'] : '';
//echo $home_card['header'] . ' -- ' . $home_card['plugin'];

//$paramArray = isset($home_card['tool']) ? ['tool' => $home_card['tool']] : '' ;
// if ($user['role'] === 'admin' && $this->Identity->get('role') === 'admin' || $user['role'] === 'user') {
    $role = $user['role'];
    $name = $tool['name'];
    $plugin_name = $tool['plugin'];
    $icon = $tool['icon'];
    $description = $tool['description'];
    
    // $color = isset($tool['color']) ? ' style="background-color:'.$tool['color'].';"' : '';
    $icon = $tool['icon'];
    $description = $tool['description'];

    // $content = '<div class="app-card-'.$home_card['role'].'"><header'.$color.'><h3>'.$home_card['header'].'</h3><img src="'.$home_card['icon'].'" width="32" height="32"></header><div>'.$home_card['description'].'</div></div>';
    $content = "<div class=\"tool-card-{$plugin_name}\"><header><h3>{$name}</h3><img src=\"{$icon}\" width=\"32\" height=\"32\"></header><div>{$description}</div></div>";                
    
    echo $this->Html->link(
        $content, 
        // isset($tool['url']) ? $tool['url'] : 
        // (isset($tool['plugin']) ? array('plugin' => $plugin_name) : array()) +
        array('plugin' => false, 'controller'=> 'Tools' /*$tool['controller']*/, 'action'=> 'storeTool' /*$tool['action']*/, '?' => ['tool' => $tool['plugin']]),
        array('escape' => false)
        
    ); 
// }
//}