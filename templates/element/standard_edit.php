<?php
use Cake\Utility\Inflector;
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?php // $this->Html->link(__('Related Reports'), '#reports', ['class' => 'side-nav-item'])
            $model_name_singular = (new \ReflectionClass($entity))->getShortName(); // Singular
            $model_name_plural = Inflector::pluralize($model_name_singular);

            if($editable ? $editable : 1==2 ) {
                echo $this->Html->image('icons/circle_filled_add_292929.svg', ['width' => '20px', 'height' => '20px']) . $this->Html->link(__(' Edit ' . $model_name_singular), ['controller' => $model_name_plural, 'action' => 'edit', $entity->id], ['class' => 'side-nav-item']);
                echo '<i class="fa-solid fa-circle-minus"></i> ' . $this->Form->postLink(__('Delete ' . $model_name_singular), ['controller' => $model_name_plural, 'action' => 'delete', $entity->id], ['confirm' => __('Are you sure you want to delete {0} {1}?',$model_name_singular, $instance_name), 'class' => 'side-nav-item']);
            }
            echo '<i class="fa-solid fa-circle-left"></i> ' . $this->Html->link($model_name_plural, ['controller' => $model_name_plural, 'action' => 'index'], ['class' => 'side-nav-item']) 
            ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users view content vertical-table">
            <?= $this->Form->create($entity) ?>
            <fieldset>
            <h3 style="word-break: normal;"><?= h($model_name_singular . ': ' . $instance_name) ?></h3>
                <?php foreach ($fields as $field): ?>
                    <?php $a = $field['name'];

                    // debug($field['form_options']['type']);
                    echo $this->Form->control(
                        $field['name'],
                        [
                            'type' => $field['form_options']['type'] ?? 'text',
                            // 'label' => $field['form_options']['label'] ?? $field['name'],
                            // 'value' => $entity->{$field['name']},
                            'options' => $field['form_options']['options']  ?? [],
                            'default' => $field['form_options']['default'] ?? [],
                            'class' => $field['form_options']['class'] ?? 'form-control',
                            'maxlength' => $field['form_options']['maxlength'] ?? 255,
                            'placeholder' => $field['form_options']['placeholder'] ?? $field['name'],
                            'resize' => $field['form_options']['resize'] ?? 'none',
                        ]
                ); ?>
                <?php endforeach; ?>
            </fieldset>
            <?= $this->Form->button(__('Save')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>