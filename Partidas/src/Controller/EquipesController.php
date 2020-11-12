<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Equipes Controller
 *
 * @property \App\Model\Table\EquipesTable $Equipes
 *
 * @method \App\Model\Entity\Equipe[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EquipesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $equipes = $this->paginate($this->Equipes);

        $this->set(compact('equipes'));
    }

    /**
     * View method
     *
     * @param string|null $id Equipe id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $equipe = $this->Equipes->get($id, [
            'contain' => [],
        ]);

        $this->set('equipe', $equipe);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $equipe = $this->Equipes->newEntity();
        if ($this->request->is('post')) {
            $equipe = $this->Equipes->patchEntity($equipe, $this->request->getData());

            $equipe->autor = $this->Auth->usuario('usuario_id'); // Para salvar o 'autor'
            
            if ($this->Equipes->save($equipe)) {
                $this->Flash->success(__('The equipe has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The equipe could not be saved. Please, try again.'));
        }
        $this->set(compact('equipe'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Equipe id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $equipe = $this->Equipes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $equipe = $this->Equipes->patchEntity($equipe, $this->request->getData());
            if ($this->Equipes->save($equipe)) {
                $this->Flash->success(__('The equipe has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The equipe could not be saved. Please, try again.'));
        }
        $this->set(compact('equipe'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Equipe id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $equipe = $this->Equipes->get($id);
        if ($this->Equipes->delete($equipe)) {
            $this->Flash->success(__('The equipe has been deleted.'));
        } else {
            $this->Flash->error(__('The equipe could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
