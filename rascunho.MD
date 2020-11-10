Comandos Cake PHP

- composer create-project --prefer-dist cakephp/app {nome projeto} (comando utilizado para criar um projeto);

- bin/cake (listar todos comandos)

- bin/cake server (Iniciar conexão com servidor)

- bin/cake migrations create (Nome da migration) (Comando utilizado para criar um banco)
	-Exemplo: bin/cake migrations create CreateUsers

- bin/cake migrations migrate (Apos utilizar o comando acima executar o migrate)

- bin/cake bake all (Verificar todas as tabelas do banco do migrate)
	-Similar ao show tables do MYSQL;

- bin/cake bake migration CreatePages (Para criar um banco de dados com o nome createpages)
	- OBS: A diferença entre criar uma tabela com o bake e com o migrations é que no bake ele já traz a estrutura da tabela pre definida ex:
	    $table = $this->table('pages');
        $table->create();


-bin/cake bake model (nome da migration) (Comando utilizado para criar o model do MVC de uma migration)
	-Ex: bin/cake bake model pages