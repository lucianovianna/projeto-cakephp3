<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Equipe[]|\Cake\Collection\CollectionInterface $equipes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Equipe'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="equipes index large-9 medium-8 columns content">
    <h3><?= __('Equipes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('equipe_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                <th scope="col"><?= $this->Paginator->sort('data_fundacao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipes as $equipe): ?>
            <tr>
                <td><?= $this->Number->format($equipe->equipe_id) ?></td>
                <td><?= h($equipe->nome) ?></td>
                <td><?= h($equipe->data_fundacao) ?></td>
                <td><?= h($equipe->created) ?></td>
                <td><?= h($equipe->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $equipe->equipe_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $equipe->equipe_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $equipe->equipe_id], ['confirm' => __('Are you sure you want to delete # {0}?', $equipe->equipe_id)]) ?>
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
