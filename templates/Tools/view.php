<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tool $tool
 */
?>
<?php
$fields = ['id', 'name', 'description', 'icon', 'plugin', 'controller', 'action', 'active', 'created', 'modified'];

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
