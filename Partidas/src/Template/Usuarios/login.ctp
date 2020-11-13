<div class="usuarios form">
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
        <fieldset>
            <legend><?= __('Digite seu e-mail e senha:') ?></legend>
            <?= $this->Form->control('email', ['type' => 'email']) ?>
            <?= $this->Form->control('senha', ['type' => 'password']) ?>
        </fieldset>
    <?= $this->Form->button(__('Login')); ?>
    <?= $this->Form->end() ?>
</div>