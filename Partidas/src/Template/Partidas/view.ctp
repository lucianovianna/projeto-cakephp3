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
        <li><?= $this->Html->link(__('List Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="partidas view large-9 medium-8 columns content">
    <h3><?= 'Partida '. h($partida->partida_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Partida Id') ?></th>
            <td><?= $this->Number->format($partida->partida_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Equipe de Casa') ?></th>
            <td><?= $this->Html->link($partida->equipeA->nome, ['controller' => 'Equipes', 'action' => 'view', $partida->equipe_de_casa_id]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Equipe de Fora') ?></th>
            <td><?= $this->Html->link($partida->equipeB->nome, ['controller' => 'Equipes', 'action' => 'view', $partida->equipe_de_fora_id]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gols do(a) '. $partida->equipeA->nome) ?></th>
            <td><?= $this->Number->format($partida->gols_casa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gols do(a) '. $partida->equipeB->nome) ?></th>
            <td><?= $this->Number->format($partida->gols_fora) ?></td>
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
        <tr>
            <th scope="row"><?= __('Autor') ?></th>
            <td><?= $this->Html->link($partida->usuario->nome_de_usuario, ['controller' => 'Usuarios', 'action' => 'view', $partida->usuario_id]) ?></td>
        </tr>
    </table>
</div>

