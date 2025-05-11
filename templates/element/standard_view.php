<t?php
use Cake\Utility\Inflector;
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Users Reports'), '#reports', ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $entity->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $entity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $entity->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('◀ Admin: Users'), ['action' => 'listAdmin'], ['class' => 'side-nav-item']) ?>
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
        <?php if (isset($related_entities) && !empty($related_entities)) : ?>
        <?php foreach ($related_entities as $related_entitiy): ?>
            <?php //echo debug($related_entitiy->params->count); die(); ?>
            
            <?php if (isset($related_entitiy) && !empty($related_entitiy) /*&& count($related_entity) > 0*/) : ?>
            <div class="users view content" style="margin-top:20px;">
                <div class="related">
                    <h3><?= __($related_entitiy->toArray()[0]->getSource()) ?></h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                            <?php foreach ($related_fields['reports'] as $related_field ) : ?>
                                <th><?= $this->Paginator->sort( __($related_field)) ?></th>
                            <?php endforeach; ?>
                            <th class="actions"><?php echo __('Actions') ?></th>
                            </thead>
                            <tbody>
                            <?php foreach ($related_entitiy as $related_entitiy_item): ?> <!--related_entitiy_item = einzelner Report -->
                                <tr>
                            <?php foreach ($related_fields['reports'] as $related_field ) : ?>
                                        <td><?= h($related_entitiy_item->{$related_field} . ' ') ?></td>
                            <?php endforeach; ?>
                                    <td class="actions">
                                        <?= $this->Html->image('icons/material_view_292929.svg', array('title' => 'View', 'alt' => 'View', 'url' => ['controller' => $related_entitiy_item->getSource(), 'action' => 'view', $related_entitiy_item->id])); ?>
                                        <?= $this->Html->image('icons/material_edit_292929.svg', array('title' => 'Edit', 'alt' => 'Edit', 'url' => ['controller' => $related_entitiy_item->getSource(), 'action' => 'edit', $related_entitiy_item->id])); ?>

                                        <?=  $this->Form->postLink(
                                            $this->Html->image('icons/material_delete_292929.svg', ['alt' => 'Delete']), ['controller' => $related_entitiy_item->getSource(), 'action' => 'delete', $related_entitiy_item->id], ['confirm' => 'Möchtest du den Report wirklich löschen?', 'escape' => false]
                                        ) ?>
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
                        <p class="paginator-counter"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
                    </div>
     </div>
     </div>
        <?php endif; ?>

        <?php endforeach; ?>
        <?php endif; ?>
    </div>

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
