<?php 
// Inhalt für App-Cards
$app_cards = array (
    array(
        'header' => 'Run CRT App', 
        'description' => 'Der eigentliche Zauber',
        'controller' => 'Reports',
        'action' => 'index',
        'is_admin' => false
    ),
    array(
        'header' => 'My Reports', 
        'description' => 'Anzeigen, anlegen, editieren und löschen von Reports',
        'controller' => 'Reports',
        'action' => 'index',
        'is_admin' => false
    ),
    array(
        'header' => 'My User Settings', 
        'description' => 'Ändern von Benutzerdaten, wie E-Mail, Passwort, Avatar...',
        'controller' => 'Reports',
        'action' => 'index',
        'is_admin' => false
    ),
    array(
        'header' => 'Admin: Users', 
        'description' => 'Anzeigen, anlegen, editieren und löschen von Usern',
        'controller' => 'Users',
        'action' => 'index',
        'is_admin' => true
    ),
    array(
        'header' => 'Admin: Reports', 
        'description' => 'Anzeigen, anlegen, editieren und löschen von Reports',
        'controller' => 'Reports',
        'action' => 'index',
        'is_admin' => true
    )
    
    // array("BMW",15,13),
    // array("Saab",5,2),
    // array("Land Rover",17,15)
  );
?>

<h1>Hallo <?= $this->Identity->get('username') ?> </h1>



<div class="home app-list">
    
<?php 
        foreach ($app_cards as $app_card) {
            if ($app_card['is_admin'] === true && $this->Identity->get('role') === 'admin' || $app_card['is_admin'] === false) {
                $content = '<div class="app-card"><header><h3>'.$app_card['header'].'</h3></header><div>'.$app_card['description'].'</div></div>';
                echo $this->Html->link(
                    $content, 
                    array( 'controller'=>$app_card['controller'], 'action'=>$app_card['action']),
                    array('escape' => false)
                ); 
            }
        }

    ?>

    <?php foreach ($reports as $report) : ?>
        <div>
            <?= $this->Html->link($report->name, ['controller' => 'Reports', 'action' => 'view', $report->id]); ?>
        </div>
    <?php endforeach; ?>

    
