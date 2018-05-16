<?php
/*
 * Template/Events/view.ctp
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */
?>

<div class="small-12 columns">
	<ul class="inline-list">
		<li><?= $this->Html->link(__('Edit Event', true), ['action' => 'edit', $event->id]); ?> </li>
		<li><?= $this->Html->link(__('Delete Event', true), ['action' => 'delete', $event->id], [], sprintf(__('Are you sure you want to delete this %s event?', true), $event->event_type->name)); ?> </li>
    </ul>
    <h1 class="inline-block"><?= __('Shift'); ?></h1>
    <p class="inline-block"><?= $this->Html->link($event->event_type->name, ['controller' => 'event_types', 'action' => 'view', $event->event_type->id]); ?></p>
	<h2><?= $event->title; ?></h2>
	<h3><?= $event->start->format('F jS @ g:ia'); ?> - <?= $event->end_date->format('g:ia'); ?></h3>
	<p>
		<span><?= __('DETAILS: '); ?></span>
	</p>
    <p>
        <?= $event->details; ?>
    </p>
	<p>
		<span><?= __('DATE: '); ?></span>
		<?= $event->start->format('l, F jS'); ?>
	</p>
	<p>
		<span><?= __('TIME: '); ?></span>
		<?php if($event->all_day != 1): ?>
			<?= $event->start->format('g:ia'); ?> - <?= $event->end_date->format('g:ia'); ?>
		<?php else: ?>
			<?= "N/A"; ?>
		<?php endif; ?> 
	</p>
</div>