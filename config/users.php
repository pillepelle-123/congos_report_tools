<?php

return[
    'OneTimePasswordAuthenticator.login' => false,

     'Users' => [
        'table' => 'Users',
        'controller' => 'Users',
     ],
    //     'table' => 'users',
    //     'modelClass' => 'Users',
    //     'userModel' => 'Users',
    //     'passwordHasher' => [
    //         'className' => \Cake\Auth\DefaultPasswordHasher::class,
    //         'hashType' => 'sha256',
    //         'hashOptions' => ['cost' => 12],
    //     ],
    //     // Uncomment the line below to use your custom users.php config file
    //     // 'config' => ['users'],
    // ],
    'Auth' => [
        'Authorization' => [
            'localeAware' => false // Wichtig!
        ]
    ]
];