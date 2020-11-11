<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Partida[]|\Cake\Collection\CollectionInterface $partidas
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Cadastrar Partida'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Cadastrar Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="partidas index large-9 medium-8 columns content">
    <h3><?= __('Partidas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('partida_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('equipe_casa_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('equipe_fora_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('data_partida') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partidas as $partida): ?>
            <tr>
                <td><?= $this->Number->format($partida->partida_id) ?></td>
                <td><?= $this->Html->link($partida->equipe_casa_id, ['controller' => 'Equipes', 'action' => 'view', $partida->equipe_casa_id]) ?></td>
                <td><?= $this->Html->link($partida->equipe_fora_id, ['controller' => 'Equipes', 'action' => 'view', $partida->equipe_fora_id]) ?></td>
                <td><?= h($partida->data_partida) ?></td>
                <td><?= h($partida->created) ?></td>
                <td><?= h($partida->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $partida->partida_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $partida->partida_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $partida->partida_id], ['confirm' => __('Are you sure you want to delete # {0}?', $partida->partida_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
