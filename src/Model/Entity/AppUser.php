<?php
declare(strict_types=1);

namespace App\Model\Entity;

// use Cake\ORM\Entity;
use CakeDC\Users\Model\Entity\User;

/**
 * User Entity
 *
 * @property string $id
 * @property string $username
 * @property string|null $email
 * @property string $password
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $token
 * @property \Cake\I18n\DateTime|null $token_expires
 * @property string|null $api_token
 * @property \Cake\I18n\DateTime|null $activation_date
 * @property string|null $secret
 * @property bool|null $secret_verified
 * @property \Cake\I18n\DateTime|null $tos_date
 * @property bool $active
 * @property bool $is_superuser
 * @property string|null $role
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 * @property string|null $additional_data
 * @property \Cake\I18n\DateTime|null $last_login
 * @property \Cake\I18n\DateTime|null $lockout_time
 * @property string|null $login_token
 * @property \Cake\I18n\DateTime|null $login_token_date
 * @property bool $token_send_requested
 *
 * @property \App\Model\Entity\FailedPasswordAttempt[] $failed_password_attempts
 * @property \App\Model\Entity\Report[] $reports
 * @property \App\Model\Entity\SocialAccount[] $social_accounts
 */
use Cake\Datasource\EntityInterface;

class AppUser extends User
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
        'username' => true,
        'email' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'token' => true,
        'token_expires' => true,
        'api_token' => true,
        'activation_date' => true,
        'secret' => true,
        'secret_verified' => true,
        'tos_date' => true,
        'active' => true,
        'is_superuser' => true,
        'role' => true,
        'created' => true,
        'modified' => true,
        'additional_data' => true,
        'last_login' => true,
        'lockout_time' => true,
        'login_token' => true,
        'login_token_date' => true,
        'token_send_requested' => true,
        'failed_password_attempts' => true,
        'reports' => true,
        'reports2' => true,
        'social_accounts' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var list<string>
     */
    protected array $_hidden = [
        'password',
        'token',
    ];

    // protected function _getActive()
    // {
    //     return $this->_properties['is_active'];
    // }

    // protected function _setActive($value)
    // {
    //     $this->set('is_active', $value);
    //     return $value;
    // }
}
