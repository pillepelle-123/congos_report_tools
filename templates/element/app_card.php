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
*/ ?>

<?php // foreach ($app_cards as $app_card) {
            //$plugin = isset($app_card['plugin']) ? 'plugin' => $app_card['plugin'] : '';
            //echo $app_card['header'] . ' -- ' . $app_card['plugin'];
            if ($app_card['role'] === 'admin' && $this->Identity->get('role') === 'admin' || $app_card['role'] === 'user') {
                $content = '<div class="app-card-'.$app_card['role'].'"><header><h3>'.$app_card['header'].'</h3><img src="'.$app_card['icon'].'" width="32" height="32"></header><div>'.$app_card['description'].'</div></div>';
                echo $this->Html->link(
                    $content, 
                    (isset($app_card['plugin']) ? array('plugin' => $app_card['plugin']) : array()) +
                    array( 'controller'=>$app_card['controller'], 'action'=>$app_card['action']),
                    array('escape' => false)
                ); 
            }
        //}