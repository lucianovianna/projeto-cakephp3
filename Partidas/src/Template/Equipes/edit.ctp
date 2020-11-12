<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Equipe $equipe
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $equipe->equipe_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $equipe->equipe_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Equipes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="equipes form large-9 medium-8 columns content">
    <?= $this->Form->create($equipe) ?>
    <fieldset>
        <legend><?= __('Edit Equipe') ?></legend>
        <?php
            echo $this->Form->control('nome');
            echo $this->Form->control('data_fundacao');
            echo $this->Form->control('autor');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
