<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Personeel $personeel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Personeel'), ['action' => 'edit', $personeel->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Personeel'), ['action' => 'delete', $personeel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personeel->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Personeel'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Personeel'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Adres'), ['controller' => 'Adres', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Adre'), ['controller' => 'Adres', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rol'), ['controller' => 'Rol', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rol'), ['controller' => 'Rol', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="personeel view large-9 medium-8 columns content">
    <h3><?= h($personeel->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Adre') ?></th>
            <td><?= $personeel->has('adre') ? $this->Html->link($personeel->adre->id, ['controller' => 'Adres', 'action' => 'view', $personeel->adre->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rol') ?></th>
            <td><?= $personeel->has('rol') ? $this->Html->link($personeel->rol->id, ['controller' => 'Rol', 'action' => 'view', $personeel->rol->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($personeel->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Geboortedatum') ?></th>
            <td><?= h($personeel->geboortedatum) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Actief') ?></th>
            <td><?= $personeel->actief ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Voornaam') ?></h4>
        <?= $this->Text->autoParagraph(h($personeel->voornaam)); ?>
    </div>
    <div class="row">
        <h4><?= __('Achternaam') ?></h4>
        <?= $this->Text->autoParagraph(h($personeel->achternaam)); ?>
    </div>
    <div class="row">
        <h4><?= __('Email') ?></h4>
        <?= $this->Text->autoParagraph(h($personeel->email)); ?>
    </div>
</div>
