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
<div class="users login content">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <h3><b>C</b>ongos <b>R</b>eport <b>T</b>ools</h3>
        <p> <?= h('Bitte logge dich ein.')?></p>
        <?= $this->Form->control('username', ['label' => __d('cake_d_c/users', 'Username'), 'required' => true]) ?>
        <?= $this->Form->control('password', ['label' => __d('cake_d_c/users', 'Password'), 'required' => true]) ?>
        <?php
        if (Configure::read('Users.reCaptcha.login')) {
            echo $this->User->addReCaptcha();
        }
        if (Configure::read('Users.RememberMe.active')) {
            // echo $this->Form->control(Configure::read('Users.Key.Data.rememberMe'), [
            //     'type' => 'checkbox',
            //     'label' => __d('cake_d_c/users', 'Remember me'),
            //     'checked' => Configure::read('Users.RememberMe.checked')
            // ]);
            ?>
            
            <?php // $this->Form->label('Remember me',  __(ucfirst('Remember me')), ['for' => Configure::read('Users.Key.Data.rememberMe')]);                    
            ?>
                <?= __d('cake_d_c/users', 'Remember me') ?>
            <div class="input checkbox-container">
                <?php // $this->Form->hidden(Configure::read('Users.Key.Data.rememberMe'), ['value' => 0]); ?>
                <?= $this->Form->checkbox(Configure::read('Users.Key.Data.rememberMe'), [
                'type' => 'checkbox',
                'label' => __d('cake_d_c/users', 'Remember me'),
                'checked' => Configure::read('Users.RememberMe.checked')
                ]); ?>
                <?php // label wird für Checkbox benötigt
                echo $this->Form->label('Checkbox Click Area', '', [
                        'class' => 'checkbox',
                        'for' => Configure::read('Users.Key.Data.rememberMe'),
                    ]); ?>
                <span class="checkmark"></span>
            </div>
            <?php
        }
        ?>
        <?php
        // $registrationActive = Configure::read('Users.Registration.active');
        // if ($registrationActive) {
        //     echo $this->Html->link(__d('cake_d_c/users', 'Register'), ['action' => 'register']);
        // }
        // if (Configure::read('Users.Email.required')) {
        //     if ($registrationActive) {
        //         echo ' | ';
        //     }
        //     // echo $this->Html->link(__d('cake_d_c/users', 'Reset Password'), ['action' => 'requestResetPassword']);
        //     // if (Configure::read('OneTimeLogin.enabled')) {
        //     //     echo ' | ';
        //     //     echo $this->Html->link(__d('cake_d_c/users', 'Send me a login link'), ['controller' => 'Users', 'action' => 'requestLoginLink'], ['allowed' => true, 'escape' => false]);
        //     // }
        // }
        ?>
    </fieldset>
    <?= implode(' ', $this->User->socialLoginList()); ?>
    <?= $this->User->button(__d('cake_d_c/users', 'Login')); ?>
    <?= $this->Form->end() ?>
</div>
