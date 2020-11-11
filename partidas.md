## PARTIDAS:

#### CRUD

- bd relacional
    - times (ou equipes)
    - partidas
    - jogadores

- relatorios


#### O que foi feito

- Criado o database com 3 tabelas:
    - usuarios
    - equipes
    - partidas
        - gols 
        - resultados
    - jogadores

- Executado:
    - Para criar a migration baseada no DATABASE criado;
        - bin/cake bake migration_snapshot EsquemaPartidas
    - Para a criação do esqueleto do MVC:
        - bin/cake bake all equipes
        - bin/cake bake all jogadores
        - bin/cake bake all partidas
    

    