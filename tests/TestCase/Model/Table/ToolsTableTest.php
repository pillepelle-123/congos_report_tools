<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ToolsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ToolsTable Test Case
 */
class ToolsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ToolsTable
     */
    protected $Tools;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Tools',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Tools') ? [] : ['className' => ToolsTable::class];
        $this->Tools = $this->getTableLocator()->get('Tools', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Tools);

        parent::tearDown();
    }
}
