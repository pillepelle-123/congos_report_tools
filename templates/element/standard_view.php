<?php
use Cake\Utility\Inflector;
?>
<!-- 
 #############################################
 ################## Actions ##################
 #############################################
-->
<div class="actions-container">
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
            echo $this->Html->link('<i class="bi bi-pencil-square"></i>&nbsp;Edit ' . $model_name_singular, ['controller' => $model_name_plural, 'action' => 'edit', $entity->id], ['class' => 'side-nav-item', 'escape' => false]);

            // echo $this->Html->image('icons/circle_filled_add_292929.svg', ['width' => '20px', 'height' => '20px']) . $this->Html->link(__(' Edit ' . $model_name_singular), ['controller' => $model_name_plural, 'action' => 'edit', $entity->id], ['class' => 'side-nav-item']);

            echo $this->Form->postLink(__('<i class="bi bi-dash-square"></i>&nbsp;Delete ' . $model_name_singular), ['controller' => $model_name_plural, 'action' => 'delete', $entity->id], ['confirm' => __('Are you sure you want to delete {0} {1}?',$model_name_singular, $instance_name), 'class' => 'side-nav-item', 'escape' => false]);
        }
        // echo $this->Html->link('<i class="bi bi-arrow-left-square"></i>&nbsp;' . $model_name_plural, ['controller' => $model_name_plural, 'action' => 'index'], ['class' => 'side-nav-item', 'escape' => false]) 
        ?>
    </div>
</div>
<!-- 
 #############################################
 ############### Entity View #################
 #############################################
-->
<div class="column">
    <div class="users view content vertical-table">
        <h3 style="word-break: normal;"><?= h($model_name_singular . ': ' . $instance_name) ?></h3>
        <table>
            <?php foreach ($fields as $field): ?>
                <?php if ($field['access'] === 'user' || $field['access'] === $this->Identity->get('role')) : ?>
                    <tr>
                        <th><?= __(ucfirst(Inflector::humanize($field['name']))) ?></th>
                        <?php if ($field['type'] == 'display') : ?>
                            <td><?= h($entity->{$field['name']} . ' ') ?></td>
                        <?php elseif ($field['type'] == 'fieldset') : ?>
                            <td>
                                <fieldset class="form-group card-body fieldset-xml">
                                    
                                        <span>
                                        <?= h($entity->{$field['name']}) ?>
                                        </span>
                                </fieldset>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endif; ?>
                <!-- <tr>
                    <th><?php // __(ucfirst(Inflector::humanize($field))) ?></th>
                    <td><?php // h($entity->{$field} . ' ') ?></td>
                </tr> -->
            <?php endforeach; ?>
        </table>
    </div>
</div>
<!-- 
#############################################
########### Related Entities ################
#############################################
-->
<div class="column">
    <?php if (isset($rel_entity_pages) && !empty($rel_entity_pages)) : ?>
    <?php foreach ($rel_entity_pages as $key => $rel_entity_page): ?>
        <?php //echo debug($related_entitiy->params->count); die(); ?>
    
        <?php if (isset($rel_entity_page) && !empty($rel_entity_page) && !empty($rel_entity_page->toArray()[0])  /*&& count($related_entity) > 0*/) : ?>
        <div class="users view content" style="margin-top:20px;">
            <div class="related">
                <?php 
                    $rel_entity_model_plural = $rel_entity_page->toArray()[0]->getSource();
                    $rel_entity_model_singular = Inflector::singularize($rel_entity_model_plural);
                    $rel_entity_display_field = '';

                    if (count($rel_entity_page) < 2 ) {
                        $rel_entity_display_field = $rel_entity_model_singular;
                    } else {
                        $rel_entity_display_field = $rel_entity_model_plural;
                    }
                ?>
                <h3><?= __($model_name_plural . ' ' . $rel_entity_display_field) ?></h3>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <?php //debug($rel_entitiy_page->toArray()[0]->getSource()); ?>
                        <?php foreach ($rel_entity_fields[$rel_entity_model_plural] as $rel_entity_field ) : ?>
                            <th><?= $this->Paginator->sort( __($rel_entity_field)) ?></th>
                        <?php endforeach; ?>
                        <th class="actions"><?php echo __('Actions') ?></th>
                        </thead>
                        <tbody>
                            <?php // debug($rel_entitiy_page); 
                            //$i = 0;
                            ?>
                            <?php foreach ($rel_entity_page->toArray() as $rel_entity): ?> <!--related_entitiy_item = einzelner Report -->
                                <tr>
                                    <?php foreach ($rel_entity_fields[$rel_entity_page->toArray()[0]->getSource()] as $rel_entity_field ) : ?>
                                        <td><?= h($rel_entity->{$rel_entity_field} . ' ') ?></td>
                                    <?php endforeach; ?>
                                    <td class="actions">
                                        <?= $this->Html->link('<i class="bi bi-caret-right-square"></i>', ['controller' => $rel_entity->getSource(), 'action' => 'view', $rel_entity->id], ['escape' => false, 'title' => __('View')]); ?>
                                        <?php // $this->Html->image('icons/material_view_292929.svg', array('title' => 'View', 'alt' => 'View', 'url' => ['controller' => $rel_entity->getSource(), 'action' => 'view', $rel_entity->id])); ?>
                                        <?= $this->Html->link('<i class="bi bi-pencil-square"></i>', ['controller' => $rel_entity->getSource(), 'action' => 'edit', $rel_entity->id], ['escape' => false, 'title' => __('View')]); ?>
                                        <?php // $this->Html->image('icons/material_edit_292929.svg', array('title' => 'Edit', 'alt' => 'Edit', 'url' => ['controller' => $rel_entity->getSource(), 'action' => 'edit', $rel_entity->id])); ?>

                                        <?=  $this->Form->postLink('<i class="bi bi-dash-square"></i>', ['controller' => $rel_entity->getSource(), 'action' => 'delete', $rel_entity->id], ['confirm' => __('Are you sure you want to delete the {0}?',Inflector::singularize($rel_entity->getSource())), 'escape' => false]
                                        ) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php //$i++; ?>
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
            </div>
        
        </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
