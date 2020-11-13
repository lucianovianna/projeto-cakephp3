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
        'gols_fora' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'gols_casa' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'autor' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_autor_Partida' => ['type' => 'index', 'columns' => ['autor'], 'length' => []],
            'FK_equipe_casa_Partida' => ['type' => 'index', 'columns' => ['equipe_casa_id'], 'length' => []],
            'FK_equipe_fora_Partida' => ['type' => 'index', 'columns' => ['equipe_fora_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['partida_id'], 'length' => []],
            'FK_autor_Partida' => ['type' => 'foreign', 'columns' => ['autor'], 'references' => ['usuarios', 'usuario_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_equipe_casa_Partida' => ['type' => 'foreign', 'columns' => ['equipe_casa_id'], 'references' => ['equipes', 'equipe_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_equipe_fora_Partida' => ['type' => 'foreign', 'columns' => ['equipe_fora_id'], 'references' => ['equipes', 'equipe_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'data_partida' => '2020-11-13 12:25:12',
                'gols_fora' => 1,
                'gols_casa' => 1,
                'created' => '2020-11-13 12:25:12',
                'modified' => '2020-11-13 12:25:12',
                'autor' => 1,
            ],
        ];
        parent::init();
    }
}
