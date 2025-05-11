<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('New User'), ['action' => 'add']) ?>
        </div>
    </aside>
    <div class="column">
        <div class="users list_admin content">
            <fieldset>
            <h3><?= __($this->get('title')) ?></h3>
            <table>
                <thead>
                    <tr>
                        <th><?php // $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('username') ?></th>
                        <th><?= $this->Paginator->sort('email') ?></th>
                        <?php /*
                        <th><?= $this->Paginator->sort('first_name') ?></th>
                        <th><?= $this->Paginator->sort('last_name') ?></th>
                        <th><?= $this->Paginator->sort('token_expires') ?></th>
                        <th><?= $this->Paginator->sort('api_token') ?></th>
                        <th><?= $this->Paginator->sort('activation_date') ?></th>
                        <th><?= $this->Paginator->sort('secret') ?></th>
                        <th><?= $this->Paginator->sort('secret_verified') ?></th>
                        <th><?= $this->Paginator->sort('tos_date') ?></th>
                        <th><?= $this->Paginator->sort('is_superuser') ?></th>
                        <th><?= $this->Paginator->sort('lockout_time') ?></th>
                        <th><?= $this->Paginator->sort('login_token') ?></th>
                        <th><?= $this->Paginator->sort('login_token_date') ?></th>
                        <th><?= $this->Paginator->sort('token_send_requested') ?></th>                    
                        */ ?>
                        <th><?= $this->Paginator->sort('active') ?></th>
                        <th><?= $this->Paginator->sort('role') ?></th>
                        <th><?= $this->Paginator->sort('created') ?></th>
                        <th><?= $this->Paginator->sort('modified') ?></th>
                        <th><?= $this->Paginator->sort('last_login') ?></th>

                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php //h($user->id) ?></td>
                        <td><?= h($user->username) ?></td>
                        <td><?= h($user->email) ?></td>
                        <?php /*
                        <td><?= h($user->first_name) ?></td>
                        <td><?= h($user->last_name) ?></td>
                        <td><?= h($user->token_expires) ?></td>
                        <td><?= h($user->api_token) ?></td>
                        <td><?= h($user->activation_date) ?></td>
                        <td><?= h($user->secret) ?></td>
                        <td><?= h($user->secret_verified) ?></td>
                        <td><?= h($user->tos_date) ?></td>
                        <td><?= h($user->is_superuser) ?></td>
                        <td><?= h($user->lockout_time) ?></td>
                        <td><?= h($user->login_token) ?></td>
                        <td><?= h($user->login_token_date) ?></td>
                        <td><?= h($user->token_send_requested) ?></td>
                        */ ?>
                        <td><?= h($user->active) ?></td>
                        <td><?= h($user->role) ?></td>
                        <td><?= h($user->created) ?></td>
                        <td><?= h($user->modified) ?></td>
                        <td><?= h($user->last_login) ?></td>

                        <td class="actions">
                            <?= $this->Html->image('icons/material_view_292929.svg', array('title' => 'View', 'alt' => 'View', 'url' => ['action' => 'view', $user->id])); ?>
                            <?= $this->Html->image('icons/material_edit_292929.svg', array('title' => 'Edit', 'alt' => 'Edit', 'url' => ['action' => 'edit', $user->id])); ?>

                            <?= $this->Form->postLink(
                                $this->Html->image('icons/material_delete_292929.svg', ['alt' => 'Delete']), ['action' => 'delete', $user->id], ['confirm' => 'Möchtest du den User wirklich löschen?', 'escape' => false]
                            ) ?>


                                    <?php /*
                            <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $user->id],
                                [
                                    'method' => 'delete',
                                    'confirm' => __('Are you sure you want to delete # {0}?', $user->id),
                                ]
                            ) ?>
                            */ ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p class="paginator-counter"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>
</div>

<?php /*
<div class="users list_admin content">
    <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __($this->get('title')) ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?php // $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('active') ?></th>
                    <th><?= $this->Paginator->sort('role') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('last_login') ?></th>

                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php //h($user->id) ?></td>
                    <td><?= h($user->username) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->active) ?></td>
                    <td><?= h($user->role) ?></td>
                    <td><?= h($user->created) ?></td>
                    <td><?= h($user->modified) ?></td>
                    <td><?= h($user->last_login) ?></td>

                    <td class="actions">
                        <?= $this->Html->image('icons/material_view_292929.svg', array('title' => 'View', 'alt' => 'View', 'url' => ['action' => 'view', $user->id])); ?>
                        <?= $this->Html->image('icons/material_edit_292929.svg', array('title' => 'Edit', 'alt' => 'Edit', 'url' => ['action' => 'edit', $user->id])); ?>

                        <?= $this->Form->postLink(
                            $this->Html->image('icons/material_delete_292929.svg', ['alt' => 'Delete']), ['action' => 'delete', $user->id], ['confirm' => 'Möchtest du den User wirklich löschen?', 'escape' => false]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="paginator-counter"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
*/ ?>