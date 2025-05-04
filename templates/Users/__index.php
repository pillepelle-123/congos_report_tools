<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<div class="users index content">
    <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Users') ?></h3>
    <div>
    <?php
        foreach ($users as $user) {
            foreach ($user->reports as $report) {
                echo $report->name;
            }
            
        }
        // $user->reports->each(function ($report) {
        //     echo $this->Html->link($report->title, ['controller' => 'Reports', 'action' => 'view', $report->id]);
        // });
    ?>

    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?php // $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('first_name') ?></th>
                    <th><?= $this->Paginator->sort('last_name') ?></th>
                    <th><?= $this->Paginator->sort('token_expires') ?></th>
                    <th><?= $this->Paginator->sort('api_token') ?></th>
                    <th><?= $this->Paginator->sort('activation_date') ?></th>
                    <th><?= $this->Paginator->sort('secret') ?></th>
                    <th><?= $this->Paginator->sort('secret_verified') ?></th>
                    <th><?= $this->Paginator->sort('tos_date') ?></th>
                    <th><?= $this->Paginator->sort('active') ?></th>
                    <th><?= $this->Paginator->sort('is_superuser') ?></th>
                    <th><?= $this->Paginator->sort('role') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('last_login') ?></th>
                    <th><?= $this->Paginator->sort('lockout_time') ?></th>
                    <th><?= $this->Paginator->sort('login_token') ?></th>
                    <th><?= $this->Paginator->sort('login_token_date') ?></th>
                    <th><?= $this->Paginator->sort('token_send_requested') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php //h($user->id) ?></td>
                    <td><?= h($user->username) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->first_name) ?></td>
                    <td><?= h($user->last_name) ?></td>
                    <td><?= h($user->token_expires) ?></td>
                    <td><?= h($user->api_token) ?></td>
                    <td><?= h($user->activation_date) ?></td>
                    <td><?= h($user->secret) ?></td>
                    <td><?= h($user->secret_verified) ?></td>
                    <td><?= h($user->tos_date) ?></td>
                    <td><?= h($user->active) ?></td>
                    <td><?= h($user->is_superuser) ?></td>
                    <td><?= h($user->role) ?></td>
                    <td><?= h($user->created) ?></td>
                    <td><?= h($user->modified) ?></td>
                    <td><?= h($user->last_login) ?></td>
                    <td><?= h($user->lockout_time) ?></td>
                    <td><?= h($user->login_token) ?></td>
                    <td><?= h($user->login_token_date) ?></td>
                    <td><?= h($user->token_send_requested) ?></td>
                    <td class="actions">
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
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>