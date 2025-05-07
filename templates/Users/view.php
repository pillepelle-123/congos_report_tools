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
            <?= $this->Html->link(__('Users Reports'), '#reports', ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('◀ Admin: Users'), ['action' => 'listAdmin'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users view content vertical-table">
            <h3><?= h($user->username) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($user->id . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($user->first_name . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($user->last_name . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Api Token') ?></th>
                    <td><?= h($user->api_token . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Secret') ?></th>
                    <td><?= h($user->secret . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($user->role . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Login Token') ?></th>
                    <td><?= h($user->login_token . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Token Expires') ?></th>
                    <td><?= h($user->token_expires . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Activation Date') ?></th>
                    <td><?= h($user->activation_date . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Tos Date') ?></th>
                    <td><?= h($user->tos_date . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Login') ?></th>
                    <td><?= h($user->last_login . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Lockout Time') ?></th>
                    <td><?= h($user->lockout_time . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Login Token Date') ?></th>
                    <td><?= h($user->login_token_date . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Secret Verified') ?></th>
                    <td><?= $user->secret_verified ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $user->active ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Superuser') ?></th>
                    <td><?= $user->is_superuser ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Token Send Requested') ?></th>
                    <td><?= $user->token_send_requested ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Additional Data') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($user->additional_data)); ?>
                </blockquote>
            </div>
        </div>
        <div class="users view content" style="margin-top:20px;">
            <div class="related">
                <h4 id="reports"><?= __('Users Reports') ?></h4>
                <?php if ($reports->count() > 0) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                        <thead>
                                <th><?= $this->Paginator->sort('Name') ?></th>                            
                                <th><?= $this->Paginator->sort('Created') ?></th>
                                <th><?= $this->Paginator->sort('Modified') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reports as $report) : ?>
                        <tr>
                            <td><?= h($report->name) ?></td>
                            <td><?= h($report->created) ?></td>
                            <td><?= h($report->modified) ?></td>
                            <td class="actions">


                                <?= $this->Html->image('icons/material_view_292929.svg', array('title' => 'View', 'alt' => 'View', 'url' => ['controller' => 'Reports', 'action' => 'view', $report->id])); ?>
                                <?= $this->Html->image('icons/material_edit_292929.svg', array('title' => 'Edit', 'alt' => 'Edit', 'url' => ['controller' => 'Reports', 'action' => 'edit', $report->id])); ?>

                                <?= $this->Form->postLink(
                                    $this->Html->image('icons/material_delete_292929.svg', ['alt' => 'Delete']), ['controller' => 'Reports', 'action' => 'delete', $report->id], ['confirm' => 'Möchtest du den Report wirklich löschen?', 'escape' => false]
                                ) ?>

<?php /*
                                <?= $this->Html->link(__('View'), ['controller' => 'Reports', 'action' => 'view', $report->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Reports', 'action' => 'edit', $report->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Reports', 'action' => 'delete', $report->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $report->id),
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
                <?php else : ?>
                <p><?= __('No Reports found') ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>