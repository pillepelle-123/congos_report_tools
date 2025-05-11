<?php
use Cake\Utility\Inflector;
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?php // $this->Html->link(__('Related Reports'), '#reports', ['class' => 'side-nav-item'])
            $entityName = (new \ReflectionClass($entity))->getShortName(); // Singular
            $controllerName = Inflector::pluralize($entityName);

            echo $this->Html->link(__('Edit ' . $entityName), ['controller' => $controllerName, 'action' => 'edit', $entity->id], ['class' => 'side-nav-item']);
            echo $this->Form->postLink(__('Delete ' . $entityName), ['controller' => $controllerName, 'action' => 'delete', $entity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $entity->id), 'class' => 'side-nav-item']);
            echo $this->Html->link('◀ Admin: ' . $controllerName, ['controller' => $controllerName, 'action' => 'listAdmin'], ['class' => 'side-nav-item']) 
            ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users view content vertical-table">
            <h3><?= h($entity->name) ?></h3>
            <table>
                <?php foreach ($fields as $field): ?>
                    <?php if (isset($entity->{$field}) && !empty($entity->{$field})): ?>
                        <tr>
                            <th><?= __($field) ?></th>
                            <td><?= h($entity->{$field} . ' ') ?></td>
                        </tr>
                    <?php endif; ?> 
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
    <div class="column column-20">
        <?php if (isset($rel_entity_pages) && !empty($rel_entity_pages)) : ?>
        <?php foreach ($rel_entity_pages as $key => $rel_entitiy_page): ?>
            <?php //echo debug($related_entitiy->params->count); die(); ?>
      
            <?php if (isset($rel_entitiy_page) && !empty($rel_entitiy_page) && !empty($rel_entitiy_page->toArray()[0])  /*&& count($related_entity) > 0*/) : ?>
            <div class="users view content" style="margin-top:20px;">
                <div class="related">
                    <h3><?= __('Related ' . $rel_entitiy_page->toArray()[0]->getSource()) ?></h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <?php //debug($rel_entitiy_page->toArray()[0]->getSource()); ?>
                            <?php foreach ($rel_entity_fields[$rel_entitiy_page->toArray()[0]->getSource()] as $rel_entity_field ) : ?>
                                <th><?= $this->Paginator->sort( __($rel_entity_field)) ?></th>
                            <?php endforeach; ?>
                            <th class="actions"><?php echo __('Actions') ?></th>
                            </thead>
                            <tbody>
                                <?php // debug($rel_entitiy_page); 
                                $i = 0;
                                ?>
                            <?php foreach ($rel_entitiy_page->toArray() as $rel_entity): ?> <!--related_entitiy_item = einzelner Report -->
                                <tr>
                            <?php foreach ($rel_entity_fields[$rel_entitiy_page->toArray()[0]->getSource()] as $rel_entity_field ) : ?>
                                <td><?= h($rel_entity->{$rel_entity_field} . ' ') ?></td>
                            <?php endforeach; ?>
                                    <td class="actions">
                                        <?= $this->Html->image('icons/material_view_292929.svg', array('title' => 'View', 'alt' => 'View', 'url' => ['controller' => $rel_entity->getSource(), 'action' => 'view', $rel_entity->id])); ?>
                                        <?= $this->Html->image('icons/material_edit_292929.svg', array('title' => 'Edit', 'alt' => 'Edit', 'url' => ['controller' => $rel_entity->getSource(), 'action' => 'edit', $rel_entity->id])); ?>

                                        <?=  $this->Form->postLink(
                                            $this->Html->image('icons/material_delete_292929.svg', ['alt' => 'Delete']), ['controller' => $rel_entity->getSource(), 'action' => 'delete', $rel_entity->id], ['confirm' => 'Möchtest du den Report wirklich löschen?', 'escape' => false]
                                        ) ?>
                                    </td>
                    
            </tr>
        <?php endforeach; ?>
        <?php $i++; ?>
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
        <?php endif; ?>
            </div>

        <?php endforeach; ?>
        <?php endif; ?>

<?php /*
            <div class="users view content" style="margin-top:20px;">
                <div class="related">
                    <h3 id="reports"><?= __($related_entitiy->toArray()[0]->getSource()) ?></h3>
                    <?php // if (isset($related_entitiy)) : ?>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <?php foreach ($related_fields as $related_field) : ?>
                                    <tr>
                                        <th><?= $this->Paginator->sort('Name') ?></th>                            
                                        <!-- <th class="actions"><?php //echo __('Actions') ?></th> -->
                                    </tr>
                                <?php endforeach; ?>
                            </thead>
                            <tbody>
                            <?php foreach ($related_fields as $related_field) : ?>

                            <?php //foreach ($relatedFields as $related_entitiy_item) : ?> 

                                <tr>
                                    <td><?= h($related_entitiy->{$related_field}) ?></td>
                                    <?php 
                                    <td class="actions">
                                        <?= // $this->Html->image('icons/material_view_292929.svg', array('title' => 'View', 'alt' => 'View', 'url' => ['controller' => $related_entitiy_item->getSource(), 'action' => 'view', $related_entitiy_item->id])); ?>
                                        <?= // $this->Html->image('icons/material_edit_292929.svg', array('title' => 'Edit', 'alt' => 'Edit', 'url' => ['controller' => $related_entitiy_item->getSource(), 'action' => 'edit', $related_entitiy_item->id])); ?>

                                        <?= // $this->Form->postLink(
                                            $this->Html->image('icons/material_delete_292929.svg', ['alt' => 'Delete']), ['controller' => $related_entitiy_item->getSource(), 'action' => 'delete', $related_entitiy_item->id], ['confirm' => 'Möchtest du den Report wirklich löschen?', 'escape' => false]
                                        ) ?>
                                    </td>
                                     ?>
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
                */ ?>
                <!-- </div> -->
                
                <?php
                // End of file
                ?>
            <!-- </div> -->
        <?php // endforeach; ?>
    <?php // endif ?>
<!-- </div> -->
