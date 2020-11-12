<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Jogadore[]|\Cake\Collection\CollectionInterface $jogadores
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Jogador'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="jogadores index large-9 medium-8 columns content">
    <h3><?= __('Jogadores') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('jogador_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('equipe_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sobrenome') ?></th>
                <th scope="col"><?= $this->Paginator->sort('idade') ?></th>
                <th scope="col"><?= $this->Paginator->sort('posicao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('autor') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jogadores as $jogadore): ?>
            <tr>
                <td><?= $this->Number->format($jogadore->jogador_id) ?></td>
                <td><?= $jogadore->has('equipe') ? $this->Html->link($jogadore->equipe->nome, ['controller' => 'Equipes', 'action' => 'view', $jogadore->equipe->equipe_id]) : '' ?></td>
                <td><?= h($jogadore->nome) ?></td>
                <td><?= h($jogadore->sobrenome) ?></td>
                <td><?= $this->Number->format($jogadore->idade) ?></td>
                <td><?= h($jogadore->posicao) ?></td>
                <td><?= h($jogadore->created) ?></td>
                <td><?= h($jogadore->modified) ?></td>
                <td><?= $this->Html->link($jogadore->autor,  ['controller' => 'Usuarios', 'action' => 'view', $jogadore->autor]) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $jogadore->jogador_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $jogadore->jogador_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $jogadore->jogador_id], ['confirm' => __('Are you sure you want to delete # {0}?', $jogadore->jogador_id)]) ?>
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
