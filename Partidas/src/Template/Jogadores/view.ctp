<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Jogadore $jogadore
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Jogadore'), ['action' => 'edit', $jogadore->jogador_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Jogador'), ['action' => 'delete', $jogadore->jogador_id], ['confirm' => __('Are you sure you want to delete # {0}?', $jogadore->jogador_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Jogadores'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Jogador'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="jogadores view large-9 medium-8 columns content">
    <h3><?= h($jogadore->nome) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Jogador Id') ?></th>
            <td><?= $this->Number->format($jogadore->jogador_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Equipe') ?></th>
            <td><?= $jogadore->has('equipe') ? $this->Html->link($jogadore->equipe->nome, ['controller' => 'Equipes', 'action' => 'view', $jogadore->equipe->equipe_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($jogadore->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sobrenome') ?></th>
            <td><?= h($jogadore->sobrenome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Posicao') ?></th>
            <td><?= h($jogadore->posicao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Idade') ?></th>
            <td><?= $this->Number->format($jogadore->idade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Autor') ?></th>
            <td><?= $jogadore->has('usuario') ? $this->Html->link($jogadore->usuario->nome_de_usuario, ['controller' => 'Usuarios', 'action' => 'view', $jogadore->usuario->usuario_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($jogadore->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($jogadore->modified) ?></td>
        </tr>
    </table>
</div>
