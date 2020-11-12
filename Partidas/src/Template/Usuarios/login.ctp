<div class="users form">
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
        <fieldset>
            <legend><?= __('Digite seu e-mail e senha:') ?></legend>
            <?= $this->Form->control('email') ?>
            <?= $this->Form->control('senha') ?>
        </fieldset>
    <?= $this->Form->button(__('Login')); ?>
    <?= $this->Form->end() ?>
</div>