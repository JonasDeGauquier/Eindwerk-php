<?php

/*
 * Controller/FullCalendarController.php
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
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\Filesystem\File;
use FullCalendar\Controller\FullCalendarAppController;
use PDO;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use ChromePhp;
use Cake\Routing\Router;
use App\Model\Entity\Personeel;
use FullCalendar\Model\Entity\EventType;

/**
 * FullCalendar Controller
 *
 * Curtisblack2004. (2013, 16 mei). Event Calendar Plugin for CakePHP. Geraadpleegd op 24 maart 2018, van https://github.com/curtisblack2004/CakePHP-Full-Calendar-Plugin
 *
 * @property \App\Model\Table\PersoneelTable $Personeel
 */
class FullCalendarController extends FullCalendarAppController
{
	public $name = 'FullCalendar';

	public function index($id=null) {

        $id = (new \Cake\Network\Session)->read('personeel');

        $conn = ConnectionManager::get('default');
        $stmt = $conn->prepare("SELECT * FROM personeel WHERE actief = 'true' AND id =:id");
        $stmt->execute(array(":id" => $id));

        $queryResult = $stmt ->fetch(PDO::FETCH_ASSOC);

        $this->set('naam', $queryResult);
	}

    /**
     * @param null $id
     */
	public function allCalenders($id=null) {
        $conn = ConnectionManager::get('default');
        $stmt2 = $conn->execute("SELECT * FROM personeel WHERE actief = 'true'");
        $queryResult = $stmt2 ->fetch(PDO::FETCH_ASSOC);
        $this->set('personeel', $queryResult);

    }
}