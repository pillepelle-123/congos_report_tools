<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>

<?php
$fields = [['username', 'admin'], ['email', 'admin'], ['active', 'admin'], ['role', 'admin'], ['created', 'admin'], ['modified', 'admin'], ['last_login', 'admin']]; // Feldname, 

echo $this->element('standard_list', [

    // 'rel_entity_fields' => [
    //     'Users' => ['username', 'created', 'modified'],
    //     'Tools' => ['name']
    //  ],
    // 'entity_pages' => [$user],
    'entities' => $entities,
    'instance_name' => 'username',
    'fields' => $fields,
    'related_entities' => [],
    'editable' => true,
    // 'additional' => []
]);
?>
