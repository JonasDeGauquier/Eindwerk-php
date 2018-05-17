<?php
/*
 * Template/FullCalendar/index.ctp
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */
?>
    <div class="Calendar index">
        <div id="calendar"></div>
    </div>
<div class="row">
    <?php

    $rol = (new \Cake\Network\Session)->read('Rol');

    if ($rol == 1) {
        ?>
        <div class="col-md-9">
            <div class="actions">
                <ul class="no-bullet">
                    <li><?= $this->Html->link(__('Voeg een shift toe', true), ['controller' => 'events', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link(__('Beheer shifts', true), ['controller' => 'events']) ?></li>
                    <li><?= $this->Html->link(__('Beheer soorten shifts', true), ['controller' => 'event_types']) ?></li>
                </ul>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="col-md-3">
        <?= $this->Html->link(__('Download ics bestand', true), ['controller' => 'fullCalendar', 'action' => 'create'], ['class' => 'button']) ?>
    </div>
</div>
    <?= $this->Html->css('/full_calendar/css/fullcalendar.min', ['plugin' => true]); ?>
    <?= $this->Html->css('/full_calendar/css/jquery.qtip.min', ['plugin' => true]); ?>
    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js') ?>
    <?= $this->Html->script('/full_calendar/js/lib/moment.min.js', ['plugin' => true]); ?>
    <?= $this->Html->script('/full_calendar/js/fullcalendar.js', ['plugin' => true]); ?>
    <?= $this->Html->script('/full_calendar/js/jquery.qtip.min.js', ['plugin' => true]); ?>
    <?= $this->Html->script('/full_calendar/js/ready.js', ['plugin' => true]); ?>
    <?= $this->Html->script('/full_calendar/js/lang/nl.js', ['plugin' => true]); ?>

