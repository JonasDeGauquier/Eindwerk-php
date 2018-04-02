<?php
namespace FullCalendar\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity.
 */
class Event extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'id' => false,
        'event_type_id' => true,
        'details' => true,
        'start' => true,
        'end_date' => true,
        'active' => true,
    ];
}
