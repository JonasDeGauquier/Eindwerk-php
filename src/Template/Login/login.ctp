<div class="users form">
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Gelieve uw gebruikersnaam en wachtwoord in te geven') ?></legend>
        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
    <?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary']); ?>
    <?= $this->Form->end() ?>
</div>