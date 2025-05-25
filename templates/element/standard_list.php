<?php
use Cake\Utility\Inflector;
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Report> $entities
 */
?>
<!-- 
 #############################################
 ################## Actions ##################
 #############################################
-->
<div class="actions-container">
    <div class="links">
        <?php // $this->Html->link(__('Related Reports'), '#reports', ['class' => 'side-nav-item'])
        // debug($entities->pagingParams()['alias']);
        // if(count($entities) > 0) {
        $model_name_plural = $entities->pagingParams()['alias'];
        $model_name_singular = Inflector::singularize($model_name_plural);

        // $model_name_singular = (new \ReflectionClass($entities->toArray()[0]))->getShortName(); // Singular
        // $model_name_plural = Inflector::pluralize($model_name_singular);

        $link_addon = '';
        if ($model_name_singular == 'Report') {
            $link_addon = $this->getTemplate() === 'index' ? 'user' : 'admin';                
        }

        if($editable ? $editable : 1==2 ) {
            echo $this->Html->link('<i class="bi bi-plus-square"></i>&nbsp; Add ' . $model_name_singular, ['controller' => $model_name_plural, 'action' => 'add'], ['title' => 'Add ' . $model_name_singular, 'class' => 'side-nav-item', 'escape' => false]); // /*'?' => ['template' => $this->getTemplate()]*
        }
        // }

        // echo $this->Html->link('<i class="bi bi-arrow-left-square"></i>&nbsp;' . $model_name_plural, ['controller' => $model_name_plural, 'action' => 'index'], ['title' => 'List of ' . $model_name_plural, 'class' => 'side-nav-item', 'escape' => false]);
        ?>
    </div>
</div>
<!-- 
 #############################################
 ############### Entity View #################
 #############################################
-->
<div class="row">
    <?php /*
    <aside class="column">
        
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?php
            $model_name_singular = (new \ReflectionClass($entities->toArray()[0]))->getShortName(); // Singular
            $model_name_plural = Inflector::pluralize($model_name_singular);

            // Besonderheit für Reports: Unterscheidung zwischen Admin und User
            $link_addon = '';
            if ($model_name_singular == 'Report') {
                $link_addon = $this->getTemplate() === 'index' ? 'user' : 'admin';                
            }

            if($editable ? $editable : 1==2 ) {
                echo '<i class="fa-solid fa-circle-plus"></i> ' . $this->Html->link(__('New ' . $model_name_singular), ['controller' => $model_name_plural, 'action' => 'add', '?' => ['type' => $link_addon] /], ['class' => 'side-nav-item']); // /*'?' => ['template' => $this->getTemplate()]*
            }
            ?>
        </div>
        
    </aside>
    */ ?>
    <div class="column">
        <div class="list_admin content">
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
                                <?php if (is_numeric($entity->{$field[0]})) : ?>
                                    <td><?= h(number_format($entity->{$field[0]},
                                    0,
                                    ",",
                                    "."
                                )) ?></td>
                                <?php else: ?>
                                    <td><?= h($entity->{$field[0]} . ' ') ?></td>

                                    
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                            <td class="actions">
                            

                            <?= $this->Html->link('<i class="bi bi-caret-right-square"></i>', ['controller' => $model_name_plural, 'action' => 'view', $entity->id], ['escape' => false, 'title' => __('View'), 'id' => 'View', 'alt' => 'View']); ?>

                            <?= $this->Html->link('<i class="bi bi-pencil-square"></i>', ['controller' => $model_name_plural, 'action' => 'edit', $entity->id], ['escape' => false, 'title' => __('Edit'), 'alt' => 'Edit']); ?>

                            <!-- // 'alt' => 'Edit', 'url' => ), ['escape' => false, 'title' => __('View')]; ?> -->

                            <?=  $this->Form->postLink('<i class="bi bi-dash-square"></i>', ['controller' => $model_name_plural, 'action' => 'delete', $entity->id], ['title' => __('Delete'), 'confirm' => __('Are you sure you want to delete {0} {1}?',$model_name_singular, $entity->{$instance_name}), 'escape' => false, 'alt' => 'Delete']
                            ) ?>

                            <!-- Momentan ist hier als Tool fix ID = 1 (entspricht Query Expander) ausgewählt-->
                            <?php if ($model_name_plural === 'Reports'): ?>

                                <?= $this->Html->image('icons/crt_292929.svg', array('title' => 'Run App in Query Expander', 'alt' => 'Run App in Query Expander', 'url' => ['plugin' => 'QueryExpander', 'controller' => 'QueryExpander', 'action' => 'queries', '?' => ['referer' => $this->RefererParam->create( $this->getRequest()->getParam('controller'), $this->getRequest()->getParam('action')), 'tool' => 1, 'report' => $entity->id]])) ?>

                                <?php // $this->Html->link('Run', ['plugin' => 'QueryExpander', 'controller' => 'QueryExpander', 'action' => 'queries', '?' => ['referer' => $this->RefererParam->create( $this->getRequest()->getParam('controller'), $this->getRequest()->getParam('action')), 'tool' => 1, 'report' => $entity->id]], ['escape' => false, 'title' => __('Run'), 'alt' => 'Run']); ?>
                            <?php endif; ?>
                                
                            <?php /*
                                echo $this->Html->image('icons/material_view_292929.svg', array('title' => 'View', 'alt' => 'View', 'url' => ['controller' => $model_name_plural, 'action' => 'view', $entity->id]));
                                if($editable ? $editable : 1==2 ) {
                                    echo $this->Html->image('icons/material_edit_292929.svg', array('title' => 'Edit', 'alt' => 'Edit', 'url' => ['controller' => $model_name_plural, 'action' => 'edit', $entity->id]));
                                    echo $this->Form->postLink(
                                    $this->Html->image('icons/material_delete_292929.svg', ['alt' => 'Delete']), ['controller' => $model_name_plural, 'action' => 'delete', $entity->id], ['confirm' => __('Are you sure you want to delete {0} {1}?',$model_name_singular, $entity->{$instance_name}), 'escape' => false]) ;
                                }
                               */ ?>
                                
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

<!-- <script>

    // Funktionen, um Bootstrap Icons zu ändern. Dafür muss dem Optionen-Attributen der Links folgendes hinzugefügt werden:
    // 'onmouseenter' => 'overIcon(this)', 'onmouseleave' => 'icon(this)'

    function icon(element) {
        var viewIcon = element.children[0];
        var viewIconClass = viewIcon.getAttribute('class');

        // viewIconClass = viewIconClass.replace('-fill', '');

        viewIcon.setAttribute('class', viewIconClass.replace('-fill', ''));
    }

    function overIcon(element) {
        var viewIcon = element.children[0];
        var viewIconClass = viewIcon.getAttribute('class');

        viewIcon.setAttribute('class', viewIconClass + '-fill');
    }

    function changeIcon() {
        // console.log('changeIcon()');
        var viewIcon = document.getElementById('View').children[0];
        console.log(viewIcon);
        if (viewIcon.getAttribute('class') === 'bi bi-caret-right-square') {
            viewIcon.setAttribute('class', 'bi bi-caret-right-square-fill');
        } else {
            viewIcon.setAttribute('class', 'bi bi-caret-right-square');
        }
    }
</script> -->