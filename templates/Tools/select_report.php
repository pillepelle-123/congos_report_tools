<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tool $tool
 */
?>

<div class="reports form content">
    <h3><?= __('Report auswählen') ?></h3>
    
    <?= $this->Form->create($report, [
        'url' => ['action' => 'processSelection']
    ]) ?>
    <fieldset>
        <legend><?= __('Verfügbare Reports') ?></legend>
        <div class="table-responsive">
        <?php if (empty($reports)): ?>
            <p class="no-reports"><?= __('Keine Reports verfügbar.') ?></p>
        <?php else: ?>
            
            <table>
                <thead>
                    <tr>
                        <th><?= h('Auswahl') ?></th>
                        <th><?= $this->Paginator->sort('name') ?></th>
                        <th><?= $this->Paginator->sort('created') ?></th>
                        <th><?= $this->Paginator->sort('modified') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($reports as $index => $report): ?>
                    <tr>
                        <td>
                            <?= $this->Form->radio('selected_report', [
                                [
                                    'value' => $report,
                                    'text' => h('$report->name'),
                                    'label' => [
                                        'style' => 'report-label',
                                        'escape' => false,
                                        'text' => '', //$this->Html->tag('strong', h($report->name)),
                                    ]
                                ]
                            ], [
                                'required' => true,
                                'hiddenField' => ($index === 0) //Nur für erstes Element
                            ]) ?>
                        </td>
                        <td><?= h($report->name) ?></td>
                        <td><?= h($report->created) ?></td>
                        <td><?= h($report->modified) ?></td>
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
            <?php /*
                <?php foreach ($reports as $index => $report): ?>
                    <div class="report-option">
                        <div>
                        <?= $this->Form->radio('selected_report', [
                                [
                                    'value' => $report->id,
                                    'text' => h($report->name),
                                    'label' => [
                                        'class' => 'report-label',
                                        'escape' => false,
                                        'text' => $this->Html->tag('strong', h($report->name)),
                                    ]
                                ]
                            ], [
                                'required' => true,
                                'hiddenField' => ($index === 0) // Nur für erstes Element
                            ]) 
                        ?>
                        </div>
                        <div>
                            <?= h($report->created) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                */ ?>
        <?php endif; ?>
    </fieldset>
    
    <?= $this->Form->button(__('Auswählen'), [
        'class' => 'btn-primary'
    ]) ?>
    
    <?= $this->Form->end() ?>
</div>
<style>
.report-options {
    display: grid;
    gap: 1rem;
}
.report-option {
    display: flex;
    justify-content: flex-start;
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 5px;
}
.report-option div {
    align-items: left;
    justify-content: left;
    flex-grow: 1;
}
.table-responsive input[type="radio"] {
    width: 25px;
    height: 25px;
    float: left;
    clear: none;
    display: inline;
    margin: 8px 10px;
}
.report-option:hover {
    background-color: #f5f5f5;
}
.report-label {
    width: 100%;
    float: left;
    clear: none;
    display: inline;
    cursor: pointer;
}
.report-label strong {
    font-weight: normal;
    display: inline-block;
    font-size: 1.2em;
}
.no-reports {
    color: #666;
    font-style: italic;
}
</style>