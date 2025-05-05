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

/**
 * Users Controller
 *
 * //@property \App\Model\Table\UsersTable $Users
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

        //$this->Users = $this->fetchTable('Users');

        //$this->Users = $this->fetchTable(alias: 'Users');
        

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
        $user =  $this->users_table->get($id, ['contain' => ['Reports']]); // $this->Users->get($id, ['contain' => ['Reports']]);
        parent::view($id);
        $this->set(compact('user'));

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
        //$users_table = $this->fetchTable();
        $table_alias = $this->users_table->getAlias();
        $user = $this->users_table->newEmptyEntity();
        //$this->set($tableAlias, $user);
        $this->set('user', $user);
        $this->viewBuilder()->setOption('serialize', [$user, 'user']);
        if (!$this->getRequest()->is('post')) {
            return;
        }
        $entity = $this->users_table->patchEntity($user, $this->getRequest()->getData());
        $singular = Inflector::singularize(Inflector::humanize($table_alias));
        if ($this->users_table->save($entity)) {
            $this->Flash->success(__d('cake_d_c/users', 'The {0} has been saved', $singular));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__d('cake_d_c/users', 'The {0} could not be saved', $singular));
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
        $table = $this->fetchTable();
        $table_alias = $table->getAlias();
        $user = $table->get($id, args: [
            'contain' => [],
        ]);
        //$this->set($tableAlias, $entity);
        $this->set('user', $user);
        $this->viewBuilder()->setOption('serialize', [$table_alias, 'tableAlias']);
        if (!$this->getRequest()->is(['patch', 'post', 'put'])) {
            return;
        }
        $entity = $table->patchEntity($user, $this->getRequest()->getData());
        $singular = Inflector::singularize(Inflector::humanize($table_alias));
        if ($table->save($entity)) {
            $this->Flash->success(__d('cake_d_c/users', 'The {0} has been saved', $singular));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__d('cake_d_c/users', 'The {0} could not be saved', $singular));
    }

    // /**
    //  * Edit method
    //  *
    //  * @param string|null $id User id.
    //  * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function edit($id = null)
    // {
    //     $user = $this->Users->get($id, ['contain' => []]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $user = $this->Users->patchEntity($user, $this->request->getData());
    //         if ($this->Users->save($user)) {
    //             $this->Flash->success(__('The user has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The user could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('user'));
    // }

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
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function settings($id = null)
    {
        $table = $this->fetchTable();
        $user = $table->get($id, args: [
            'contain' => [],
        ]);
        //$this->set($tableAlias, $entity);
        $this->set('user', $user);
        $this->set('title', 'My User Settings');
        //$this->viewBuilder()->setOption('serialize', [$tableAlias, 'tableAlias']);
        if (!$this->getRequest()->is(['patch', 'post', 'put'])) {
            return;
        }
        $entity = $table->patchEntity($user, $this->getRequest()->getData());
        if ($table->save($entity)) {
            $this->Flash->success(__d('cake_d_c/users', 'Changes have been saved'));

            return; // $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__d('cake_d_c/users', 'Changes have been saved'));
    }


    public function changePassword($id = null)
    {
        $user = $this->getUsersTable()->newEntity([], ['validate' => false]);
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
                $validator = $this->getUsersTable()->validationPasswordConfirm(new Validator());
                if ($validatePassword) {
                    $validator = $this->getUsersTable()->validationCurrentPassword($validator);
                }
                $this->getUsersTable()->setValidator('current', $validator);
                $user = $this->getUsersTable()->patchEntity(
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
                    $result = $this->getUsersTable()->changePassword($user);
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
        $this->set('title', 'Change Password');
        $this->set(['user' => $user]);
        $this->viewBuilder()->setOption('serialize', ['user']);
    }

}
