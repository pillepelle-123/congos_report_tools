<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * Users seed.
 */
class UsersSeed extends BaseSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/migrations/4/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            'id' => 0,
            'username' => 'pillepelle',
            'email' => 'pillepelle@freenet.de',
            'password' => 'djembe32',
            'active' => 1,
            'is_superuser' => 1,
            'role' => 'admin',
            'created' => '2025-05-03 22:29:00',
            'modified' => '2025-05-03 22:29:01',
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
