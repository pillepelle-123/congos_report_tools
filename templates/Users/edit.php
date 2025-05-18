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
            <?= $this->Html->link(__('◀ Admin: Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users edit content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <h3><?= __($this->get('title')) ?></h3>
                
                    <?= $this->Form->control('username') ?>
                    <?= $this->Form->control('email') ?>
                    <?= $this->Form->control('password') ?>
                    <?= $this->Form->control('first_name') ?>
                    <?= $this->Form->control('last_name') ?>
                    <?= $this->Form->control('token') ?>
                    <?= $this->Form->control('token_expires', ['empty' => true]) ?>
                    <?= $this->Form->control('api_token') ?>
                    <?= $this->Form->control('activation_date', ['empty' => true]) ?>
                    <?= $this->Form->control('secret') ?>
<label for="secret_verified"><?= __('Secret verified') ?></label>

                 <label class="checkbox-container">
                    <?= $this->Form->checkbox('secret_verified', ['value' => 'secret_verified'], ['hiddenField' => false, 'label' => '']) ?>
                    <span class="checkmark"></span>         
                </label>

                    <?php /*
                    <label class="checkbox-container">
                        <?= $this->Form->radio('secret_verified', [
                                    ['value' => 'secret_verified']], [
                                    'label' => false,
                                    //'required' => true,
                                    // 'hiddenField' => false,
                                    ]); ?>
                        <span class="checkmark"></span>
                    </label>
                    */ ?>
                        <?php // $this->Form->control('secret_verified') ?>



                    <?= $this->Form->control('tos_date', ['empty' => true]) ?>
                    <div style="display: block;">
                        <label for="active"><?= __('Is Active') ?></label>
                        <?= $this->Form->control('active', ['label' => '']) ?>
                    </div>
                    <div style="display: block;">
                        <label for="is_superuser"><?= __('Is Superuser') ?></label>
                        
                        <?= $this->Form->control('is_superuser', ['label' => '']) ?>
                        
                    </div>

                    <?php if ($user->is_superuser) : ?>
                        <label for="role"><?= __('Role') ?></label>
                        
                        <?php /*
                        <?= $this->Form->control('role', ['options' => [
                            'admin' => __('Admin'),
                            'user' => __('User'),
                        ], 'disabled' => true]); ?>#
                        */ ?>
                    <?php else : ?>
                        <?= $this->Form->control('role', ['options' => [
                            'admin' => __('Admin'),
                            'user' => __('User'),
                        ]]); ?>
                    <?php endif; ?>
                    <?php /*
                    <?= $this->Form->control('role',
                        ['options' => [
                            'admin' => __('Admin'),
                            'user' => __('User'),
                        ], $user->is_superuser ? 'disabled' : '' , 'style' => '']) ?>  
                    */ ?>  
                    <?= $this->Form->control('additional_data') ?>
                    <?= $this->Form->control('last_login', ['empty' => true]) ?>
                    <?= $this->Form->control('lockout_time', ['empty' => true]) ?>
                    <?= $this->Form->control('login_token') ?>
                    <?= $this->Form->control('login_token_date', ['empty' => true]) ?>
                    <?= $this->Form->control('token_send_requested') ?>
                
            </fieldset>
            <?= $this->Form->button(__('Save')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
