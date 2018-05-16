<?php
/*
 * Template/EventTypes/edit.ctp
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */
?>

<div class="float-none form small-12 medium-12 large-12 columns">
    <?= $this->Form->create($eventType); ?>
    <fieldset>
        <legend><?= __('Edit Event Type'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name');
        echo $this->Form->input('start', ['timeFormat' => 24]);
        echo $this->Form->input('end_date', ['timeFormat' => 24]);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit', true)); ?>
    <?= $this->Form->end(); ?>
</div>