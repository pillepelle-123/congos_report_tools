<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use CakeDC\Users\Model\Entity\User as BaseUser;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\Core\Configure;
use Cake\I18n\DateTime;
use Cake\Utility\Security;

/**
 * User Entity
 *
 * @property string $id
 * @property string $username
 * @property string|null $email
 * @property string $password
 * @property string $password_confirm
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
 * @property array|null $additional_data
 * @property \Cake\I18n\DateTime|null $last_login
 * @property \Cake\I18n\DateTime|null $lockout_time
 * @property string|null $login_token
 * @property \Cake\I18n\DateTime|null $login_token_date
 * @property bool $token_send_requested
 * 
 * @property \CakeDC\Users\Model\Entity\SocialAccount[] $social_accounts
 */


 class User extends BaseUser
{
    /**
     * @inheritDoc
     */
    protected array $_accessible = [
        '*' => true,
        'id' => false,
        'is_superuser' => false,
        'role' => false,
    ];

    /**
     * @inheritDoc
     */
    protected array $_hidden = [
        'additional_data',
        'api_token',
        'password',
        'secret',
        'token',
        'token_expires',
    ];

    /**
     * @param string $password password that will be set.
     * @return string|bool
     */
    protected function _setPassword($password)
    {
        return $this->hashPassword($password);
    }

    /**
     * @param string $password password that will be confirm.
     * @return string|bool
     */
    protected function _setConfirmPassword($password)
    {
        return $this->hashPassword($password);
    }

    /**
     * @param string $tos tos option. It will be set the tos_date
     * @return bool
     */
    protected function _setTos($tos)
    {
        if ((bool)$tos) {
            $this->set('tos_date', DateTime::now());
        }

        return $tos;
    }

    /**
     * Hash a password using the configured password hasher,
     * use DefaultPasswordHasher if no one was configured
     *
     * @param string $password password to be hashed
     * @return mixed
     */
    public function hashPassword($password)
    {
        $PasswordHasher = $this->getPasswordHasher();

        return $PasswordHasher->hash((string)$password);
    }

    /**
     * Return the configured Password Hasher
     *
     * @return mixed
     */
    public function getPasswordHasher()
    {
        $passwordHasher = Configure::read('Users.passwordHasher');
        if (!class_exists($passwordHasher)) {
            $passwordHasher = DefaultPasswordHasher::class;
        }

        return new $passwordHasher();
    }

    /**
     * Checks if a password is correctly hashed
     *
     * @param string $password password that will be check.
     * @param string $hashedPassword hash used to check password.
     * @return bool
     */
    public function checkPassword($password, $hashedPassword)
    {
        $PasswordHasher = $this->getPasswordHasher();

        return $PasswordHasher->check($password, $hashedPassword);
    }

    /**
     * Returns if the token has already expired
     *
     * @return bool
     */
    public function tokenExpired()
    {
        if (empty($this->token_expires)) {
            return true;
        }

        return new DateTime($this->token_expires) < DateTime::now();
    }

    /**
     * Getter for user avatar
     *
     * @return string|null avatar
     */
    protected function _getAvatar()
    {
        $avatar = null;
        if (isset($this->social_accounts[0])) {
            $avatar = $this->social_accounts[0]['avatar'];
        }

        return $avatar;
    }

    /**
     * Generate token_expires and token in a user
     *
     * @param int $tokenExpiration seconds to expire the token from Now
     * @return void
     */
    public function updateToken($tokenExpiration = 0)
    {
        $expiration = new DateTime('now');
        $this->token_expires = $expiration->addSeconds($tokenExpiration);
        $this->token = bin2hex(Security::randomBytes(16));
    }

}








//  class User extends Entity
// {
//     /**
//      * Fields that can be mass assigned using newEntity() or patchEntity().
//      *
//      * Note that when '*' is set to true, this allows all unspecified fields to
//      * be mass assigned. For security purposes, it is advised to set '*' to false
//      * (or remove it), and explicitly make individual fields accessible as needed.
//      *
//      * @var array<string, bool>
//      */
//     protected array $_accessible = [
//         'username' => true,
//         'email' => true,
//         'password' => true,
//         'first_name' => true,
//         'last_name' => true,
//         'token' => true,
//         'token_expires' => true,
//         'api_token' => true,
//         'activation_date' => true,
//         'secret' => true,
//         'secret_verified' => true,
//         'tos_date' => true,
//         'active' => true,
//         'is_superuser' => true,
//         'role' => true,
//         'created' => true,
//         'modified' => true,
//         'additional_data' => true,
//         'last_login' => true,
//         'lockout_time' => true,
//         'login_token' => true,
//         'login_token_date' => true,
//         'token_send_requested' => true,
//         'social_accounts' => true,
//     ];

//     /**
//      * Fields that are excluded from JSON versions of the entity.
//      *
//      * @var list<string>
//      */
//     protected array $_hidden = [
//         'password',
//         'token',
//     ];
// }