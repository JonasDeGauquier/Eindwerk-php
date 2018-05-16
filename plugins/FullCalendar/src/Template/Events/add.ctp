<?php
/*
 * Template/Events/add.ctp
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
<?= $this->Form->create($event);?>
	<fieldset>
 		<legend><?= __('Voeg shift toe  '); ?></legend>
	<?php
		echo $this->Form->input('event_type_id');
		echo $this->Form->input('details');
        echo $this->Form->input('start', ['timeFormat' => 24]);
        echo $this->Form->input('end_date', ['timeFormat' => 24]);
        if ((new \Cake\Network\Session)->check('personeel')) {
            echo  $this->Form->hidden( 'personeel_id', array( 'value' =>  (new \Cake\Network\Session)->read('personeel') ) );
        } else {
            echo  $this->Form->hidden( 'personeel_id', array( 'value' =>  (new \Cake\Network\Session)->read('User') ) );
        }
	?>
	</fieldset>
<?= $this->Form->button(__('Submit', true));?>
<?= $this->Form->end(); ?>
</div>