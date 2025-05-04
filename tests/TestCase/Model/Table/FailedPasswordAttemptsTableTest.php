<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FailedPasswordAttemptsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FailedPasswordAttemptsTable Test Case
 */
class FailedPasswordAttemptsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FailedPasswordAttemptsTable
     */
    protected $FailedPasswordAttempts;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.FailedPasswordAttempts',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('FailedPasswordAttempts') ? [] : ['className' => FailedPasswordAttemptsTable::class];
        $this->FailedPasswordAttempts = $this->getTableLocator()->get('FailedPasswordAttempts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->FailedPasswordAttempts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FailedPasswordAttemptsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FailedPasswordAttemptsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
