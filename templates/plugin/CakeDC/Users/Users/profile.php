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
?>
<div class="users">
    <h3><?= $this->Html->image(
            empty($user->avatar) ? $avatarPlaceholder : $user->avatar,
            ['width' => '180', 'height' => '180']
        ); ?></h3>
    <h3>
        <?=
        $this->Html->tag(
            'span',
            __d('cake_d_c/users', '{0} {1}', $user->first_name, $user->last_name),
            ['class' => 'full_name']
        )
        ?>
    </h3>
    <?php if ($isCurrentUser) : ?>
        <?= $this->Html->link(__d('cake_d_c/users', 'Change Password'), ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'changePassword']); ?>
    <?php endif; ?>
    <div class="row">
        <div class="large-6 columns strings">
            <h6 class="subheader"><?= __d('cake_d_c/users', 'Username') ?></h6>
            <p><?= h($user->username) ?></p>
            <h6 class="subheader"><?= __d('cake_d_c/users', 'Email') ?></h6>
            <p><?= h($user->email) ?></p>
        </div>
    </div>
</div>
