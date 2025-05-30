<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Report $report
 */
?>

<?php
$fields = [
    [
        'name' => 'id',
        'type' => 'display',
        'access' => 'admin'
    ],
    [
        'name' => 'name',
        'type' => 'display',
        'access' => 'user'
    ],
    [
        'name' => 'xml',
        'type' => 'fieldset',
        'access' => 'user'
    ],
    [
        'name' => 'created',
        'type' => 'display',
        'access' => 'user'
    ],
    [
        'name' => 'modified',
        'type' => 'display',
        'access' => 'user'
    ]
];

echo $this->element('standard_view', [


    'rel_entity_fields' => [
        'Users' => ['username', 'created', 'modified'],
        'Tools' => ['name']
     ],
    'rel_entity_pages' => [$user],
    'entity' => $entity,
    'instance_name' => $entity->name,
    'fields' => $fields,
    'editable' => true,

]);
?>


<?php /*
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Report'), ['action' => 'edit', $report->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Report'), ['action' => 'delete', $report->id], ['confirm' => __('Are you sure you want to delete # {0}?', $report->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('◀ My Reports'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?php if ($this->Identity->get('role') === 'admin') {
                    echo $this->Html->link(__('◀ Admin: Reports'), ['action' => 'indexAdmin'], ['class' => 'side-nav-item']);
                } ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="reports view content vertical-table">
            <h3><?= h($report->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($report->name) ?></td>
                </tr>
                <?php if ($this->Identity->get('role') === 'admin'): ?>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $report->hasValue('user') ? $this->Html->link($report->user->username, ['controller' => 'Users', 'action' => 'view', $report->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($report->id) ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($report->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($report->modified) ?></td>
                </tr>
            </table>
            <div class="text view-report-xml">
                <strong><?= __('Xml') ?></strong>
                <blockquote class="blockquote_xml">
                    <?= $this->Text->autoParagraph(h($report->xml)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
*/ ?>