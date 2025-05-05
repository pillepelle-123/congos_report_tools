<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Report $report
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $report->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $report->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('My Reports'), ['action' => 'listUser'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="reports form content">
            <?= $this->Form->create($report) ?>
            <fieldset>
                <legend><?= __('Edit Report') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('xml', ['type' => 'textarea', 'class' => 'form-xml']);
                    if ($this->Identity->get('role') === 'admin') {
                        echo $this->Form->control('user_id', ['options' => $users, 'default'=> $this->Identity->get('id')]);
                    } 
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
