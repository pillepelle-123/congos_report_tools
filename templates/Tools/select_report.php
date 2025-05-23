<?php
use Cake\Utility\Inflector;
/**
 * @var \App\View\AppView $this
 */
?>
<div class="reports form select-report content">
    <div class="title">

        <div class="left">
            <h3><?= __('Report auswählen') ?></h3>
        </div>

        <div class="right">
            <div class="display-tool" style="">

                <div><?= $tool['name'] ?></div>
                <div><?= $this->Html->image($tool['icon'], [
                    'alt' => h($tool['name']),
                ]) ?>
                </div>
            </div>
        </div>

    </div>
    <div class="actions-container">
        <div class="links">
            <?php // $this->Html->link(__('Related Reports'), '#reports', ['class' => 'side-nav-item'])
            // debug($entities->pagingParams()['alias']);
            // if(count($entities) > 0) {
            // $model_name_plural = $entities->pagingParams()['alias'];
            // $model_name_singular = Inflector::singularize($model_name_plural);

            // $model_name_singular = (new \ReflectionClass($entities->toArray()[0]))->getShortName(); // Singular
            // $model_name_plural = Inflector::pluralize($model_name_singular);

            // debug($this->getRequest()->getParam('controller'));
            // die();
            // if($editable ? $editable : 1==2 ) {

            $referer = $this->RefererParam->create( $this->getRequest()->getParam('controller'), $this->getRequest()->getParam('action'));
            // debug($r);
            // die();

                echo $this->Html->link('<i class="bi bi-plus-square"></i>&nbsp; Add Report', ['controller' => 'Reports', 'action' => 'add', '?' => ['referer' =>  $referer]], ['title' => 'Add Report', 'class' => 'side-nav-item', 'escape' => false]); // /*'?' => ['template' => $this->getTemplate()]*
            // }
            // }

            // echo $this->Html->link('<i class="bi bi-arrow-left-square"></i>&nbsp;' . $model_name_plural, ['controller' => $model_name_plural, 'action' => 'index'], ['title' => 'List of ' . $model_name_plural, 'class' => 'side-nav-item', 'escape' => false]);
            ?>
        </div>
    </div>
    <div class="body" >
    <?= $this->Form->create(null, [
        'url' => ['action' => 'processSelection']
    ]) ?>
        <legend><?= __('Verfügbare Reports') ?></legend>
        
        <?php if (empty($reports)): ?>
            <p class="no-reports"><?= __('Keine Reports verfügbar.') ?></p>
        <?php else: ?>
        <div class="table-responsive">    
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
                    <?php foreach ($reports->toArray() as $report): ?>
                        <tr>
                            <td>
                                <div class="input radio-container">
                                <?= $this->Form->radio('selected_report', [
                                    ['value' => $report->id, 'text' => 'Id']], [
                                    'label' => false,
                                    // 'required' => true,
                                    'hiddenField' => false,
                                    ]); ?>
                                <?php /* // label wird für Radio nicht benötigt
                                 $this->Form->label('Checkbox Click Area', '', [
                                        'class' => 'radio',
                                        'for' => 'selected_query',
                                    ]); */ ?>
                                <span class="checkmark"></span>
                            </div>

                                <?php /*
                                <label class="radio-container">
                                <?= $this->Form->radio('selected_report', [
                                    ['value' => $report->id, 'text' => 'Id']], [
                                    'label' => false,
                                    // 'required' => true,
                                    'hiddenField' => false,
                                    ]); ?>
                                    <span class="checkmark"></span>
                                </label>
                                */ ?>
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
        <?php endif; ?>
    
    <?= $this->Form->button(__('Nächster Schritt'), [
        'class' => 'button'
    ]) ?>
    
    <?= $this->Form->end() ?>
    </div>
</div>