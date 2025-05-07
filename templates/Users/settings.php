<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <?php /*
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside> */
    ?>
    <div class="column <?php //column-80 ?>">
        <div class="users settings content">
        <h3><?= $this->get('title') ?></h3>
            <?= $this->Form->create($user) ?>
            <fieldset>
                <?php
                    echo '<label>'.__('User').'</label>';
                    echo '<p>'.h($user->username).'</p>';
                    //echo h($user->username);
                    //echo'<h3>'.h($user->username).'</h3>';
                    echo $this->Form->control('email');
                    echo '<label>'.__('Password').'</label>';
                    echo '<p>'.$this->Html->link(__('Change Password'), ['controller' => 'Users', 'action' => 'changePassword', $user->id]).'</p>';                    
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo '<label>'.__('Role').'</label>';
                    echo '<p>'.h($user->role).'</p>';
                    echo '<label>'.__('Last Login').'</label>';
                    echo '<p>'.h(date_format($user->last_login,"d.m.Y | H:i:s")).'</p>';
                    echo '<label>'.__('User Creation Date').'</label>';
                    echo '<p>'.h($user->created).'</p>';
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
