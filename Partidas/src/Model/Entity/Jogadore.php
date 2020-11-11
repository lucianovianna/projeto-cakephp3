<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Jogadore Entity
 *
 * @property int $jogador_id
 * @property int $equipe_id
 * @property string $nome
 * @property string $sobrenome
 * @property int $idade
 * @property string $posicao
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Equipe $equipe
 */
class Jogadore extends Entity
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
        'equipe_id' => true,
        'nome' => true,
        'sobrenome' => true,
        'idade' => true,
        'posicao' => true,
        'created' => true,
        'modified' => true,
        'equipe' => true,
    ];
}
