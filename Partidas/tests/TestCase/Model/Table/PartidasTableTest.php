<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartidasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartidasTable Test Case
 */
class PartidasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PartidasTable
     */
    public $Partidas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Partidas',
        'app.Equipes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Partidas') ? [] : ['className' => PartidasTable::class];
        $this->Partidas = TableRegistry::getTableLocator()->get('Partidas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Partidas);

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
