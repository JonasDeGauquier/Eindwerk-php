<?php
/*
 * Controller/EventsController.php
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */

namespace FullCalendar\Controller;

use BOMO\IcalBundle\Provider\IcsProvider;
use Cake\Filesystem\File;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use ChromePhp;
use Cake\Routing\Router;

/**
 * Events Controller
 *
 * @property \FullCalendar\Model\Table\EventsTable $Events
 */
class EventsController extends FullCalendarAppController
{
    public $name = 'Events';
    public $paginate = ['limit' => 15];
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $events = $this->Events->find('all')->contain(['EventTypes']);
        if ($this->request->is('requested')) {
            $this->paginate = [
                'limit'   => 2,
                'order'   => ['Events.start' => 'desc']
            ];
            $this->response->body(json_encode($this->paginate($events)));
            return $this->response;
        } else {
            $this->paginate = [
                'limit'   => 12,
                'order'   => ['Events.start' => 'desc']
            ];
            $this->set('events', $this->paginate($events));
            $this->set('_serialize', ['events']);            
        }
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['EventTypes']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('Shift is toegevoegd'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Shift is niet toegevoegd. Probeer opnieuw!'));
            }
        }
        $this->set('eventTypes', $this->Events->EventTypes->find('list'));
        $this->set(compact('event'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($event_id = $this->Events->save($event)) {
                $this->Flash->success(__('Shift is aangepast'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Shift is niet toegevoegd. Probeer opnieuw!'));
            }
        }
        $eventTypes = $this->Events->EventTypes->find('list');
        $this->set(compact('event', 'eventTypes'));
        $this->set('_serialize', ['event', 'eventTypes']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('Shift is verwijderd'));
        } else {
            $this->Flash->error(__('Shift is niet verwijderd. Probeer opnieuw!'));
        }
        return $this->redirect(['action' => 'index']);
    }

    // The feed action is called from "webroot/js/ready.js" to get the list of events (JSON)
    public function feed($id=null) {
        $this->viewBuilder()->layout('ajax');
        $vars = $this->request->query([]);
        $conditions = ['UNIX_TIMESTAMP(start) >=' => $vars['start'], 'UNIX_TIMESTAMP(start) <=' => $vars['end']];
        if ($this->request->Session()->check('personeel') != true) {
            $user = (new \Cake\Network\Session)->read('User');
        }
        else {
            $user = (new \Cake\Network\Session)->read('personeel');
        }

        $events = $this->Events->find('all', $conditions)->contain(['EventTypes'])->where(['personeel_id =' => $user]);
        foreach($events as $event) {
            $eventsType = TableRegistry::get('EventTypes')->find('all')->where(['id =' => $event->event_type_id]);
            $results = $eventsType->all()->first();

            Time::setToStringFormat('YYYY-MM-dd HH:mm:ss');

            $startDate = new Time($event->start);
            $dateStart = strtotime($results->start);
            $startDate->addHours(date('H', $dateStart));
            $startDate->addMinutes(date('i', $dateStart));

            $endDate = new Time($event->end_date);
            $dateEnd = strtotime($results->end_date);
            $endDate->addHours(date('H', $dateEnd));
            $endDate->addMinutes(date('i', $dateEnd));

            $json[] = [
                    'id' => $event->id,
                    'title' => $results->name,
                    'details' => $event->details . ' ' . $results->start . ' '. $results->end_date,
                    'start'=> $startDate,
                    'end' => $endDate,
                    'url' => Router::url(['action' => 'view', $event->id]),

            ];
        }
        $this->set(compact('json'));
        $this->set('_serialize', 'json');
    }

    public function feedFull($id=null) {
        $test = $_COOKIE['test'];

        $test2 = explode(",", $test);
        include 'ChromePhp.php';
        ChromePhp::log($test2);

        $this->viewBuilder()->layout('ajax');
        $vars = $this->request->query([]);
        $conditions = ['UNIX_TIMESTAMP(start) >=' => $vars['start'], 'UNIX_TIMESTAMP(start) <=' => $vars['end']];

        $events = $this->Events->find("all" , array(
            'conditions' => array('personeel_id IN' => $test2)
        ));
        foreach($events as $event) {
            $eventsType = TableRegistry::get('EventTypes')->find('all')->where(['id =' => $event->event_type_id]);
            $results = $eventsType->all()->first();

            $personeel = TableRegistry::get('personeel')->find('all')->where(['id =' => $event->personeel_id]);
            $personeelResults = $personeel->all()->first();

            Time::setToStringFormat('YYYY-MM-dd HH:mm:ss');

            $startDate = new Time($event->start);
            $dateStart = strtotime($results->start);
            $startDate->addHours(date('H', $dateStart));
            $startDate->addMinutes(date('i', $dateStart));

            $endDate = new Time($event->end_date);
            $dateEnd = strtotime($results->end_date);
            $endDate->addHours(date('H', $dateEnd));
            $endDate->addMinutes(date('i', $dateEnd));

            $json[] = [
                'id' => $event->id,
                'title' => $personeelResults->voornaam. ' '. $personeelResults->achternaam . ': ' .$results->name,
                'details' => $personeelResults->voornaam . ' ' . $personeelResults->achternaam . ': '. $event->details . ' ' . $results->start . ' '. $results->end_date,
                'start'=> $startDate,
                'end' => $endDate,
                'url' => Router::url(['action' => 'view', $event->id]),

            ];
        }
        $this->set(compact('json'));
        $this->set('_serialize', 'json');
    }

    // The update action is called from "webroot/js/ready.js" to update date/time when an event is dragged or resized
    public function update($id = null)
    {
        if ($this->request->is('ajax')) {
            $this->request->accepts('application/json');
            $debuggedData = debug($this->request->data);
            $event = $this->Events->get($id);
            $event = $this->Events->patchEntity($event, $this->request->data);
            $this->Events->save($event);
            $this->set(compact('event'));
            $this->response->body(json_encode($this->request->data));
            return $this->response;
        }
    }

    /**
     * @return static
     */
    public function create() {

        $provider = new icsProvider();

        $tz = $provider->createTimezone();
        $tz
            ->setTzid('Europe/Brussels')
            ->setProperty('X-LIC-LOCATION', $tz->getTzid())
        ;

        $cal = $provider->createCalendar($tz);

        $cal
            ->setName('My cal1')
            ->setDescription('Foo')
        ;

        $user = (new \Cake\Network\Session)->read('User');
        $events = $this->Events->find('all')->contain(['EventTypes'])->where(['personeel_id =' => $user]);

        foreach($events as $event) {

            $eventsType = TableRegistry::get('EventTypes')->find('all')->where(['id =' => $event->event_type_id]);
            $results = $eventsType->all()->first();

            Time::setToStringFormat('YYYY-MM-dd HH:mm:ss');
            $startDate = new Time($event->start);
            $dateStart = strtotime($results->start);

            $startDate->addHours(date('H', $dateStart )-2);
            $startDate->addMinutes(date('i', $dateStart));

            $endDate = new Time($event->end_date);
            $dateEnd = strtotime($results->end_date);
            $endDate->addHours(date('H', $dateEnd) -2);
            $endDate->addMinutes(date('i', $dateEnd));

            $event = $cal->newEvent();
            $event
                ->setStartDate($startDate)
                ->setEndDate($endDate)
                ->setName($results->name)
            ;
        }

        $calStr = $cal->returnCalendar();

        $file = new File('plugins/FullCalendar/src/files/ical.ics', true);
        $file->write($calStr);

        $response = $this->response->withFile(
            $file->path,
            ['download' => true, 'name' => 'ical.ics']
        );

        return $response;
    }
}