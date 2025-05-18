<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Report> $reports
 */
?>

<?php
$fields = [['id', 'admin'], ['name', 'user'], ['user.username', 'admin'], ['created', 'user'], ['modified', 'user']]; // Feldname, 

echo $this->element('standard_list', [

    // 'rel_entity_fields' => [
    //     'Users' => ['username', 'created', 'modified'],
    //     'Tools' => ['name']
    //  ],
    // 'entity_pages' => [$user],
    'entities' => $entities,
    'fields' => $fields,
    // 'related_entities' => [$users],
    'editable' => true,
]);
?>