<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Partida $partida
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $partida->partida_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $partida->partida_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Partidas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="partidas form large-9 medium-8 columns content">
    <?= $this->Form->create($partida) ?>
    <fieldset>
        <legend><?= __('Edit Partida') ?></legend>
        <?php
            echo $this->Form->control('equipe_casa_id', ['options' => $formOptions]);
            echo $this->Form->control('equipe_fora_id', ['options' => $formOptions]);
            echo $this->Form->control('data_partida', ['minYear' => 1950, 'maxYear' => date('Y')]);
            echo $this->Form->control('gols_casa', ['label' => 'Gols da Equipe de Casa']);
            echo $this->Form->control('gols_fora', ['label' => 'Gols da Equipe de Fora']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
