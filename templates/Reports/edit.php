<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Report $report
 */
?>
<?php
$fields2 = [['id', 'admin'], ['name', 'user'], ['user.username', 'admin'], ['created', 'user'], ['modified', 'user']]; // Feldname, 

$usernames = [];
foreach ($users as $user) {
    $usernames[$user->id] = $user->username;
}
$fields = [
    [
        'name' => 'name', 
        'form_options' => [
            'type' => 'text',
        ]
    ],
    [
        'name' => 'xml',
        'form_options' => [
            'type' => 'textarea',
            'class' => 'form-xml',
            'maxlength' => 1000000,
            'resize' => 'none'
        ]
    ],
    [
        'name' => 'user_id',
        'form_options' => [
            'type' => 'select',
            'options' => $usernames,
            'default' => $this->Identity->get('id'),
            // 'empty' => true,
            // 'label' => __('User'),
            // 'disabled' => ($this->Identity->get('role') !== 'admin')
        ]
    ]
];

echo $this->element('standard_edit', [


    // 'rel_entity_fields' => [
    //     'Users' => ['username', 'created', 'modified'],
    //     'Tools' => ['name']
    //  ],
    // 'rel_entity_pages' => [$user],
    'entity' => $entity,
    'instance_name' => $entity->name,
    'fields' => $fields,
    'editable' => true,

]);
?>

<?php /*
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('View Report'), ['action' => 'view', $report->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(
                __('Delete Report'),
                ['action' => 'delete', $report->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $report->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('◀ My Reports'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?php if ($this->Identity->get('role') === 'admin') {
                    echo $this->Html->link(__('◀ Admin: Reports'), ['action' => 'indexAdmin'], ['class' => 'side-nav-item']);
                } ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="reports edit content">
            <?= $this->Form->create($report) ?>
            <fieldset>
                <h3><?= __($this->get('title')) ?></h3>
                <?php
                    $usernames = [];
                    foreach ($users as $user) {
                        $usernames[$user->id] = $user->username;
                    }
                    
                    echo $this->Form->control('name');
                    echo $this->Form->control('xml', ['type' => 'textarea', 'class' => 'form-xml', ' maxlength' => '1000000', 'resize' => 'none']);
                    if ($this->Identity->get('role') === 'admin') {
                        echo $this->Form->control('user_id', ['options' => $usernames, 'default'=> $this->Identity->get('id')]);
                    } 
                ?>
            </fieldset>
            <?= $this->Form->button(__('Save')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
*/ ?>
