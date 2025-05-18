<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Behavior\TreeBehavior; // Diese Zeile einfügen


/**
 * MenuNodes Model
 *
 * @property \App\Model\Table\MenuNodesTable&\Cake\ORM\Association\BelongsTo $ParentMenuNodes
 * @property \App\Model\Table\MenuNodesTable&\Cake\ORM\Association\HasMany $ChildMenuNodes
 *
 * @method \App\Model\Entity\MenuNode newEmptyEntity()
 * @method \App\Model\Entity\MenuNode newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MenuNode> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MenuNode get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MenuNode findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MenuNode patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MenuNode> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MenuNode|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MenuNode saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MenuNode>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuNode>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuNode>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuNode> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuNode>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuNode>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuNode>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuNode> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class MenuNodesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('menu_nodes');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('ParentMenuNodes', [
            'className' => 'MenuNodes',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildMenuNodes', [
            'className' => 'MenuNodes',
            'foreignKey' => 'parent_id',
        ]);

        $this->addBehavior('Tree');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('parent_id')
            //->notEmptyString('parent_id')
            ->allowEmptyString( 'parent_id');
            ;

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('url')
            ->requirePresence('url', 'create')
            ->notEmptyString('url');

        $validator
            ->scalar('controller')
            ->maxLength('controller', 255)
            ->requirePresence('controller', 'create')
            ->notEmptyString('controller');

        $validator
            ->scalar('action')
            ->maxLength('action', 255)
            ->requirePresence('action', 'create')
            ->notEmptyString('action');

        $validator
            ->scalar('plugin')
            ->maxLength('plugin', 255)
            // ->requirePresence('plugin', 'create')
            //->notEmptyString('plugin')
            ->allowEmptyString( 'plugin');
            ;

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['parent_id'], 'ParentMenuNodes'), ['errorField' => 'parent_id']);

        return $rules;
    }
}
