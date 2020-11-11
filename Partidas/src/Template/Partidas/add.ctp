<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Partida $partida
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Partidas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="partidas form large-9 medium-8 columns content">
    <?= $this->Form->create($partida) ?>
    <fieldset>
        <legend><?= __('Add Partida') ?></legend>
        <?php
            echo $this->Form->control('equipe_casa_id', ['options' => $equipes]);
            echo $this->Form->control('equipe_fora_id', ['options' => $equipes]);
            echo $this->Form->control('data_partida');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
