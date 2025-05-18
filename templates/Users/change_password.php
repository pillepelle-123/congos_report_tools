<div class="users change_password content">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <h3><?= __($this->get('title')) ?></h3>
        <?php if ($validatePassword) : ?>
            <?= $this->Form->control('current_password', [
                'type' => 'password',
                'required' => true,
                'label' => __d('cake_d_c/users', 'Current password')]);
            ?>
        <?php endif; ?>
        <?= $this->Form->control('password', [
            'type' => 'password',
            'required' => true,
            'id' => 'new-password',
            'label' => __d('cake_d_c/users', 'New password')]);
        ?>
        <?php if (\Cake\Core\Configure::read('Users.passwordMeter.enabled')) : ?>
            <?= $this->User->addPasswordMeter() ?>
        <?php endif; ?>
        <?= $this->Form->control('password_confirm', [
            'type' => 'password',
            'required' => true,
            'label' => __d('cake_d_c/users', 'Confirm password')]);
        ?>

    </fieldset>
    <?= $this->Form->button(__d('cake_d_c/users', 'Save'), ['id' => 'btn-submit']); ?>
    <?= $this->Form->end() ?>   
</t>
