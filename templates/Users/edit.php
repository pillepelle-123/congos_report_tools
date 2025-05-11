<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('View User'), ['action' => 'view', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(
                __('Delete User'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('◀ Admin: Users'), ['action' => 'indexAdmin'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users edit content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <h3><?= __($this->get('title')) ?></h3>
                <?php
                    echo $this->Form->control('username');
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('token');
                    echo $this->Form->control('token_expires', ['empty' => true]);
                    echo $this->Form->control('api_token');
                    echo $this->Form->control('activation_date', ['empty' => true]);
                    echo $this->Form->control('secret');
                    echo $this->Form->control('secret_verified');
                    echo $this->Form->control('tos_date', ['empty' => true]);
                    echo $this->Form->control('active');
                    echo $this->Form->control('is_superuser');
                    echo $this->Form->control('role');
                    echo $this->Form->control('additional_data');
                    echo $this->Form->control('last_login', ['empty' => true]);
                    echo $this->Form->control('lockout_time', ['empty' => true]);
                    echo $this->Form->control('login_token');
                    echo $this->Form->control('login_token_date', ['empty' => true]);
                    echo $this->Form->control('token_send_requested');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Save')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
