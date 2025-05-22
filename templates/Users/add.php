<?php
/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Report $report
 */
?>
<?php
// $fields2 = [['id', 'admin'], ['name', 'user'], ['user.username', 'admin'], ['created', 'user'], ['modified', 'user']]; // Feldname, 


$fields = [
    [
        'name' => 'username', 'form_options' => ['type' => 'text']
    ],
    [
        'name' => 'email', 'form_options' => ['type' => 'text']
    ],
    ['name' => 'password', 'form_options' => ['type' => 'text']],
    ['name' => 'first_name', 'form_options' => ['type' => 'text']],
    ['name' => 'last_name', 'form_options' => ['type' => 'text']],
    [
        'name' => 'role',
        'form_options' => [
            'type' => 'select',
            'options' => [
                'admin' => __('Admin'),
                'user' => __('User'),
            ],
            'class' => 'input select',
            ],
    ],
    [
        'name' => 'active',
        'form_options' => [
            'type' => 'checkbox',
            // 'hiddenField' => false,
            'class' => 'checkbox-checked', // btn-check
            'id' => 'active',
            'autocomplete' => 'off',
            'label' => false,
        ],
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
            <?= $this->Html->link(__('◀ Admin: Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users add content">
            <?= $this->Form->create($newEntity) ?>
            <fieldset>
            <h3><?= __d('cake_d_c/users', 'Add User') ?></h3>
                <?php
                    echo $this->Form->control('username', ['label' => __d('cake_d_c/users', 'Username')]);
                    echo $this->Form->control('email', ['label' => __d('cake_d_c/users', 'Email')]);
                    echo $this->Form->control('password', ['label' => __d('cake_d_c/users', 'Password')]);
                    echo $this->Form->control('first_name', ['label' => __d('cake_d_c/users', 'First name')]);
                    echo $this->Form->control('last_name', ['label' => __d('cake_d_c/users', 'Last name')]);
                    echo $this->Form->control('active', [
                        'type' => 'checkbox',
                        'label' => __d('cake_d_c/users', 'Active')
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__d('cake_d_c/users', 'Save')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
*/ ?>