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
<div class="row">
    <div class="col-md-3 scroll">
        <p>Filter op persoon</p>
        <?php foreach ($personeel as $personeel): ?>
        <div>
            <input type="checkbox" value="<?= ($personeel->id) ?>" id="<?= ($personeel->id) ?>">
            <label><?= ($personeel->voornaam . ' '. $personeel->achternaam) ?></label>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="Calendar index col-md-9">
        <div id="calendar"></div>
    </div>
</div>

<?= $this->Html->css('/full_calendar/css/fullcalendar.min', ['plugin' => true]); ?>
<?= $this->Html->css('/full_calendar/css/jquery.qtip.min', ['plugin' => true]); ?>
<?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js') ?>
<?= $this->Html->script('/full_calendar/js/lib/moment.min.js', ['plugin' => true]); ?>
<?= $this->Html->script('/full_calendar/js/fullcalendar.js', ['plugin' => true]); ?>
<?= $this->Html->script('/full_calendar/js/jquery.qtip.min.js', ['plugin' => true]); ?>
<?= $this->Html->script('/full_calendar/js/readyFull.js', ['plugin' => true]); ?>
<?= $this->Html->script('/full_calendar/js/lang/nl.js', ['plugin' => true]); ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js', ['plugin' => true]); ?>

