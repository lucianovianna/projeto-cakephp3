<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Jogadore $jogadore
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Deletar'),
                ['action' => 'delete', $jogadore->jogador_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $jogadore->jogador_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Jogadores'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Cadastrar Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="jogadores form large-9 medium-8 columns content">
    <?= $this->Form->create($jogadore) ?>
    <fieldset>
        <legend><?= __('Edit Jogador') ?></legend>
        <?php
            echo $this->Form->control('equipe_id', ['options' => $equipes]);
            echo $this->Form->control('nome');
            echo $this->Form->control('sobrenome');
            echo $this->Form->control('idade');
            echo $this->Form->control('posicao');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>