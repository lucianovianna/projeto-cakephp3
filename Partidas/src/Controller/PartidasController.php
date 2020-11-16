<?php
namespace App\Controller;

use App\Controller\AppController;

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
        if ($this->Partidas->delete($partida)) {
            $this->Flash->success(__('The partida has been deleted.'));
        } else {
            $this->Flash->error(__('The partida could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
