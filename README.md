## PARTIDAS:


- bd relacional
    - usuarios
    - equipes
    - partidas
    - jogadores

- relatorios


#### O que foi feito

- Criado o DATABASE com 4 tabelas:
    - usuarios
    - equipes
    - partidas
    - jogadores

<hr>

- Para criar a migration baseada no DATABASE criado;
    - bin/cake bake migration_snapshot EsquemaPartidas
- Para a criação do esqueleto do MVC:
    - bin/cake bake all usuarios
    - bin/cake bake all equipes
    - bin/cake bake all jogadores
    - bin/cake bake all partidas
- Criado o sistema de autentificação
    - Foi utilizado esse tutorial: https://book.cakephp.org/3/en/tutorials-and-examples/blog-auth-example/auth.html
    - Como não foi utilizando os nomes padrões na tabela de Usuários, foi necessário adicionar essas linhas no AppController.php:
        - ``` php
            $this->loadComponent('Auth', [
                'loginAction' => [
                    'controller' => 'Usuarios',
                    'action' => 'login'
                ],
                'logoutRedirect' => [
                    'controller' => 'Pages',
                    'action' => 'display',
                    'home'
                ],
                'authenticate' => [
                    'Form' => [
                        'userModel' => 'Usuarios',
                        'fields' => ['username' => 'email', 'password' => 'senha']
                    ]
                ]
            ]);
          ```
          - Dessa forma, avisamos ao Auth que o nosso Model e Controller se chama Usuarios e que os campos de autentificação são o e-mail e senha.
- Remover o Form do campo 'autor' das views dos Templates, pois eles devem ser configurados automaticamente, dessa forma:
    - Nos controllers:
        - `$jogadore->autor = $this->Auth->user('usuario_id');`
            - Colocar no add() e no edit(), após a post request;
- Arrumando os Forms dos Jogadores e das Partidas, para onde requisita escolher equipe(s), aparecer o nome delas ao invés do ID.
    - Primeiro deve-se verificar no Model/Table se o 'belongsTo' está configurado, no caso do Partidas que há 2 FOREIGN KEYS, foi feito isso:
        - ``` php
            $this->belongsTo('EquipesA', [
                'className' => 'Equipes',
                'propertyName' => 'equipeA',
                'foreignKey' => 'equipe_casa_id',
                'joinType' => 'INNER',
            ]);
            $this->belongsTo('EquipesB', [
                'className' => 'Equipes',
                'propertyName' => 'equipeB',
                'foreignKey' => 'equipe_fora_id',
                'joinType' => 'INNER',
            ]); 
            ```
        - Isso também resolve o problema na hora de linkar a equipe_de_casa e a equipe_de_fora, usando o 'propertyName' como referencia.
    - No Controller:
        - ``` php
            $formOptions = $this->Partidas->EquipesA->find('list', [
            'keyField' => 'equipe_id', 
            'valueField' => 'nome'
            ]);
            ```
    - Na view:
        - `echo $this->Form->control('equipe_casa_id', ['options' => $formOptions]); `
- Atualizando os Validators das Equipes e dos Usuarios (para não ter equipes com o mesmo 'nome' nem usuarios com o mesmo 'nome_de_usuario' ou 'email'):
    - No Model/Table:
        - ``` php
            $validator
            ->scalar('nome_de_usuario')
            ->maxLength('nome_de_usuario', 255)
            ->requirePresence('nome_de_usuario', 'create')
            ->notEmptyString('nome_de_usuario', 'Insira seu nome de usuário')
            ->add( // <--
                'nome_de_usuario', 
                ['unique' => [
                    'rule' => 'validateUnique', 
                    'provider' => 'table', 
                    'message' => 'Esse Nome de Usuário já está cadastrado.']
                ]
            );
          ```
