<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Partidas Model
 *
 * @property \App\Model\Table\EquipesTable&\Cake\ORM\Association\BelongsTo $Equipes
 * @property \App\Model\Table\EquipesTable&\Cake\ORM\Association\BelongsTo $Equipes
 *
 * @method \App\Model\Entity\Partida get($primaryKey, $options = [])
 * @method \App\Model\Entity\Partida newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Partida[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Partida|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Partida saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Partida patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Partida[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Partida findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PartidasTable extends Table
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

        $this->setTable('partidas');
        $this->setDisplayField('partida_id');
        $this->setPrimaryKey('partida_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EquipesA', [
            'className' => 'Equipes',
            'propertyName' => 'equipeA',
            'foreignKey' => 'equipe_casa_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('EquipesB', [
            'className' => 'Equipes',
            'propertyName' => 'equipeB',
            'foreignKey' => 'equipe_fora_id',
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
            ->integer('partida_id')
            ->allowEmptyString('partida_id', null, 'create');

        $validator
            ->dateTime('data_partida')
            ->requirePresence('data_partida', 'create')
            ->notEmptyDateTime('data_partida');

        $validator
            ->integer('gols_fora')
            ->requirePresence('gols_fora', 'create')
            ->notEmptyString('gols_fora');

        $validator
            ->integer('gols_casa')
            ->requirePresence('gols_casa', 'create')
            ->notEmptyString('gols_casa');

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
        $rules->add($rules->existsIn(['equipe_casa_id'], 'Equipes'));
        $rules->add($rules->existsIn(['equipe_fora_id'], 'Equipes'));

        return $rules;
    }
}
