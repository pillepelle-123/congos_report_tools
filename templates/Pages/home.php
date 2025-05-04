<?php 
// Inhalt für App-Cards
$app_cards = array (
    array(
        'header' => 'Run CRT App', 
        'description' => 'Der eigentliche Zauber',
        'controller' => 'Pages',
        'action' => 'test',
        'role' => 'user',
        'icon'=> '/img/icons/crt_ffffff.png',
    ),
    array(
        'header' => 'My Reports', 
        'description' => 'Anzeigen, anlegen, editieren und löschen von Reports',
        'controller' => 'Reports',
        'action' => 'index',
        'role' => 'user',
        'icon'=> '/img/icons/reports_ffffff.svg',
    ),
    array(
        'header' => 'My User Settings', 
        'description' => 'Ändern von Benutzerdaten, wie E-Mail, Passwort, Avatar...',
        'controller' => 'Users',
        'action' => 'edit/' . $this->Identity->get('id'),
        'role' => 'user',
        'icon' => '/img/icons/user_settings_ffffff.svg',
    ),
    array(
        'header' => 'Admin: Users', 
        'description' => 'Anzeigen, anlegen, editieren und löschen von Usern',
        'controller' => 'Users',
        'action' => 'index',
        'plugin' => 'CakeDC/Users',
        'role' => 'admin',
        'icon'=> '/img/icons/admin_users_ffffff.svg',

    ),
    array(
        'header' => 'Admin: Reports', 
        'description' => 'Anzeigen, anlegen, editieren und löschen von Reports',
        'controller' => 'Reports',
        'action' => 'index',
        'role' => 'admin',
        'icon'=> '/img/icons/admin_reports_ffffff.svg',
    )

  );
?>

<h1>Hallo <?= $this->Identity->get('username') ?> </h1>



<div class="home app-list">
<?php 
        // foreach ($app_cards as $app_card) {
        //     //$plugin = isset($app_card['plugin']) ? 'plugin' => $app_card['plugin'] : '';
        //     //echo $app_card['header'] . ' -- ' . $app_card['plugin'];
        //     if ($app_card['role'] === 'admin' && $this->Identity->get('role') === 'admin' || $app_card['role'] === 'user') {
        //         $content = '<div class="app-card-'.$app_card['role'].'"><header><h3>'.$app_card['header'].'</h3><img src="'.$app_card['icon'].'" width="32" height="32"></header><div>'.$app_card['description'].'</div></div>';
        //         echo $this->Html->link(
        //             $content, 
        //             (isset($app_card['plugin']) ? array('plugin' => $app_card['plugin']) : array()) +
        //             array( 'controller'=>$app_card['controller'], 'action'=>$app_card['action']),
        //             array('escape' => false)
        //         ); 
        //     }
        // }


        // foreach ($this->AppCards->getCards('user') as $card) {
        //     echo $this->AppCards->renderCard($card);
        // }
        // ?>

        <?= $this->AppCards->renderAll('admin') ?>

    <?php /* foreach ($reports as $report) : ?>
        <div>
            <?= $this->Html->link($report->name, ['controller' => 'Reports', 'action' => 'view', $report->id]); ?>
        </div>
    <?php endforeach; */ ?>

    