- Adicionando itens ao banco de dados:
    - Usei o generatedata.com (https://github.com/benkeen/generatedata)


- Relatórios:
    - Foi feito 3 relatórios para serem exportados em .csv:
        - *Todos os Jogos*: Time casa, Time visitante, gols casa, gols visitante;
        - *Times com mais vitorias*: Time, numero de gols, numero de vitorias;
        - *Jogadores com mais vitorias*: Jogador, numero de vitorias.
    - Criado as querys de cada relatório
        - *Todos os jogos*:
            - ``` sql
                SELECT eq.nome AS Equipe_da_Casa,
                    eq2.nome AS Equipe_de_Fora,
                    pt.gols_casa AS Gols_Casa,
                    pt.gols_fora AS Gols_Fora,
                    pt.data_partida
                FROM partidas AS pt
                    JOIN equipes eq ON eq.equipe_id = pt.equipe_casa_id
                    JOIN equipes eq2 ON eq2.equipe_id = pt.equipe_fora_id
                ORDER BY pt.data_partida DESC;
              ```
        - *Times com mais vitorias*
            - ``` sql
                SELECT eq.nome,
                    count(
                        IF(
                            eq.equipe_id = pt.equipe_casa_id,
                            IF(pt.gols_casa > pt.gols_fora, 1, NULL),
                            IF(pt.gols_fora > pt.gols_casa, 1, NULL)
                        )
                    ) AS Vitorias,
                    SUM(
                        IF(
                            eq.equipe_id = pt.equipe_casa_id,
                            pt.gols_casa - pt.gols_fora,
                            pt.gols_fora - pt.gols_casa
                        )
                    ) AS Saldo_de_Gols
                FROM partidas AS pt
                    JOIN equipes eq ON eq.equipe_id = pt.equipe_casa_id
                    OR eq.equipe_id = pt.equipe_fora_id
                GROUP BY eq.nome
                ORDER BY Vitorias DESC,
                    Saldo_de_Gols DESC,
                    eq.nome ASC;
              ```
        - *Jogadores com mais vitorias*
            - ``` sql
                SELECT jg.jogador_id as ID,
                    concat(jg.nome, ' ', jg.sobrenome) as Nome,
                    count(
                        IF(
                            pt.equipe_casa_id = jg.equipe_id,
                            IF(pt.gols_casa > pt.gols_fora, 1, NULL),
                            IF(pt.gols_fora > pt.gols_casa, 1, NULL)
                        )
                    ) AS Vitorias
                FROM jogadores AS jg
                    JOIN partidas AS pt ON pt.equipe_casa_id = jg.equipe_id
                    OR pt.equipe_fora_id = jg.equipe_id
                GROUP BY ID
                ORDER BY Vitorias DESC,
                    Nome ASC;
              ```
    - Instalando a extensão <a ref="https://github.com/FriendsOfCake/cakephp-csvview/tree/3.x">CsvView</a>
    - Criando o ExportsController
        - Criando uma função para cada relatório
            - Exemplo do relatório 1:
                - ``` php
                    public function report1() 
                    {
                        $this->response->download('report1.csv');

                        $connection = ConnectionManager::get('default');

                        $data = $connection->execute(
                            "SELECT eq.nome AS Equipe_da_Casa,
                                eq2.nome AS Equipe_de_Fora,
                                pt.gols_casa AS Gols_Casa,
                                pt.gols_fora AS Gols_Fora,
                                pt.data_partida
                            FROM partidas AS pt
                                JOIN equipes eq ON eq.equipe_id = pt.equipe_casa_id
                                JOIN equipes eq2 ON eq2.equipe_id = pt.equipe_fora_id
                            ORDER BY pt.data_partida DESC"
                        )->fetchAll('assoc');

                        $_serialize = 'data';
                        $_header = ['Equipe_da_Casa', 'Equipe_de_Fora', 'Gols_Casa', 'Gols_Fora', 'Data_da_Partida'];

                        $this->set('_csvEncoding', 'UTF-16');
                        $this->set(compact('data', '_serialize', '_header'));

                        $this->viewBuilder()->className('CsvView.Csv');
                    }
                  ``` 
    - Atualizando a Home Page:
        - ``` ctp 
            <div class="columns larger-4 text-center">
                <h4> Relatórios </h4>
                <li> <?= $this->Html->link(__('Todos os Jogos'), ['controller' => 'Exports', 'action' => 'report1']) ?> </li>
                <li> <?= $this->Html->link(__('Times com mais vitorias'), ['controller' => 'Exports', 'action' => 'report2']) ?>  </li>
                <li> <?= $this->Html->link(__('Jogadores com mais vitorias'), ['controller' => 'Exports', 'action' => 'report3']) ?>  </li>
                <br><br>
            </div>
          ```





