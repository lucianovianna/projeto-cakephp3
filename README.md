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
- Atualizando os Validators das Partidas e dos Usuarios (para não ter equipes com o mesmo 'nome' nem usuarios com o mesmo 'nome_de_usuario' ou 'email'):
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
    - Todos os Jogos: Time casa, Time visitante, gols casa, gols visitante;
    - Times com mais vitorias: Time, numero de gols, numero de vitorias;
    - Jogadores com mais vitorias: Jogador, numero de vitorias.






