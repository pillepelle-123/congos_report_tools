<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query\SelectQuery;

class CrudComponent extends Component {

    protected array $components = ['Flash']; 

    protected array $config = [
        'model_name' => '',
        'request' => ''
    ];
    protected SelectQuery $query;

    protected $identity;

    // public function initialize(array $config): void {
    //     parent::initialize($config);
    //     // Flash component should be loaded in the controller, not here.
    // }

    // protected $_defaultConfig = [
    //     'model_name' => $this->model_name,
    //     'request' => $this->request,
    // ];

    // public function initialize(): void {
    //     $this->model_name = $config['model_name'] ?? '';
    //     $this->request = $config['request'] ?? '';
    // }

    // public function initialize(array $config): void {
    //     parent::initialize($config);
    //     $this->model_name = $config['model_name'] ?? '';
    //     $this->request = $config['request'] ?? '';
    // }

    public function __construct(ComponentRegistry $registry, array $config = []) 
    {
        $this->config = $config;
        parent::__construct($registry, $config);
        $this->identity = $config['request']->getAttribute('identity') ?? [];

    }

    public function index(): mixed {
        return $this->query;
        // $this->setQuery();
        // $this->query = $this->query->order(['created' => 'DESC']);
        // $this->entities = $this->query->all();
        // return $this->entities;
    }

    public function view($id = null): mixed {
        return $this->query->where(['id' => $id])->first();
    }

    public function add(/*$entity_name, $request*/): EntityInterface {
        $request = $this->config['request'];
        $model_name = $this->config['model_name'];
        $table = \Cake\ORM\TableRegistry::getTableLocator()->get($model_name);
        $newEntity = $table->newEmptyEntity();

        if ($request->getMethod() === 'POST') {
            $newEntity = $table->patchEntity($newEntity, $request->getData());
            if ($table->save($newEntity)) {
                $this->Flash->success(__('The ' . $this->model_name . ' has been saved.'));
            } else {
                $this->Flash->error(__('The ' . $this->model_name . ' could not be saved. Please, try again.'));
            }
        }
        // $this->set('newEntity', $newEntity);
        // return $newEntity;
        return $newEntity;
    }

    public function edit($id = null)
    {
        $request = $this->config['request'];
        $model_name = $this->config['model_name'];
        $table = \Cake\ORM\TableRegistry::getTableLocator()->get($model_name);

        $entity = $table->get($id);
        if ($request->is(['patch', 'post', 'put'])) {

            $entity = $table->patchEntity($entity, $request->getData());
            if ($table->save($entity)) {
                $this->Flash->success(__d('cake_d_c/users', 'The user has been saved'));
            } else {
                $this->Flash->error(__d('cake_d_c/users', 'The user could not be saved'));
            }
        }
        return $entity;
    }

    /**
     * Summary of setQuery
     * @param array $contain Array of containable associations
     * @param array $where Array of where conditions
     * @param bool $first_row Only fetch the first row
     * @param array $only_user_data Only fetch data for the logged-in user ['user_id_field' => $this->identity['id']]
     * @return void
     */
    public function setQuery(array $contain = [], array $where = [], bool $first_row = false, bool $only_user_data = false): void
    {
        $table = \Cake\ORM\TableRegistry::getTableLocator()->get($this->config['model_name']);

        // $model_name = $this->config['model_name'];
        $ident = $this->identity['id'];

        $this->query = $table->find('all')
            ->contain($contain)
            ->where(
                array_merge(
                    count($where) ? $where : ['1' => '1'],
                    $only_user_data ? ['user_id' => $this->identity['id']] : []
                )
            );
        if ($first_row) {
            $this->query = $this->query->first();
        }

    }

}