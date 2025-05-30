<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Report Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $xml
 * @property int $user_id
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \CakeDC\Users\Model\Entity\User $user
 */
class Report extends Entity
{
    public $virtualFields = array(
        'xml_length' => 'Report.LENGTH(xml)',
    );

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
        'name' => true,
        'xml' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'xml_length' => true, // Make the virtual field accessible
    ];
}
