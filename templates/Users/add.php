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

<?php /*
<div class="actions columns large-2 medium-3">
    <h3><?= __d('cake_d_c/users', 'Actions') ?></h3>
    <ul class="side-nav">
        <?= $this->Html->link(__d('cake_d_c/users', '◀ Admin: Users'), ['action' => 'listAdmin']) ?>
    </ul>
</div>
<div class="users add content">
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __d('cake_d_c/users', 'Add User') ?></legend>
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
    <?= $this->Form->button(__d('cake_d_c/users', 'Submit')) ?>
    <?= $this->Form->end() ?>
</div>
*/ ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('◀ Admin: Users'), ['action' => 'listAdmin'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users add content">
            <?= $this->Form->create($user) ?>
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
            <?= $this->Form->button(__d('cake_d_c/users', 'Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>