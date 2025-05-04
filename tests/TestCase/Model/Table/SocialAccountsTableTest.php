<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SocialAccountsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SocialAccountsTable Test Case
 */
class SocialAccountsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SocialAccountsTable
     */
    protected $SocialAccounts;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.SocialAccounts',
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
        $config = $this->getTableLocator()->exists('SocialAccounts') ? [] : ['className' => SocialAccountsTable::class];
        $this->SocialAccounts = $this->getTableLocator()->get('SocialAccounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SocialAccounts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SocialAccountsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SocialAccountsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
