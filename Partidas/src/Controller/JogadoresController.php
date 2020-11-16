<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Jogadores Controller
 *
 * @property \App\Model\Table\JogadoresTable $Jogadores
 *
 * @method \App\Model\Entity\Jogadore[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JogadoresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Equipes', 'Usuarios'],
        ];
        $jogadores = $this->paginate($this->Jogadores);

        $this->set(compact('jogadores'));
    }

    /**
     * View method
     *
     * @param string|null $id Jogadore id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $jogadore = $this->Jogadores->get($id, [
            'contain' => ['Equipes', 'Usuarios'],
        ]);

        $this->set('jogadore', $jogadore);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $jogadore = $this->Jogadores->newEntity();
        if ($this->request->is('post')) {
            $jogadore = $this->Jogadores->patchEntity($jogadore, $this->request->getData());

            $jogadore->usuario_id = $this->Auth->user('usuario_id'); // Para salvar o 'autor'
            
            if ($this->Jogadores->save($jogadore)) {
                $this->Flash->success(__('The jogadore has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The jogadore could not be saved. Please, try again.'));
        }

        $formOptions = $this->Jogadores->Equipes->find('list', ['keyField' => 'equipe_id', 'valueField' => 'nome']);

        $equipes = $this->Jogadores->Equipes->find('list', ['limit' => 200]);

        $usuarios = $this->Jogadores->Usuarios->find('list', ['limit' => 200]);

        $this->set(compact('jogadore', 'equipes', 'usuarios', 'formOptions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Jogadore id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $jogadore = $this->Jogadores->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $jogadore = $this->Jogadores->patchEntity($jogadore, $this->request->getData());
            if ($this->Jogadores->save($jogadore)) {
                $this->Flash->success(__('The jogadore has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The jogadore could not be saved. Please, try again.'));
        }

        $formOptions = $this->Jogadores->Equipes->find('list', [
            'keyField' => 'equipe_id', 
            'valueField' => 'nome'
        ]);

        $equipes = $this->Jogadores->Equipes->find('list', ['limit' => 200]);

        $this->set(compact('jogadore', 'equipes', 'formOptions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Jogadore id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $jogadore = $this->Jogadores->get($id);
        
        /*if ($this->Jogadores->delete($jogadore)) {
            $this->Flash->success(__('The jogadore has been deleted.'));
        } else {
            $this->Flash->error(__('The jogadore could not be deleted. Please, try again.'));
        }*/
        try {
            $this->Jogadores->delete($jogadore);
            $this->Flash->success(__('O jogador foi deletado.'));
        } catch (\PDOException $e) {
            $error = 'ERRO: O jogador que você quer deletar está associado com outros items.';
            $this->Flash->error(__($error));

        } catch (Exception $e) {
            $this->Flash->error(__("ERRO: O jogador não pode ser deletado."));
        }

        return $this->redirect(['action' => 'index']);
    }
}
