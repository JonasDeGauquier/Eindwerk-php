<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Personeel Entity
 *
 * @property int $id
 * @property string $voornaam
 * @property string $achternaam
 * @property \Cake\I18n\FrozenDate $geboortedatum
 * @property string $email
 * @property int $adres_id
 * @property int $rol_id
 * @property bool $actief
 *
 * @property \App\Model\Entity\Adre $adre
 * @property \App\Model\Entity\Rol $rol
 */
class Personeel extends Entity
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
        'voornaam' => true,
        'achternaam' => true,
        'actief' => true,
    ];
}
