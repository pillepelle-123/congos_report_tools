<?php
declare(strict_types=1);

namespace App\Controller;

use CakeDC\Users\Controller\UsersController as BaseUsersController;
use App\Model\Table\UsersTable;
use Cake\Event\Event;
use CakeDC\Users\Controller\Traits\LoginTrait;
use CakeDC\Users\Controller\Traits\RegisterTrait;
use CakeDC\Users\Controller\Traits\SimpleCrudTrait;
use Cake\Utility\Inflector;
use CakeDC\Users\Plugin;
use Cake\Core\Configure;
use Cake\Validation\Validator;
use CakeDC\Users\Exception\UserNotFoundException;
use CakeDC\Users\Exception\WrongPasswordException;
use Exception;
use CakeDC\Auth\Authentication\AuthenticationService;
use CakeDC\Users\Loader\LoginComponentLoader;

/**
 * Users Controller
 *
 * //@property \App\Model\Table\UsersTable $Users
 * @property \Cake\ORM\Table $UsersTable
 */
// class UsersController extends AppController
class UsersController extends BaseUsersController
{
    use LoginTrait;
    use RegisterTrait;
    use SimpleCrudTrait;

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('CakeDC/Users.Setup');
        if ($this->components()->has('Security')) {
            $this->Security->setConfig(
                'unlockedActions',
                ['login', 'u2fRegister', 'u2fRegisterFinish', 'u2fAuthenticate', 'u2fAuthenticateFinish']
            );
        }

        $this->loadComponent('FormProtection');
        if ($this->request->getParam('_csrfToken') === false) {
            $this->loadComponent('Csrf');
        }

        $this->UsersTable = $this->getUsersTable();
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // $query = $this->Users->find()
        //     ->contain(['Reports']);
        $users = $this->paginate($this->all_users);

