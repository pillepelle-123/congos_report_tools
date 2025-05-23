<?php
/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

use Cake\Core\Configure;

?>
<div class="users register content">
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __d('cake_d_c/users', 'Add User') ?></legend>
        <?php
        echo $this->Form->control('username', ['label' => __d('cake_d_c/users', 'Username')]);
        echo $this->Form->control('email', ['label' => __d('cake_d_c/users', 'Email')]);
        echo $this->Form->control('password', ['label' => __d('cake_d_c/users', 'Password'), 'id' => 'new-password']);
        if (Configure::read('Users.passwordMeter.enabled')) {
            echo $this->User->addPasswordMeter();
        }
        echo $this->Form->control('password_confirm', [
            'required' => true,
            'type' => 'password',
            'label' => __d('cake_d_c/users', 'Confirm password')
        ]);
        echo $this->Form->control('first_name', ['label' => __d('cake_d_c/users', 'First name')]);
        echo $this->Form->control('last_name', ['label' => __d('cake_d_c/users', 'Last name')]);
        if (Configure::read('Users.Tos.required')) {
            echo $this->Form->control('tos', ['type' => 'checkbox', 'label' => __d('cake_d_c/users', 'Accept TOS conditions?'), 'required' => true]);
        }
        if (Configure::read('Users.reCaptcha.registration')) {
            echo $this->User->addReCaptcha();
        }
        ?>
    </fieldset>
    <?= $this->User->button(__d('cake_d_c/users', 'Register'), ['id' => 'btn-submit']) ?>
    <?= $this->Form->end() ?>
</div>
