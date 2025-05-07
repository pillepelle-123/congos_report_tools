<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Report $report
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('◀ My Reports'), ['action' => 'listUser'], ['class' => 'side-nav-item']) ?>
            <?php if ($this->Identity->get('role') === 'admin') {
                echo $this->Html->link(__('◀ Admin: Reports'), ['action' => 'listAdmin'], ['class' => 'side-nav-item']);
            } ?>

        </div>
    </aside>
    <div class="column column-80">
        <div class="reports add content">
            <?= $this->Form->create($report) ?>
            <fieldset>
                <!-- <h3><?= __($this->get('title')) ?></h3> -->
                <?php
                    $usernames = [];
                    foreach ($users as $user) {
                        $usernames[$user->id] = $user->username;
                    }

                    echo $this->Form->control('name');
                    echo $this->Form->control('xml', ['type' => 'textarea', 'class' => 'form_xml']);
                    if ($this->Identity->get('role') === 'admin') {
                        echo $this->Form->control('user_id', ['options' => $usernames, 'default'=> $this->Identity->get('id')]);
                    }
                    //echo $this->Form->control('user_id', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
