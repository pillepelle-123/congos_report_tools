<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php
$fields = [['id', 'admin'], ['name', 'user'], ['user.username', 'admin'], ['xml_length', 'user'], ['created', 'user'], ['modified', 'user']]; // Feldname, 

echo $this->element('standard_list', [

    // 'rel_entity_fields' => [
    //     'Users' => ['username', 'created', 'modified'],
    //     'Tools' => ['name']
    //  ],
    // 'entity_pages' => [$user],
    'entities' => $entities,
    'instance_name' => 'name',
    'fields' => $fields,
    // 'related_entities' => [],
    'editable' => true,

    // 'additional' => []
]);
?>