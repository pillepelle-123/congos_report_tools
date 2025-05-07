<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tools Model
 *
 * @method \App\Model\Entity\Tool newEmptyEntity()
 * @method \App\Model\Entity\Tool newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Tool> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tool get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Tool findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Tool patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Tool> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tool|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Tool saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Tool>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tool>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tool>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tool> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tool>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tool>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tool>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tool> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ToolsTable extends Table
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

        $this->setTable('tools');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }
}
