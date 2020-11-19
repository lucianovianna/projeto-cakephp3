<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Datasource\ConnectionManager;


class ExportsController extends AppController 
{
    public function report1() 
    {
        $this->response->download('report1.csv');

        $connection = ConnectionManager::get('default');

        $data = $connection->execute(
            "SELECT eq.nome AS Equipe_da_Casa,
                eq2.nome AS Equipe_de_Fora,
                pt.gols_casa AS Gols_Casa,
                pt.gols_fora AS Gols_Fora,
                pt.data_partida
            FROM partidas AS pt
                JOIN equipes eq ON eq.equipe_id = pt.equipe_casa_id
                JOIN equipes eq2 ON eq2.equipe_id = pt.equipe_fora_id
            ORDER BY pt.data_partida DESC"
        )->fetchAll('assoc');

        $_serialize = 'data';
        $_header = ['Equipe_da_Casa', 'Equipe_de_Fora', 'Gols_Casa', 'Gols_Fora', 'Data_da_Partida'];

        $this->set('_csvEncoding', 'UTF-16');
        $this->set(compact('data', '_serialize', '_header'));

        $this->viewBuilder()->className('CsvView.Csv');
    }


    public function report2() 
    {
        $this->response->download('report2.csv');

        $connection = ConnectionManager::get('default');

        $data = $connection->execute(
            "SELECT eq.nome,
                count(
                    IF(
                        eq.equipe_id = pt.equipe_casa_id,
                        IF(pt.gols_casa > pt.gols_fora, 1, NULL),
                        IF(pt.gols_fora > pt.gols_casa, 1, NULL)
                    )
                ) AS Vitorias,
                SUM(
                    IF(
                        eq.equipe_id = pt.equipe_casa_id,
                        pt.gols_casa - pt.gols_fora,
                        pt.gols_fora - pt.gols_casa
                    )
                ) AS Saldo_de_Gols
            FROM partidas AS pt
                JOIN equipes eq ON eq.equipe_id = pt.equipe_casa_id
                OR eq.equipe_id = pt.equipe_fora_id
            GROUP BY eq.nome
            ORDER BY Vitorias DESC,
                Saldo_de_Gols DESC,
                eq.nome ASC"
        )->fetchAll('assoc');

        $_serialize = 'data';
        $_header = ['Equipe', 'Vitorias', 'Saldo_de_Gols'];
        
        $this->set('_csvEncoding', 'UTF-16');
        $this->set(compact('data', '_serialize', '_header'));

        $this->viewBuilder()->className('CsvView.Csv');
    }


    public function report3() 
    {
        $this->response->download('report3.csv');

        $connection = ConnectionManager::get('default');

        $data = $connection->execute(
            "SELECT jg.jogador_id as ID,
                concat(jg.nome, ' ', jg.sobrenome) as Nome,
                count(
                    IF(
                        pt.equipe_casa_id = jg.equipe_id,
                        IF(pt.gols_casa > pt.gols_fora, 1, NULL),
                        IF(pt.gols_fora > pt.gols_casa, 1, NULL)
                    )
                ) AS Vitorias
            FROM jogadores AS jg
                JOIN partidas AS pt ON pt.equipe_casa_id = jg.equipe_id
                OR pt.equipe_fora_id = jg.equipe_id
            GROUP BY ID
            ORDER BY Vitorias DESC,
                Nome ASC"
        )->fetchAll('assoc');

        $_serialize = 'data';
        $_header = ['Nome', 'Vitorias'];
        $_extract = ['Nome', 'Vitorias'];

        $this->set('_csvEncoding', 'UTF-16');
        $this->set(compact('data', '_serialize', '_header', '_extract'));

        $this->viewBuilder()->className('CsvView.Csv');
    }
}