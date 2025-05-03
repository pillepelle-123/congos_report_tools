<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FailedPasswordAttemptsFixture
 */
class FailedPasswordAttemptsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 'a355e3d2-795c-4d90-9555-afb294cd91e4',
                'user_id' => '227ccbef-7429-4cad-af7d-2b4c8cfe32a3',
                'created' => '2025-05-03 21:01:42',
            ],
        ];
        parent::init();
    }
}
