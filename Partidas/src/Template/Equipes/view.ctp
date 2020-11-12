<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Equipe $equipe
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Equipe'), ['action' => 'edit', $equipe->equipe_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Equipe'), ['action' => 'delete', $equipe->equipe_id], ['confirm' => __('Are you sure you want to delete # {0}?', $equipe->equipe_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Equipes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipe'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="equipes view large-9 medium-8 columns content">
    <h3><?= h($equipe->equipe_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($equipe->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Equipe Id') ?></th>
            <td><?= $this->Number->format($equipe->equipe_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Autor') ?></th>
            <td><?= $this->Number->format($equipe->autor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data Fundacao') ?></th>
            <td><?= h($equipe->data_fundacao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($equipe->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($equipe->modified) ?></td>
        </tr>
    </table>
</div>
