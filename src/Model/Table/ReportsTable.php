<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reports Model
 *
 * @property \CakeDC\Users\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Report newEmptyEntity()
 * @method \App\Model\Entity\Report newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Report> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Report get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Report findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Report patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Report> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Report|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Report saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Report>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Report>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Report>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Report> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Report>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Report>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Report>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Report> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReportsTable extends Table
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

        $this->setTable('reports');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('xml')
            ->maxLength('xml', 4294967295)
            ->allowEmptyString('xml');

        $validator
            //->integer('user_id')
            ->notEmptyString('user_id');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
