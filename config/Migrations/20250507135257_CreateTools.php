<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateTools extends BaseMigration
{
    public bool $autoId = false;

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('tools');
        $table->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('controller', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('action', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addIndex([
            'description',
        
            ], [
            'name' => 'BY_DESCRIPTION',
            'unique' => false,
        ]);
        $table = $this->table('tools', ['id' => false, 'primary_key' => ['id']]);
        $table
              ->addColumn('id', 'integer')
              ->create();
    }
}
