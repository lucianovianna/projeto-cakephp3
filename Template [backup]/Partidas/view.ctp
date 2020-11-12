<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Partida $partida
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editar Partida'), ['action' => 'edit', $partida->partida_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Deletar Partida'), ['action' => 'delete', $partida->partida_id], ['confirm' => __('Are you sure you want to delete # {0}?', $partida->partida_id)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Partidas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Cadastrar Partida'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Cadastrar Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="partidas view large-9 medium-8 columns content">
    <h3><?='Partida '. h($partida->partida_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ID da Partida') ?></th>
            <td><?= $this->Number->format($partida->partida_id) ?></td>
        </tr>
        <tr>
            <th scope="row"> <?= __('Equipe de Casa') ?> </th>
            <td>
                <?= $this->Html->link($partida->equipe_casa_id, ['controller' => 'Equipes', 'action' => 'view', $partida->equipe_casa_id]) ?> 
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Equipe de Fora') ?></th>
            <td>
                <?= $this->Html->link($partida->equipe_fora_id, ['controller' => 'Equipes', 'action' => 'view', $partida->equipe_fora_id]) ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data da Partida') ?></th>
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
