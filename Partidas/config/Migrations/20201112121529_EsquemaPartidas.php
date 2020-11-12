<?php
use Migrations\AbstractMigration;

class EsquemaPartidas extends AbstractMigration
{
    public function up()
    {

        $this->table('equipes', ['id' => false, 'primary_key' => ['equipe_id']])
            ->addColumn('equipe_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('nome', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('data_fundacao', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('autor', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'autor',
                ]
            )
            ->create();

        $this->table('jogadores', ['id' => false, 'primary_key' => ['jogador_id']])
            ->addColumn('jogador_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('equipe_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('nome', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('sobrenome', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('idade', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('posicao', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('autor', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'autor',
                ]
            )
            ->addIndex(
                [
                    'equipe_id',
                ]
            )
            ->create();

        $this->table('partidas', ['id' => false, 'primary_key' => ['partida_id']])
            ->addColumn('partida_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('equipe_casa_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('equipe_fora_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('data_partida', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('gols_fora', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('gols_casa', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('autor', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'autor',
                ]
            )
            ->addIndex(
                [
                    'equipe_casa_id',
                ]
            )
            ->addIndex(
                [
                    'equipe_fora_id',
                ]
            )
            ->create();

        $this->table('usuarios', ['id' => false, 'primary_key' => ['usuario_id']])
            ->addColumn('usuario_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('nome_de_usuario', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('senha', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('equipes')
            ->addForeignKey(
                'autor',
                'usuarios',
                'usuario_id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('jogadores')
            ->addForeignKey(
                'autor',
                'usuarios',
                'usuario_id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'equipe_id',
                'equipes',
                'equipe_id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('partidas')
            ->addForeignKey(
                'autor',
                'usuarios',
                'usuario_id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'equipe_casa_id',
                'equipes',
                'equipe_id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'equipe_fora_id',
                'equipes',
                'equipe_id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('equipes')
            ->dropForeignKey(
                'autor'
            )->save();

        $this->table('jogadores')
            ->dropForeignKey(
                'autor'
            )
            ->dropForeignKey(
                'equipe_id'
            )->save();

        $this->table('partidas')
            ->dropForeignKey(
                'autor'
            )
            ->dropForeignKey(
                'equipe_casa_id'
            )
            ->dropForeignKey(
                'equipe_fora_id'
            )->save();

        $this->table('equipes')->drop()->save();
        $this->table('jogadores')->drop()->save();
        $this->table('partidas')->drop()->save();
        $this->table('usuarios')->drop()->save();
    }
}
