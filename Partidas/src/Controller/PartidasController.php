<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Datasource\ConnectionManager;

/**
 * Partidas Controller
 *
 * @property \App\Model\Table\PartidasTable $Partidas
 *
 * @method \App\Model\Entity\Partida[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartidasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    
    public function export() 
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

        $this->set(compact('data', '_serialize', '_header'));

        $this->viewBuilder()->className('CsvView.Csv');
    }

    public function export2() 
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

        $this->set(compact('data', '_serialize', '_header'));

        $this->viewBuilder()->className('CsvView.Csv');
    }

    public function export3() 
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
        $_csvEncoding = '';
        $_extract = ['Nome', 'Vitorias'];


        $this->set(compact('data', '_serialize', '_header', '_extract'));

        $this->viewBuilder()->className('CsvView.Csv');
    }
    
    public function index()
    {
        $this->paginate = [
            'contain' => ['Usuarios', 'EquipesA', 'EquipesB'],
        ];
        $partidas = $this->paginate($this->Partidas);

        $this->set(compact('partidas'));
    }

    /**
     * View method
     *
     * @param string|null $id Partida id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $partida = $this->Partidas->get($id, [
            'contain' => ['Usuarios', 'EquipesA', 'EquipesB'],
        ]);
        
        $this->set('partida', $partida);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $partida = $this->Partidas->newEntity();
        if ($this->request->is('post')) {
            $partida = $this->Partidas->patchEntity($partida, $this->request->getData());
            
            $partida->usuario_id = $this->Auth->user('usuario_id'); // Para salvar o 'autor'
            
            if ($this->Partidas->save($partida)) {
                $this->Flash->success(__('The partida has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The partida could not be saved. Please, try again.'));
        }

        $formOptions = $this->Partidas->EquipesA->find('list', [
            'keyField' => 'equipe_id', 
            'valueField' => 'nome'
        ]);
        
        $equipes = $this->Partidas->EquipesA->find('list', ['limit' => 200]);
        $equipes2 = $this->Partidas->EquipesB->find('list', ['limit' => 200]);

        $this->set(compact('partida', 'equipes', 'equipes2', 'formOptions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Partida id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $partida = $this->Partidas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $partida = $this->Partidas->patchEntity($partida, $this->request->getData());
            if ($this->Partidas->save($partida)) {
                $this->Flash->success(__('The partida has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The partida could not be saved. Please, try again.'));
        }

        $formOptions = $this->Partidas->EquipesA->find('list', [
            'keyField' => 'equipe_id', 
            'valueField' => 'nome'
        ]);

        $equipes = $this->Partidas->EquipesA->find('list', ['limit' => 200]);
        $equipes2 = $this->Partidas->EquipesB->find('list', ['limit' => 200]);

        $this->set(compact('partida', 'equipes', 'equipes2', 'formOptions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Partida id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $partida = $this->Partidas->get($id);
        /*if ($this->Partidas->delete($partida)) {
            $this->Flash->success(__('The partida has been deleted.'));
        } else {
            $this->Flash->error(__('The partida could not be deleted. Please, try again.'));
        }*/
        try {
            $this->Partidas->delete($partida);
            $this->Flash->success(__('A partida foi deletada.'));
        } catch (\PDOException $e) {
            $error = 'ERRO: A partida que você quer deletar está associado com outros items.';
            $this->Flash->error(__($error));

        } catch (Exception $e) {
            $this->Flash->error(__("ERRO: A partida não pode ser deletada."));
        }

        return $this->redirect(['action' => 'index']);
    }
}
