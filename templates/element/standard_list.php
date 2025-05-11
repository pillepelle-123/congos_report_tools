<?php
use Cake\Utility\Inflector;
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Report> $entities
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?php
            $entity_name = (new \ReflectionClass($entities->toArray()[0]))->getShortName(); // Singular
            $controller_name = Inflector::pluralize($entity_name);
            
            if($editable ? $editable : 1==2 ) {
                echo $this->Html->link(__('New ' . $entity_name), ['controller' => $controller_name, 'action' => 'add'], ['class' => 'side-nav-item']);
            }
            ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users list_admin content">
            <h3><?=__($this->get('title')) ?></h3>
            <div class="table-responsive">
            <table>
                <thead>
                    <?php foreach ($fields as $field ) : ?>
                        <?php if ($field[1] === 'user' || $field[1] === $this->Identity->get('role')) : ?>
                            <th><?= $this->Paginator->sort( __(explode('.', $field[0])[0])) ?></th>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <th class="actions"><?= __('Actions') ?></th>
                </thead>
                <tbody>
                    <?php foreach ($entities->toArray() as $entity ) : ?>
                        <tr>
                    <?php foreach ($fields as $field ) : ?>
                        <?php if ($field[1] === 'user' || $field[1] === $this->Identity->get('role')) : ?>
                        <?php if (str_contains($field[0], '.')) : ?>
                            <?php
                                $rel_entity = explode('.', $field[0])[0]; 
                                $rel_field = explode('.', $field[0])[1]; 
                                $rel_controller_name = Inflector::pluralize($rel_entity); // Plural
                            ?>
                            <td><?= $this->Html->link($entity->{$rel_entity}->{$rel_field}, ['controller' => $rel_controller_name, 'action' => 'view', $entity->{$rel_entity}->id]) ?></td>
                        <?php else: ?>
                            <td><?= h($entity->{$field[0]} . ' ') ?></td>
                        <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                            <td class="actions">
                            <?php

                                

                                echo $this->Html->image('icons/material_view_292929.svg', array('title' => 'View', 'alt' => 'View', 'url' => ['controller' => $controller_name, 'action' => 'view', $entity->id]));
                                if($editable ? $editable : 1==2 ) {
                                    echo $this->Html->image('icons/material_edit_292929.svg', array('title' => 'Edit', 'alt' => 'Edit', 'url' => ['controller' => $controller_name, 'action' => 'edit', $entity->id]));
                                    echo $this->Form->postLink(
                                    $this->Html->image('icons/material_delete_292929.svg', ['alt' => 'Delete']), ['controller' => $controller_name, 'action' => 'delete', $entity->id], ['confirm' => 'Möchtest du diesen ' . $entity_name . ' wirklich löschen?', 'escape' => false]) ;
                                }
                                
                                ?>
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
</div>            
<?php /*
<div class="reports list_user content">
    <?= $this->Html->link(__('New Report'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __($this->get('title')) ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <?php
                    <th><?php // $this->Paginator->sort('id') ?></th>
                    <th><?php // $this->Paginator->sort('user_id') ?></th>
                    ?>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entities as $entity): ?>
                <tr>
                    <?php
                    <td><?php // $this->Number->format($report->id) ?></td>
                    <td><?php // $report->hasValue('user') ? $this->Html->link($report->user->username, ['controller' => 'Users', 'action' => 'view', $report->user->id]) : '' ?></td>
                    ?>
                    <td><?= h($entity->name) ?></td>
                    <td><?= h($entity->created) ?></td>
                    <td><?= h($entity->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->image('icons/material_view_292929.svg', array('title' => 'View', 'alt' => 'View', 'url' => ['action' => 'view', $entity->id])); ?>
                        <?= $this->Html->image('icons/material_edit_292929.svg', array('title' => 'Edit', 'alt' => 'Edit', 'url' => ['action' => 'edit', $entity->id])); ?>
                        <?= $this->Form->postLink(
                            $this->Html->image('icons/material_delete_292929.svg', ['alt' => 'Delete']), ['action' => 'delete', $entity->id], ['confirm' => 'Möchtest du diesen Eintrag wirklich löschen?', 'escape' => false]
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
*/ ?>