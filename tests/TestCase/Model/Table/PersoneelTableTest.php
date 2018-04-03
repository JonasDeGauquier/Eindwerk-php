<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PersoneelTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PersoneelTable Test Case
 */
class PersoneelTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PersoneelTable
     */
    public $Personeel;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.personeel',
        'app.adres',
        'app.rol'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Personeel') ? [] : ['className' => PersoneelTable::class];
        $this->Personeel = TableRegistry::get('Personeel', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Personeel);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
