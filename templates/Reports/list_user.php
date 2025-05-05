<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Report> $reports
 */
?>
<div class="reports index content">
    <?= $this->Html->link(__('New Report'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __($this->get('title')) ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $report): ?>
                <tr>
                    <td><?= $this->Number->format($report->id) ?></td>
                    <td><?= h($report->name) ?></td>
                    <td><?= $report->hasValue('user') ? $this->Html->link($report->user->username, ['controller' => 'Users', 'action' => 'view', $report->user->id]) : '' ?></td>
                    <td><?= h($report->created) ?></td>
                    <td><?= h($report->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->image('icons/material_view_292929.svg', array('title' => 'View', 'alt' => 'View', 'url' => ['action' => 'view', $report->id])); ?>
                        <?= $this->Html->image('icons/material_edit_292929.svg', array('title' => 'Edit', 'alt' => 'Edit', 'url' => ['action' => 'edit', $report->id])); ?>
                        <?= $this->Form->postLink(
                            $this->Html->image('icons/material_delete_292929.svg', ['alt' => 'Delete']), ['action' => 'delete', $report->id], ['confirm' => 'Möchtest du diesen Eintrag wirklich löschen?', 'escape' => false]
                        ) ?>

                        <?php /*
                        <?= $this->Html->image('icons/material_delete_292929.svg', array('title' => 'Delete', 'alt' => 'Delete', 'url' => ['action' => 'delete', $report->id], 'options' => ['method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $report->id),])); ?>
                        */ ?>

                        <?php /*
                        <?= $this->Html->link(__('View'), ['action' => 'view', $report->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $report->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $report->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $report->id),
                            ]
                        ) ?> */ ?>
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