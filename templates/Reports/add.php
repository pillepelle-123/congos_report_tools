<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Report $report
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('My Reports'), ['action' => 'listUser'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="reports form content">
            <?= $this->Form->create($report) ?>
            <fieldset>
                <legend><?= __('Add Report') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('xml', ['type' => 'textarea', 'class' => 'form_xml']);
                    if ($this->Identity->get('role') === 'admin') {
                        echo $this->Form->control('user_id', ['options' => $users, 'default'=> $this->Identity->get('id')]);
                    } else {
                        echo $this->Form->hidden('user_id', ['options' => $users, 'default'=> $this->Identity->get('id')]);
                    }
                    //echo $this->Form->control('user_id', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
