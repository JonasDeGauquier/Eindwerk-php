<?php
/*
 * Template/Events/index.ctp
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */
?>

<div class="events small-12 medium-8 large-12 columns">
	<h2 class="inline-block"><?= __('Werkdagen');?></h2>
	<ul class="no-bullet inline-list inline-block">
		<li><?= $this->Html->link(__('Voeg shift toe', true), ['action' => 'add']); ?></li>
		<li><?= $this->Html->link(__('Beheer soorten shiften', true), ['controller' => 'event_types', 'action' => 'index']); ?> </li>
		<li><?= $this->Html->link(__('Toon kalender', true), ['controller' => 'full_calendar']); ?></li>
	</ul>
	<table cellpadding="0" cellspacing="0" class="small-12 columns">
		<tr>
				<th><?= $this->Paginator->sort('event_type_id' , 'Shift');?></th>
				<th><?= $this->Paginator->sort('details' , 'Details');?></th>
				<th><?= $this->Paginator->sort('start' , 'Begin datum');?></th>
	            <th><?= $this->Paginator->sort('end_date', 'Eind datum');?></th>
				<th class="actions"></th>
		</tr>
		<?php
			$i = 0;
			foreach ($events as $event):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
		?>
			<tr<?= $class;?>>
				<td>
					<?= $this->Html->link($event->event_type->name, ['controller' => 'event_types', 'action' => 'view', $event->event_type->id]); ?>
				</td>
                <td><?= $event->details ?></td>
				<td><?= $event->start ?></td>
                <td><?= $event->end_date ?></td>
				<td class="actions">
					<?= $this->Html->link(__('Aanpassen', true), ['action' => 'edit', $event->id]); ?>
					<?= $this->Form->postLink('Verwijder', ['action' => 'delete', $event->id], ['confirm' => 'Bent u zeker']); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<div class="paginator small-12 small-centered medium-8 medium-centered large-6 large-centered columns text-center">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>