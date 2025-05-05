<?php
namespace App\Model\Table;

use CakeDC\Users\Model\Table\UsersTable as BaseUsersTable;

class MyUsersTable extends BaseUsersTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        
        $this->hasMany('Reports', [
            'className' => 'Reports',
            'foreignKey' => 'user_id',
            'propertyName' => 'reports' // Wichtig für korrekte Property
        ]);
    }
}