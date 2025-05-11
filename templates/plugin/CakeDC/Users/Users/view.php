<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $Users
 * @var \App\Model\Entity\Report $Reports
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h3 class="heading"><?= __('Actios') ?></h>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $Users->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $Users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $Users->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users view content">
            <h3><?= h('User: ' . $Users->username) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($Users->id . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($Users->username . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($Users->email . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($Users->first_name . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($Users->last_name . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Api Token') ?></th>
                    <td><?= h($Users->api_token . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Secret') ?></th>
                    <td><?= h($Users->secret . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($Users->role . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Login Token') ?></th>
                    <td><?= h($Users->login_token . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Token Expires') ?></th>
                    <td><?= h($Users->token_expires . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Activation Date') ?></th>
                    <td><?= h($Users->activation_date . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Tos Date') ?></th>
                    <td><?= h($Users->tos_date . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($Users->created . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($Users->modified . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Login') ?></th>
                    <td><?= h($Users->last_login . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Lockout Time') ?></th>
                    <td><?= h($Users->lockout_time . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Login Token Date') ?></th>
                    <td><?= h($Users->login_token_date . ' ') ?></td>
                </tr>
                <tr>
                    <th><?= __('Secret Verified') ?></th>
                    <td><?= $Users->secret_verified ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $Users->active ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Superuser') ?></th>
                    <td><?= $Users->is_superuser ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Token Send Requested') ?></th>
                    <td><?= $Users->token_send_requested ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Additional Data') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($Users->additional_data)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Reports') ?></h4>
                <?php if (!empty($reports)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($reports as $report) : ?>
                        <tr>
                            <td><?= h($report->id) ?></td>
                            <td><?= $this->Html->link(__($report->name), '/reports/view/'.$report->id) ?></td>
                            <td><?= h($report->created) ?></td>
                            <td><?= h($report->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), '/reports/view/'.$report->id) ?>
                                <?= $this->Html->link(__('Edit'), '/reports/edit/'.$report->id) ?>
                                <?= $this->Html->link(__('Delete'), '/reports/delete/'.$report->id) ?>
                                
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
