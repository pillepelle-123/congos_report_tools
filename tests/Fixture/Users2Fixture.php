<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Users2Fixture
 */
class Users2Fixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'users2';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 'fc119ef7-e8c3-4172-aa69-51d806e06968',
                'username' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'token' => 'Lorem ipsum dolor sit amet',
                'token_expires' => '2025-05-03 20:38:12',
                'api_token' => 'Lorem ipsum dolor sit amet',
                'activation_date' => '2025-05-03 20:38:12',
                'secret' => 'Lorem ipsum dolor sit amet',
                'secret_verified' => 1,
                'tos_date' => '2025-05-03 20:38:12',
                'active' => 1,
                'is_superuser' => 1,
                'role' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-05-03 20:38:12',
                'modified' => '2025-05-03 20:38:12',
                'additional_data' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'last_login' => '2025-05-03 20:38:12',
                'lockout_time' => '2025-05-03 20:38:12',
                'login_token' => 'Lorem ipsum dolor sit amet',
                'login_token_date' => '2025-05-03 20:38:12',
                'token_send_requested' => 1,
            ],
        ];
        parent::init();
    }
}
