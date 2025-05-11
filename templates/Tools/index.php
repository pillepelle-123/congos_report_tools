<?php
$fields = [['id', 'admin'], ['name', 'admin'], ['icon', 'admin'], ['plugin', 'admin']]; // Feldname, 

echo $this->element('standard_list', [

    // 'rel_entity_fields' => [
    //     'Users' => ['username', 'created', 'modified'],
    //     'Tools' => ['name']
    //  ],
    // 'entity_pages' => [$user],
    'entities' => $entities,
    'fields' => $fields,
    'related_entities' => [],
    'editable' => false,
    // 'additional' => []
]);
?>