        $this->set(compact('users'));
        $this->set('title', 'Users');
    }

    public function listAdmin() {
        $users = $this->paginate($this->all_users);

        $this->set(compact('users'));
        $this->set('title', 'Admin: Users');
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user =  $this->UsersTable->get($id, ['contain' => ['Reports']]); // $this->Users->get($id, ['contain' => ['Reports']]);
        $reports = $this->reports_table->find('all')
            ->where(['user_id' => $id])
            ->order(['created' => 'DESC']);

        $reports = $this->paginate($reports);
        parent::view($id);
        $this->set(compact('user', 'reports'));

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $user = $this->Users->newEmptyEntity();
    //     if ($this->request->is('post')) {
    //         $user = $this->Users->patchEntity($user, $this->request->getData());
    //         if ($this->Users->save($user)) {
    //             $this->Flash->success(__('The user has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The user could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('user'));
    // }

    public function add()
    {
        $user = $this->UsersTable->newEmptyEntity();
        $this->set('user', $user);
        $this->viewBuilder()->setOption('serialize', [$user, 'user']);
        if (!$this->getRequest()->is('post')) {
            return;
        }
        $entity = $this->UsersTable->patchEntity($user, $this->getRequest()->getData());
        if ($this->UsersTable->save($entity)) {
            $this->Flash->success(__d('cake_d_c/users', 'The User has been saved'));
            
            return $this->redirect(['action' => 'listAdmin']);
            
        }
        $this->Flash->error(__d('cake_d_c/users', 'The {0} could not be saved'));
    }

        /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return mixed Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->UsersTable->get($id);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {

            $user = $this->UsersTable->patchEntity($user, $this->request->getData());
            if ($this->UsersTable->save($user)) {
                $this->Flash->success(__d('cake_d_c/users', 'The user has been saved'));
            } else {
                $this->Flash->error(__d('cake_d_c/users', 'The user could not be saved'));
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->UsersTable->get($id);
        if ($this->UsersTable->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        if(str_contains($this->referer(), '/users/view/') || str_contains($this->referer(), '/users/edit/')) {
            return $this->redirect(['action' => 'listAdmin']);
        }
        return $this->redirect(url: $this->referer());
    }

    public function settings()
    {
        $this->set(['user' => $this->my_user, 'title' => 'My User Settings']);
        if (!$this->getRequest()->is(['patch', 'post', 'put'])) {
            return;
        }
        $user = $this->UsersTable->patchEntity($this->my_user, $this->getRequest()->getData());
        if ($this->UsersTable->save($user)) {
            $this->Flash->success(__d('cake_d_c/users', 'Changes have been saved'));
            return;
        }
        $this->Flash->error(__d('cake_d_c/users', 'Changes have been saved'));
    }


    public function changePassword($id = null)
    {
        $user = $this->UsersTable->newEntity([], ['validate' => false]);
        $user->setNew(false);

        $identity = $this->getRequest()->getAttribute('identity');
        $identity = $identity ?? [];
        $userId = $identity['id'] ?? null;

        if ($userId) {
            if ($id && $identity['is_superuser'] && Configure::read('Users.Superuser.allowedToChangePasswords')) {
                // superuser editing any account's password
                $user->set('id', $id);
                $validatePassword = false;
                $redirect = ['action' => 'settings', $userId];
            } elseif (!$id || $id === $userId) {
                // normal user editing own password
                $user->set('id', $userId);
                $validatePassword = true;
                $redirect = ['action' => 'settings', $userId]; //Configure::read('Users.Profile.route');
            } else {
                $this->Flash->error(
                    __d('cake_d_c/users', 'Changing another user\'s password is not allowed'),
                );
                $this->redirect(['action' => 'settings', $userId]);

                return;
            }
        } else {
            // password reset
            $user->set(
                'id',
                $this->getRequest()->getSession()->read(
                    Configure::read('Users.Key.Session.resetPasswordUserId'),
                ),
            );
            $validatePassword = false;
            $redirect = $this->Authentication->getConfig('loginAction');
            if (!$user->get('id')) {
                $this->Flash->error(__d('cake_d_c/users', 'User was not found'));
                $this->redirect($redirect);

                return;
            }
        }
        $this->set('validatePassword', $validatePassword);
        if ($this->getRequest()->is(['post', 'put'])) {
            try {
                $validator = $this->UsersTable->validationPasswordConfirm(new Validator());
                if ($validatePassword) {
                    $validator = $this->UsersTable->validationCurrentPassword($validator);
                }
                $this->UsersTable->setValidator('current', $validator);
                $user = $this->UsersTable->patchEntity(
                    $user,
                    $this->getRequest()->getData(),
                    [
                        'validate' => 'current',
                        'accessibleFields' => [
                            'current_password' => true,
                            'password' => true,
                            'password_confirm' => true,
                        ],
                    ],
                );

                if ($user->getErrors()) {
                    $this->Flash->error(__d('cake_d_c/users', 'Password could not be changed'));
                } else {
                    $result = $this->UsersTable->changePassword($user);
                    if ($result) {
                        $event = $this->dispatchEvent(Plugin::EVENT_AFTER_CHANGE_PASSWORD, ['user' => $result]);
                        $eventResult = $event->getResult();
                        if (!empty($eventResult) && is_array($eventResult)) {
                            return $this->redirect($event->getResult());
                        }
                        $this->Flash->success(__d('cake_d_c/users', 'Password has been changed successfully'));

                        return $this->redirect($redirect);
                    } else {
                        $this->Flash->error(__d('cake_d_c/users', 'Password could not be changed'));
                    }
                }
            } catch (UserNotFoundException $exception) {
                $this->Flash->error(__d('cake_d_c/users', 'User was not found'));
            } catch (WrongPasswordException $wpe) {
                $this->Flash->error($wpe->getMessage());
            } catch (Exception $exception) {
                $this->Flash->error(__d('cake_d_c/users', 'Password could not be changed'));
                $this->log($exception->getMessage());
            }
        }
        // $this->set('title', 'Change Password');
        $this->set(['user' => $user, 'title' => 'Change Password']);
        $this->viewBuilder()->setOption('serialize', ['user']);
    }

    public function login()
    {
        $this->getRequest()->getSession()->delete(AuthenticationService::TWO_FACTOR_VERIFY_SESSION_KEY);
        $Login = LoginComponentLoader::forForm($this);

        $this->set('title', 'Login');
        return $Login->handleLogin(true, false);
    }

}
