<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace src/Template/Pages/home.ctp with your own version or re-enable debug mode.'
    );
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('home.css') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>

<body class="home">
    <header class="row">
        <div class="header-image"><?= $this->Html->image('cake.logo.svg') ?></div>
        <div class="header-title">
            <h1>Sistema de Partidas</h1>
        </div>
    </header>
    <div class="medium-4 text-center row">
        <span> 
            <?php 
                if(is_null($this->request->session()->read('Auth.User.nome_de_usuario'))) 
                {  // se o Usuario estiver deslogado.
                    echo $this->Html->link('Fazer login', ['controller' => 'Usuarios', 'action' => 'login']);
                }
                else 
                { // se o Usuario estiver logado.
                    $username = $this->request->session()->read('Auth.User.nome_de_usuario');

                    echo "Logado como: <strong>$username</strong> <br>";
                    echo $this->Html->link('Logout', ['controller' => 'Usuarios', 'action' => 'logout']);
                    echo ' | ';
                    echo $this->Html->link('Cadastrar Usuário', ['controller' => 'Usuarios', 'action' => 'add']);
                    echo ' | ';
                    echo $this->Html->link('Listar Usuários', ['controller' => 'Usuarios', 'action' => 'index']);
                }
            ?>
        </span>
        <br><hr><br>
    </div>
    <div class="rows">
        <div class="columns medium-6 text-center">
            <h4> Equipes </h4>
            <li> <?= $this->Html->link(__('Cadastrar Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?> </li>
            <li> <?= $this->Html->link(__('Listar Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?> </li>
            <br><br>
        </div>
        <div class="columns medium-6 text-center">
            <h4> Jogadores </h4>
            <li> <?= $this->Html->link(__('Cadastrar Jogador'), ['controller' => 'Jogadores', 'action' => 'add']) ?> </li>
            <li> <?= $this->Html->link(__('Listar Jogadores'), ['controller' => 'Jogadores', 'action' => 'index']) ?> </li>
            <br><br>
        </div>
        <div class="columns medium-6 text-center">
            <h4> Partidas </h4>
            <li> <?= $this->Html->link(__('Cadastrar Partida'), ['controller' => 'Partidas', 'action' => 'add']) ?> </li>
            <li> <?= $this->Html->link(__('Listar Partidas'), ['controller' => 'Partidas', 'action' => 'index']) ?> </li>
            <br><br>
        </div>
        <div class="columns medium-6 text-center">
            <h4> Relatórios </h4>
            <li> <?= $this->Html->link(__('Todos os Jogos'), ['controller' => 'Exports', 'action' => 'report1']) ?> </li>
            <li> <?= $this->Html->link(__('Times com mais vitorias'), ['controller' => 'Exports', 'action' => 'report2']) ?>  </li>
            <li> <?= $this->Html->link(__('Jogadores com mais vitorias'), ['controller' => 'Exports', 'action' => 'report3']) ?>  </li>
            <br><br>
        </div>
    </div>

</body>
</html>

