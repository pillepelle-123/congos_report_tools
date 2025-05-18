<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MenuNodesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MenuNodesTable Test Case
 */
class MenuNodesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MenuNodesTable
     */
    protected $MenuNodes;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.MenuNodes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MenuNodes') ? [] : ['className' => MenuNodesTable::class];
        $this->MenuNodes = $this->getTableLocator()->get('MenuNodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MenuNodes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MenuNodesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MenuNodesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
