<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * JogadoresFixture
 */
class JogadoresFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'jogador_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'equipe_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'nome' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'sobrenome' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'idade' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'posicao' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'autor' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_autor_Jogador' => ['type' => 'index', 'columns' => ['autor'], 'length' => []],
            'FK_equipe_id_Jogador' => ['type' => 'index', 'columns' => ['equipe_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['jogador_id'], 'length' => []],
            'FK_autor_Jogador' => ['type' => 'foreign', 'columns' => ['autor'], 'references' => ['usuarios', 'usuario_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_equipe_id_Jogador' => ['type' => 'foreign', 'columns' => ['equipe_id'], 'references' => ['equipes', 'equipe_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'jogador_id' => 1,
                'equipe_id' => 1,
                'nome' => 'Lorem ipsum dolor sit amet',
                'sobrenome' => 'Lorem ipsum dolor sit amet',
                'idade' => 1,
                'posicao' => 'Lorem ipsum dolor sit amet',
                'created' => '2020-11-13 12:24:43',
                'modified' => '2020-11-13 12:24:43',
                'autor' => 1,
            ],
        ];
        parent::init();
    }
}
