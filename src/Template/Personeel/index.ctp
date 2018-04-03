<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Personeel[]|\Cake\Collection\CollectionInterface $personeel
 */
?>
<div class="personeel index large-12 medium-8 columns content">
    <h3><?= __('Personeel') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('voornaam') ?></th>
                <th scope="col"><?= $this->Paginator->sort('achternaam') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personeel as $personeel): ?>
            <tr>
                <td><?= h($personeel->voornaam) ?></td>
                <td><?= h($personeel->achternaam) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Planning'),  array('controller'=>'FullCalendar.Events', 'action'=>'feed', $personeel->id)) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Pagina {{page}} van {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
