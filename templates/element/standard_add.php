<?php
use Cake\Utility\Inflector;
?>
<div class="actions-container">
    <!-- <div class="title">
        <h4><?php // __('Actions') ?></h4>
    </div> -->
    <!-- <div class="side-nav"> -->
    <div class="links">
        <?php // $this->Html->link(__('Related Reports'), '#reports', ['class' => 'side-nav-item'])
        $model_name_singular = (new \ReflectionClass($entity))->getShortName(); // Singular
        $model_name_plural = Inflector::pluralize($model_name_singular);

        echo $this->Html->link('<i class="bi bi-arrow-left-square"></i>&nbsp;' . $model_name_plural, ['controller' => $model_name_plural, 'action' => 'index'], ['title' => 'List of ' . $model_name_plural, 'class' => 'side-nav-item', 'escape' => false]) 
        ?>
    </div>
        <!-- </div> -->
</div>
<div class="column">
    <div class="users add content vertical-table">
        <?= $this->Form->create($newEntity) ?>
        <fieldset>
        <h3 style="word-break: normal;"><?= h('Add ' . $model_name_singular) ?></h3>
            <?php foreach ($fields as $field): ?>
                <?php if ($field['form_options']['type'] == 'checkbox') : ?>
                    <?= $this->Form->label($field['name'],  __(ucfirst(Inflector::humanize($field['name']))), [
                            'for' => $field['name'],
                        ]);                    
                    ?>
                    <div class="input checkbox-container">
                        <?= $this->Form->hidden($field['name'], ['value' => 0]); ?>
                        <?= $this->Form->checkbox($field['name'], $field['form_options']); ?>
                        <?= $this->Form->label('Checkbox Click Area', '' /* __(ucfirst(Inflector::humanize($field['name'])))*/, [
                                'class' => 'checkbox',
                                'for' => $field['name'],
                            ]); ?>
                        <span class="checkmark"></span>
                    </div>
                    <?php else : ?>
                    <?= $this->Form->control($field['name'], $field['form_options']); ?>
                <?php endif; ?>

            <?php endforeach; ?>
        </fieldset>
        <?= $this->Html->Link('Cancel', $this->request->referer() ? $this->request->referer() : ['controller' => $model_name_plural, 'action' => 'view', $entity->id], ['type' => 'button', 'class' => 'button', 'title' => 'Cancel']); ?>
        <?= $this->Form->button(__('Save')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>


<?php /*
<div class="column">
    <div class="users view content vertical-table">
        <?= $this->Form->create($entity) ?>
        <fieldset>
        <h3 style="word-break: normal;"><?= h($model_name_singular . ': ' . $instance_name) ?></h3>
            <?php foreach ($fields as $field): ?>
                <?php if ($field['form_options']['type'] == 'checkbox') : ?>
                    <?= $this->Form->label($field['name'],  __(ucfirst(Inflector::humanize($field['name']))), [
                            'for' => $field['name'],
                        ]);                    
                    ?>
                    <div class="input checkbox-container">
                        <?= $this->Form->hidden($field['name'], ['value' => 0]); ?>
                        <?= $this->Form->checkbox($field['name'], $field['form_options']); ?>
                        <?= $this->Form->label('Checkbox Click Area', '', [
                                'class' => 'checkbox',
                                'for' => $field['name'],
                            ]); ?>
                        <span class="checkmark"></span>
                    </div>
                    <?php else : ?>
                    <?= $this->Form->control($field['name'], $field['form_options']); ?>
                <?php endif; ?>

            <?php endforeach; ?>
        </fieldset>
        <?= $this->Html->Link('Cancel', $this->request->referer() ? $this->request->referer() : ['controller' => $model_name_plural, 'action' => 'view', $entity->id], ['type' => 'button', 'class' => 'button', 'title' => 'Cancel']); ?>
        <?= $this->Form->button(__('Save')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
*/ ?>
