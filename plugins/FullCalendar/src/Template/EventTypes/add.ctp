<?php
/*
 * Template/EventTypes/add.ctp
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
	<?= $this->Form->create($eventType);?>
		<fieldset>
	 		<legend><?= __('Add Event Type', ['label' => 'Voeg een type shift toe']); ?></legend>
		<?php
			echo $this->Form->input('name', ['label' => 'Naam']);
            echo $this->Form->input('start', ['timeFormat' => 24, 'label' => 'Start uur']);
            echo $this->Form->input('end_date', ['timeFormat' => 24, 'label' => 'Eind uur']);
		?>
		</fieldset>
	<?= $this->Form->button(__('Toevoegen', true));?>
	<?= $this->Form->end(); ?>
</div>