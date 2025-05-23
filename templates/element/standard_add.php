<?php
use Cake\Utility\Inflector;
?>
<?php 
    // debug($this->getRequest()->getQuery('referer'));
    // die();
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

        // debug($backlink);
        // die();

        foreach ($backlink as $key => $value) {
            echo $this->Html->link('<i class="bi bi-arrow-left-square"></i>&nbsp;' . $value['title_part'] . $model_name_plural, ['controller' => $model_name_plural, 'action' => $value['action']], ['title' => 'Add ' . $model_name_singular, 'class' => 'side-nav-item', 'escape' => false]);
        }

        // // if ($this->Identity->get('role') === 'admin' && $model_name_plural === 'Reports') {
        //     echo $this->Html->link('<i class="bi bi-arrow-left-square"></i>&nbsp;' . $title_part . $model_name_plural, ['controller' => $model_name_plural, 'action' => 'indexAdmin'], ['title' => 'Add ' . $model_name_singular, 'class' => 'side-nav-item', 'escape' => false]);
        // // } 
        // // else if ($this->Identity->get('role') === 'user') {
        //     echo $this->Html->link('<i class="bi bi-arrow-left-square"></i>&nbsp;My ' . $model_name_plural, ['controller' => $model_name_plural, 'action' => 'index'], ['title' => 'List of ' . $model_name_plural, 'class' => 'side-nav-item', 'escape' => false]);
        // // }
        ?>
    </div>
        <!-- </div> -->
</div>
<div class="column">
    <div class="users add content vertical-table">
        <?= $this->Form->create($newEntity) ?>
        <fieldset>
        <h3 style="word-break: normal;"><?= h('Add ' . $model_name_singular) ?></h3>
        <?php // debug($this->getRequest()->getSession()->read('clickpath')); /*[1]['url']); */ die(); ?>

            <?php foreach ($fields as $field): ?>
                <?php if ($field['access'] === 'user' || $field['access'] === $this->Identity->get('role')) : ?>
                    <?= $this->Form->hidden($field['name'], $field['form_options']); ?>
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
                <?php else : ?>
                    <label><?= __(ucfirst(Inflector::humanize($field['name']))) ?></label>
                    <?php //if (isset($entity->{$field}) && !empty($entity->{$field})): ?>
                       <p><?= h($this->Identity->get('username')) ?></p>
                    <?php //endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </fieldset>
        <?= $this->Html->Link('Cancel', $this->getRequest()->referer() ? $this->getRequest()->referer() : ['controller' => $model_name_plural, 'action' => 'view', $entity->id], ['type' => 'button', 'class' => 'button', 'title' => 'Cancel']); ?>
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
        <?= $this->Html->Link('Cancel', $this->getRequest()->referer() ? $this->getRequest()->referer() : ['controller' => $model_name_plural, 'action' => 'view', $entity->id], ['type' => 'button', 'class' => 'button', 'title' => 'Cancel']); ?>
        <?= $this->Form->button(__('Save')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
*/ ?>
