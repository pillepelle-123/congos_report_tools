<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tool $tool
 */
?>
<?php
$fields = [
    ['name' => 'id', 'type' => 'display', 'access' => 'admin'],
    ['name' => 'name', 'type' => 'display', 'access' => 'admin'],
    ['name' => 'description', 'type' => 'display', 'access' => 'admin'],
    ['name' => 'icon', 'type' => 'image_display', 'access' => 'admin'],
    ['name' => 'plugin', 'type' => 'display', 'access' => 'admin'],
    ['name' => 'controller', 'type' => 'display', 'access' => 'admin'],
    ['name' => 'action', 'type' => 'display', 'access' => 'admin'],
    ['name' => 'active', 'type' => 'display', 'access' => 'admin'],
    ['name' => 'created', 'type' => 'display', 'access' => 'admin'],
    ['name' => 'modified', 'type' => 'display', 'access' => 'admin']
];
    // 'name', 'description', 'icon', 'plugin', 'controller', 'action', 'active', 'created', 'modified'];

    // $report->hasValue('user') ? $this->Html->link($report->user->username, ['controller' => 'Users', 'action' => 'view', $report->user->id]) : '';

echo $this->element('standard_view', [


    'rel_entity_fields' => [
        // 'Users' => ['username', 'created', 'modified'],
        // 'Tools' => ['name']
     ],
    'rel_entity_pages' => [], // [$user, $tool], 
    'entity' => $entity,
    'instance_name' => $entity->name,
    'fields' => $fields,
    'editable' => false,

    // 'additional' => []
]);
?>
