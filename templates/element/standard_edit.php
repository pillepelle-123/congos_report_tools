<?php
use Cake\Utility\Inflector;
?>
<!-- 
 #############################################
 ################## Actions ##################
 #############################################
-->
<div class="actions-container">
    <!-- <div class="title">
        <h4><?php // __('Actions') ?></h4>
    </div> -->
    <!-- <div class="side-nav"> -->
    <div class="links">
        <?php // $this->Html->link(__('Related Reports'), '#reports', ['class' => 'side-nav-item'])
        $model_name_singular = (new \ReflectionClass($entity))->getShortName(); // Singular
        $model_name_plural = Inflector::pluralize($model_name_singular);

        $backlink = array();
        if($model_name_plural === 'Reports') {
            if($this->Identity->get('role') === 'admin') {
                array_push($backlink, ['title_part' => 'Admin: ', 'action' => 'indexAdmin']);
            } 
                array_push($backlink, ['title_part' => 'My ', 'action' => 'index']);
        } 
        else {
            array_push($backlink,['title_part' => 'Admin: ', 'action' => 'index']);
        }
        foreach ($backlink as $key => $value) {
            echo $this->Html->link('<i class="bi bi-arrow-left-square"></i>&nbsp;' . $value['title_part'] . $model_name_plural, ['controller' => $model_name_plural, 'action' => $value['action']], ['title' => 'Add ' . $model_name_singular, 'class' => 'side-nav-item', 'escape' => false]);
        }

        if($editable ? $editable : 1==2 ) {
            echo $this->Html->link('<i class="bi bi-caret-right-square"></i>&nbsp;View ' . $model_name_singular, ['controller' => $model_name_plural, 'action' => 'view', $entity->id], ['title' => 'View ' . $model_name_singular, 'class' => 'side-nav-item', 'escape' => false]);

            // echo $this->Html->image('icons/circle_filled_add_292929.svg', ['width' => '20px', 'height' => '20px']) . $this->Html->link(__(' Edit ' . $model_name_singular), ['controller' => $model_name_plural, 'action' => 'edit', $entity->id], ['class' => 'side-nav-item']);

            echo $this->Form->postLink(__('<i class="bi bi-dash-square"></i>&nbsp;Delete ' . $model_name_singular), ['controller' => $model_name_plural, 'action' => 'delete', $entity->id], ['title' => 'Delete ' . $model_name_singular, 'confirm' => __('Are you sure you want to delete {0} {1}?',$model_name_singular, $instance_name), 'class' => 'side-nav-item', 'escape' => false]);
        }
        // echo $this->Html->link('<i class="bi bi-arrow-left-square"></i>&nbsp;' . $model_name_plural, ['controller' => $model_name_plural, 'action' => 'index'], ['title' => 'List of ' . $model_name_plural, 'class' => 'side-nav-item', 'escape' => false]) 
        ?>
    </div>
        <!-- </div> -->
</div>
<!-- 
 #############################################
 ############### Entity View #################
 #############################################
-->
<div class="column">
    <div class="users view content vertical-table">
        <?= $this->Form->create($entity) ?>
        <fieldset>
        <h3 style="word-break: normal;"><?= h($model_name_singular . ': ' . $instance_name) ?></h3>
            <?php foreach ($fields as $field): ?>
                <?php if ($field['access'] === 'user' || $field['access'] === $this->Identity->get('role')) : ?>
                    <?php if ($field['form_options']['type'] == 'checkbox') : ?>
                        <div class="checkbox-container-wrapper">
                            <?= $this->Form->label($field['name'],  __(ucfirst(Inflector::humanize($field['name']))), [
                                    'for' => $field['name'],
                                ]);                    
                            ?>
                            <div class="input checkbox-container">
                                <?= $this->Form->hidden($field['name'], ['value' => 0]); ?>
                                <?= $this->Form->checkbox($field['name'], $field['form_options']); ?>
                                <?php // label wird für Checkbox benötigt
                                echo $this->Form->label('Checkbox Click Area', '', [
                                        'class' => 'checkbox',
                                        'for' => $field['name'],
                                    ]); ?>
                                <span class="checkmark"></span>
                            </div>
                        </div>
                        <?php else : ?>
                        <?= $this->Form->control($field['name'], $field['form_options']); ?>
                    <?php endif; ?>
                <?php else : ?>
                    <label><?= __(ucfirst(Inflector::humanize($field['name']))) ?></label>
                    <p><?= h($field['hidden_value']['display']) ?></p>
                    <?php if($field['hidden_value']): ?>
                        <?= $this->Form->hidden($field['name'], ['value' => $field['hidden_value']['use']]); ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </fieldset>
        <?= $this->Html->Link('Cancel', $this->getRequest()->referer() ? $this->getRequest()->referer() : ['controller' => $model_name_plural, 'action' => 'view', $entity->id], ['type' => 'button', 'class' => 'button', 'title' => 'Cancel']); ?>
        <?= $this->Form->button(__('Save')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
