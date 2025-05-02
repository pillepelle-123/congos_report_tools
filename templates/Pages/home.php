<?php
// $this->Breadcrumbs->add('Home', '/');


$this->Breadcrumbs->render(
    ['separator' => ' ▶ '] // Optional: Trennzeichen anpassen // CSS-Klasse
) ?>

<h1>Hallo <?= $this->Identity->get('username') ?> </h1>

<div class="home">
    <div>
        Select a CRT App
    </div>
        Manage Reports
    </div>
    <div>
        Manage User Settings
    </div>
    <?php if ($this->Identity->get('role') === 'admin') : ?>
    <div>
        <?= $this->Html->link('Manage Users', ['controller' => 'Users', 'action' => 'index']); ?>
    </div>
    <?php endif; ?>
    <?=  'ha' ?>
    <?php foreach ($reports as $report) : ?>
        <div>
            <?= $this->Html->link($report->name, ['controller' => 'Reports', 'action' => 'view', $report->id]); ?>
        </div>
    <?php endforeach; ?>

    
