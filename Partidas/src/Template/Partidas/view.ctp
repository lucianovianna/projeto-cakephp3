<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Partida $partida
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Partida'), ['action' => 'edit', $partida->partida_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Partida'), ['action' => 'delete', $partida->partida_id], ['confirm' => __('Are you sure you want to delete # {0}?', $partida->partida_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Partidas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partida'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="partidas view large-9 medium-8 columns content">
    <h3><?= h($partida->partida_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Equipe') ?></th>
            <td><?= $partida->has('equipe') ? $this->Html->link($partida->equipe->equipe_id, ['controller' => 'Equipes', 'action' => 'view', $partida->equipe->equipe_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Partida Id') ?></th>
            <td><?= $this->Number->format($partida->partida_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Equipe Casa Id') ?></th>
            <td><?= $this->Number->format($partida->equipe_casa_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gols Fora') ?></th>
            <td><?= $this->Number->format($partida->gols_fora) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gols Casa') ?></th>
            <td><?= $this->Number->format($partida->gols_casa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Autor') ?></th>
            <td><?= $this->Number->format($partida->autor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data Partida') ?></th>
            <td><?= h($partida->data_partida) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($partida->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($partida->modified) ?></td>
        </tr>
    </table>
</div>
