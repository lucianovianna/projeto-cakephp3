<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Equipe $equipe
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Listar Equipes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="equipes form large-9 medium-8 columns content">
    <?= $this->Form->create($equipe) ?>
    <fieldset>
        <legend><?= __('Cadastrar Equipe') ?></legend>
        <?php
            echo $this->Form->control('nome');
            echo $this->Form->control('data_fundacao');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
