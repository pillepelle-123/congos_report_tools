<?php /*
<div class="home-card-<?= $card['role'] ?>">
    <header>
        <h3><?= h($card['header']) ?></h3>
        <?= $this->Html->image($card['icon'], ['alt' => $card['header']]) ?>
    </header>
    <div>
    <?= h($card['description']) ?>
    </div>
</div>
    <?= $this->Html->link(
        'Öffnen',
        [
            'controller' => $card['controller'],
            'action' => $card['action'],
            'plugin' => $card['plugin'] ?? null
        ],
        ['class' => 'btn btn-primary']
    ) ?>
</div>
*/

use function PHPUnit\Framework\isEmpty;

 ?>

<?php // foreach ($home_cards as $home_card) {
            //$plugin = isset($home_card['plugin']) ? 'plugin' => $home_card['plugin'] : '';
            //echo $home_card['header'] . ' -- ' . $home_card['plugin'];
            
            //$paramArray = isset($home_card['tool']) ? ['tool' => $home_card['tool']] : '' ;
            if ($home_card['role'] === 'admin' && $this->Identity->get('role') === 'admin' || $home_card['role'] === 'user') {
                $role = $home_card['role'];
                $color = isset($home_card['color']) ? ' style="background-color:'.$home_card['color'].';"' : '';
                $header = $home_card['header'];
                $icon = $home_card['icon'];
                $description = $home_card['description'];

                // $content = '<div class="home-card-'.$home_card['role'].'"><header'.$color.'><h3>'.$home_card['header'].'</h3><img src="'.$home_card['icon'].'" width="32" height="32"></header><div>'.$home_card['description'].'</div></div>';
                $content = "<div class=\"home-card-{$role}\"><header{$color}><h3>{$header}</h3><img src=\"{$icon}\" width=\"32\" height=\"32\"></header><div>{$description}</div></div>";                
                
                echo $this->Html->link(
                    $content, 
                    isset($home_card['url']) ? $home_card['url'] : 
                    (isset($home_card['plugin']) ? array('plugin' => $home_card['plugin']) : array()) +
                    array( 'controller'=>$home_card['controller'], 'action'=>$home_card['action'], '?' => isset($home_card['tool']) ? ['tool' => $home_card['tool']] : ''),
                    array('escape' => false)
                    
                ); 
            }



    //             $content = "<div class=\"tool-card-{$plugin_name}\"><header><h3>{$name}</h3><img src=\"{$icon}\" width=\"32\" height=\"32\"></header><div>{$description}</div></div>";                
    
    // echo $this->Html->link(
    //     $content, 
    //     // isset($tool['url']) ? $tool['url'] : 
    //     // (isset($tool['plugin']) ? array('plugin' => $plugin_name) : array()) +
    //     array('plugin' => false, 'controller'=> 'Tools' /*$tool['controller']*/, 'action'=> 'storeTool' /*$tool['action']*/, '?' => ['tool' => $tool['plugin']]),
    //     array('escape' => false)
        
    // ); 
        //}