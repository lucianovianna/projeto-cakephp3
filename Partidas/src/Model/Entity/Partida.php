<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Partida Entity
 *
 * @property int $partida_id
 * @property int $equipe_casa_id
 * @property int $equipe_fora_id
 * @property \Cake\I18n\FrozenTime $data_partida
 * @property int $gols_fora
 * @property int $gols_casa
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $autor
 *
 * @property \App\Model\Entity\Equipe $equipe
 * @property \App\Model\Entity\Usuario $usuario
 */
class Partida extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'equipe_casa_id' => true,
        'equipe_fora_id' => true,
        'data_partida' => true,
        'gols_fora' => true,
        'gols_casa' => true,
        'created' => true,
        'modified' => true,
        'autor' => true,
        'equipe' => true,
        'usuario' => true,
    ];
}
