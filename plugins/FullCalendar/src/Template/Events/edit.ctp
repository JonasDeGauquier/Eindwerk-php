<?php
/*
 * Template/Events/edit.ctp
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
	<?= $this->Form->create($event, ['type' => 'file']);?>
		<fieldset>
	 		<legend><?= __('Pas type shift aan'); ?></legend>
		<?php
			echo $this->Form->input('id');
            echo $this->Form->input('event_type_id', ['label' => 'Type shift']);
            echo $this->Form->input('details');
            echo $this->Form->input('start', ['timeFormat' => 24, 'label' => 'Start datum']);
            echo $this->Form->input('end_date', ['timeFormat' => 24, 'label' => 'Eind datum']);

		?>
		</fieldset>
	<?= $this->Form->button(__('Pas aan', true));?>
	<?= $this->Form->end(); ?>
</div>