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
	 		<legend><?= __('Edit Event'); ?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('event_type_id');
			echo $this->Form->input('title');
			echo $this->Form->input('details');
			echo $this->Form->input('start', ['interval' => 15, 'timeFormat' => 24]);
			echo $this->Form->input('end_date', ['interval' => 15, 'timeFormat' => 24]);

		?>
		</fieldset>
	<?= $this->Form->button(__('Submit', true));?>
	<?= $this->Form->end(); ?>
</div>