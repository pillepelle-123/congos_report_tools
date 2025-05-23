<?php
/**
 * @var \App\View\AppView $this
 * //@var \App\Model\Entity\Report $report
 */
?>
<?php

$userMap = [];
foreach ($users as $user) {
    $userMap[$user->id] = $user->username;
}

$fields = [
    [
        'name' => 'name', 'form_options' => ['type' => 'text'], 'access' => 'user'
    ],
    [
        'name' => 'xml', 'form_options' => ['type' => 'textarea'], 'access' => 'user'
    ],
[
        'name' => 'user_id',
        'form_options' => [
            
            'type' => 'select',
            'options' => $userMap, // [array_map(fn($u) => $u->id, $users->toArray()) => array_map(fn($u) => $u->username, $users->toArray())],
            /*$users->username, array_map(fn($u) => $u->username, $users->toArray()), // $users->username, array_map(fn($u) => $u->username, $users->toArray()) => array_map(fn($u) => $u->username, $users->toArray()), */
            'class' => 'input select',
        ],
        'access' => 'admin'
    ],
];

echo $this->element('standard_add', [


    // 'rel_entity_fields' => [
    //     'Users' => ['username', 'created', 'modified'],
    //     'Tools' => ['name']
    //  ],
    // 'rel_entity_pages' => [$user],
    'entity' => $newEntity,
    // 'instance_name' => $newEntity->username,
    'fields' => $fields,
    'editable' => true,

]);
?>
<?php /*
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('◀ My Reports'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?php if ($this->Identity->get('role') === 'admin') {
                echo $this->Html->link(__('◀ Admin: Reports'), ['action' => 'indexAdmin'], ['class' => 'side-nav-item']);
            } ?>

        </div>
    </aside>
    <div class="column column-80">
        <div class="reports add content">
            <?= $this->Form->create($newEntity) ?>
            <fieldset>
                <!-- <h3><?= __($this->get('title')) ?></h3> -->
                <?php
                    $usernames = [];
                    foreach ($users as $user) {
                        $usernames[$user->id] = $user->username;
                    }

                    echo $this->Form->control('name');
                    echo $this->Form->control('xml', ['type' => 'textarea', 'class' => 'form_xml']);
                    if ($this->Identity->get('role') === 'admin') {
                        if($type == 'admin') {
                            echo $this->Form->control('user_id', ['options' => $usernames, 'default'=> $this->Identity->get('id')]);
                        } else {
                            echo '<label>User</label>';
                            echo h($this->Identity->get('username'));
                        }
                        // echo $this->Form->control('user_id', ['options' => $usernames, 'default'=> $this->Identity->get('id')]);
                    }
                    //echo $this->Form->control('user_id', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Save')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
*/ ?>