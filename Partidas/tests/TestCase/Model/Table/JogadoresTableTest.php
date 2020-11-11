<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JogadoresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JogadoresTable Test Case
 */
class JogadoresTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\JogadoresTable
     */
    public $Jogadores;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Jogadores',
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
        $config = TableRegistry::getTableLocator()->exists('Jogadores') ? [] : ['className' => JogadoresTable::class];
        $this->Jogadores = TableRegistry::getTableLocator()->get('Jogadores', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Jogadores);

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
