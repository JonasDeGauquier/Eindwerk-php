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
 * @property \App\Model\Table\PersoneelTable $Personeel
 */
class FullCalendarController extends FullCalendarAppController
{
	public $name = 'FullCalendar';

	public function index($id=null) {

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