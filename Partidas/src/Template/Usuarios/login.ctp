<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Go to Home'), ['controller' => 'Pages','action' => 'index']) ?></li>
    </ul>
</nav>
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