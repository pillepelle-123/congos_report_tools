<?php /*
<div class="app-card-<?= $card['role'] ?>">
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

<?php // foreach ($app_cards as $app_card) {
            //$plugin = isset($app_card['plugin']) ? 'plugin' => $app_card['plugin'] : '';
            //echo $app_card['header'] . ' -- ' . $app_card['plugin'];
            
            //$paramArray = isset($app_card['tool']) ? ['tool' => $app_card['tool']] : '' ;
            if ($app_card['role'] === 'admin' && $this->Identity->get('role') === 'admin' || $app_card['role'] === 'user') {
                $role = $app_card['role'];
                $color = isset($app_card['color']) ? ' style="background-color:'.$app_card['color'].';"' : '';
                $header = $app_card['header'];
                $icon = $app_card['icon'];
                $description = $app_card['description'];

                // $content = '<div class="app-card-'.$app_card['role'].'"><header'.$color.'><h3>'.$app_card['header'].'</h3><img src="'.$app_card['icon'].'" width="32" height="32"></header><div>'.$app_card['description'].'</div></div>';
                $content = "<div class=\"app-card-{$role}\"><header{$color}><h3>{$header}</h3><img src=\"{$icon}\" width=\"32\" height=\"32\"></header><div>{$description}</div></div>";                
                
                echo $this->Html->link(
                    $content, 
                    isset($app_card['url']) ? $app_card['url'] : 
                    (isset($app_card['plugin']) ? array('plugin' => $app_card['plugin']) : array()) +
                    array( 'controller'=>$app_card['controller'], 'action'=>$app_card['action'], '?' => isset($app_card['tool']) ? ['tool' => $app_card['tool']] : ''),
                    array('escape' => false)
                    
                ); 
            }
        //}