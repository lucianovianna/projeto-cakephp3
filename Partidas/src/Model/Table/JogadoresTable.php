<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Jogadores Model
 *
 * @property \App\Model\Table\EquipesTable&\Cake\ORM\Association\BelongsTo $Equipes
 *
 * @method \App\Model\Entity\Jogadore get($primaryKey, $options = [])
 * @method \App\Model\Entity\Jogadore newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Jogadore[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Jogadore|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Jogadore saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Jogadore patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Jogadore[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Jogadore findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class JogadoresTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('jogadores');
        $this->setDisplayField('jogador_id');
        $this->setPrimaryKey('jogador_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Equipes', [
            'foreignKey' => 'equipe_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('jogador_id')
            ->allowEmptyString('jogador_id', null, 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 255)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('sobrenome')
            ->maxLength('sobrenome', 255)
            ->requirePresence('sobrenome', 'create')
            ->notEmptyString('sobrenome');

        $validator
            ->integer('idade')
            ->requirePresence('idade', 'create')
            ->notEmptyString('idade');

        $validator
            ->scalar('posicao')
            ->maxLength('posicao', 255)
            ->requirePresence('posicao', 'create')
            ->notEmptyString('posicao');

        $validator
            ->integer('autor')
            ->allowEmptyString('autor');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['equipe_id'], 'Equipes'));

        return $rules;
    }
}
