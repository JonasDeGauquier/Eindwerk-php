<?php
/**
 * Created by PhpStorm.
 * User: jonasdegauquier
 * Date: 15/05/18
 * Time: 15:52
 */

namespace App\Controller;

use BOMO\IcalBundle\Provider\IcsProvider;
use Cake\Filesystem\File;
use Cake\Http\Response;

class IcalController extends AppController
{

    public function create() {

        $provider = new icsProvider();

        $tz = $provider->createTimezone();
        $tz
            ->setTzid('Europe/Paris')
            ->setProperty('X-LIC-LOCATION', $tz->getTzid())
        ;

        $cal = $provider->createCalendar($tz);

        $cal
            ->setName('My cal1')
            ->setDescription('Foo')
        ;

        $datetime = new \Datetime('now');
        $event = $cal->newEvent();
        $event
            ->setStartDate($datetime)
            ->setEndDate($datetime->modify('+5 hours'))
            ->setName('Event 1')
            ->setDescription('Desc for event')
            ->setAttendee('John Do')
        ;

        $calStr = $cal->returnCalendar();

        $file = new File('src/files/ical.ics', true);
        $file->write($calStr);

        $response = $this->response->withFile(
            $file->path,
            ['download' => true, 'name' => 'ical.ics']
        );

        return $response;


    }
}