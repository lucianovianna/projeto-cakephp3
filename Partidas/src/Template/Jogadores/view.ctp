<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Jogadore $jogadore
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editar Jogador'), ['action' => 'edit', $jogadore->jogador_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Deletar Jogador'), ['action' => 'delete', $jogadore->jogador_id], ['confirm' => __('Are you sure you want to delete # {0}?', $jogadore->jogador_id)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Jogadores'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Cadastrar Jogador'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Cadastrar Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="jogadores view large-9 medium-8 columns content">
    <h3><?= h($jogadore->nome) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ID do Jogador') ?></th>
            <td><?= $this->Number->format($jogadore->jogador_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Equipe') ?></th>
            <td><?=  $this->Html->link($jogadore->equipe->nome, ['controller' => 'Equipes', 'action' => 'view', $jogadore->equipe->equipe_id]) ?></td>
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
            <th scope="row"><?= __('Posição') ?></th>
            <td><?= h($jogadore->posicao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Idade') ?></th>
            <td><?= $this->Number->format($jogadore->idade) ?></td>
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
