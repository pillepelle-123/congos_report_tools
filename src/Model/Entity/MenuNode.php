<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MenuNode Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string $url
 * @property string $controller
 * @property string $action
 * @property string $plugin
 * @property int $lft
 * @property int $rght
 *
 * @property \App\Model\Entity\ParentMenuNode $parent_menu_node
 * @property \App\Model\Entity\ChildMenuNode[] $child_menu_nodes
 */
class MenuNode extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'parent_id' => true,
        'title' => true,
        'url' => true,
        'controller' => true,
        'action' => true,
        'plugin' => true,
        'lft' => true,
        'rght' => true,
        'parent_menu_node' => true,
        'child_menu_nodes' => true,
    ];
}
