<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PartidasFixture
 */
class PartidasFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'partida_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'equipe_casa_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'equipe_fora_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'data_partida' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'equipe_casa_id' => ['type' => 'index', 'columns' => ['equipe_casa_id'], 'length' => []],
            'equipe_fora_id' => ['type' => 'index', 'columns' => ['equipe_fora_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['partida_id'], 'length' => []],
            'partidas_ibfk_1' => ['type' => 'foreign', 'columns' => ['equipe_casa_id'], 'references' => ['equipes', 'equipe_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'partidas_ibfk_2' => ['type' => 'foreign', 'columns' => ['equipe_fora_id'], 'references' => ['equipes', 'equipe_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_0900_ai_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'partida_id' => 1,
                'equipe_casa_id' => 1,
                'equipe_fora_id' => 1,
                'data_partida' => '2020-11-11 14:13:22',
                'created' => '2020-11-11 14:13:22',
                'modified' => '2020-11-11 14:13:22',
            ],
        ];
        parent::init();
    }
}
