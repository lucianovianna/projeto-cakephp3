/*
- bd relacional
    - usuarios
    - equipes
    - partidas
    - jogadores
*/

-- Se o mysql não tiver entrando
-- sudo /etc/init.d/mysql start

DROP SCHEMA IF EXISTS partidas;
CREATE DATABASE partidas;
USE partidas;


CREATE TABLE usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nome_de_usuario VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    created DATETIME,
    modified DATETIME
);


CREATE TABLE equipes (
    equipe_id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    data_fundacao DATE NOT NULL,
    created DATETIME,
    modified DATETIME,
    usuario_id INT,

    CONSTRAINT FK_usuario_id_Equipe FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id)
);


CREATE TABLE jogadores (
    jogador_id INT AUTO_INCREMENT PRIMARY KEY,
    equipe_id INT NOT NULL,
    nome VARCHAR(255) NOT NULL,
    sobrenome VARCHAR(255) NOT NULL,
    idade INT NOT NULL,
    posicao VARCHAR(255) NOT NULL,
    created DATETIME,
    modified DATETIME,
    usuario_id INT,

    CONSTRAINT FK_usuario_id_Jogador FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id),
    CONSTRAINT FK_equipe_id_Jogador FOREIGN KEY (equipe_id) REFERENCES equipes(equipe_id)
);


CREATE TABLE partidas (
    partida_id INT AUTO_INCREMENT PRIMARY KEY,
    equipe_casa_id INT NOT NULL,
    equipe_fora_id INT NOT NULL,
    data_partida DATETIME NOT NULL,
    gols_fora INT NOT NULL,
    gols_casa INT NOT NULL,
    created DATETIME,
    modified DATETIME,
    usuario_id INT,
    
    CONSTRAINT FK_usuario_id_Partida FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id),
    CONSTRAINT FK_equipe_casa_Partida FOREIGN KEY (equipe_casa_id) REFERENCES equipes(equipe_id),
    CONSTRAINT FK_equipe_fora_Partida FOREIGN KEY (equipe_fora_id) REFERENCES equipes(equipe_id)
);



INSERT INTO usuarios(nome_de_usuario, email, senha, created, modified) 
VALUES ("Padrão", "usuario@teste.com", "password", NOW(), NOW());



INSERT INTO equipes(nome, data_fundacao, created, modified, usuario_id) 
VALUES ("Goiás", "1980-10-10", NOW(), NOW(), 1),
    ("Vila Nova", "1981-10-10", NOW(), NOW(), 1);



INSERT INTO jogadores(equipe_id, nome, sobrenome, idade, posicao, created, modified, usuario_id) 
VALUES (1, "Fulano", "da Silva", "35", "Goleiro", NOW(), NOW(), 1),
    (2, "Ciclano", "Souza", "33", "Zagueiro", NOW(), NOW(), 1);



INSERT INTO partidas(equipe_casa_id, equipe_fora_id, data_partida, gols_casa, gols_fora, created, modified, usuario_id)
VALUES (2, 1, NOW(), 2, 2, NOW(), NOW(), 1);


/*
SELECT
   Jogadores.jogador_id AS `Jogadores__jogador_id`,
   Jogadores.equipe_id AS `Jogadores__equipe_id`,
   Jogadores.nome AS `Jogadores__nome`,
   Jogadores.sobrenome AS `Jogadores__sobrenome`,
   Jogadores.idade AS `Jogadores__idade`,
   Jogadores.posicao AS `Jogadores__posicao`,
   Jogadores.created AS `Jogadores__created`,
   Jogadores.modified AS `Jogadores__modified`,
   Jogadores.autor AS `Jogadores__autor`,
   Equipes.equipe_id AS `Equipes__equipe_id`,
   Equipes.nome AS `Equipes__nome`,
   Equipes.data_fundacao AS `Equipes__data_fundacao`,
   Equipes.created AS `Equipes__created`,
   Equipes.modified AS `Equipes__modified`,
   Equipes.autor AS `Equipes__autor`,
   Usuarios.usuario_id AS `Usuarios__usuario_id`,
   Usuarios.nome_de_usuario AS `Usuarios__nome_de_usuario`,
   Usuarios.email AS `Usuarios__email`,
   Usuarios.senha AS `Usuarios__senha`,
   Usuarios.created AS `Usuarios__created`,
   Usuarios.modified AS `Usuarios__modified` 
FROM
   jogadores Jogadores 
   INNER JOIN
      equipes Equipes 
      ON Equipes.equipe_id = 
      (
         Jogadores.equipe_id
      )
   INNER JOIN
      usuarios Usuarios 
      ON Usuarios.usuario_id = 
      (
         Jogadores.usuario_id
      )
      LIMIT 20 OFFSET 0


*/
/*
SELECT eq.nome AS Equipe_da_Casa, eq2.nome AS Equipe_de_Fora, pt.data_partida
FROM partidas pt 
JOIN equipes eq ON eq.equipe_id = pt.equipe_casa_id 
JOIN equipes eq2 ON eq2.equipe_id = pt.equipe_fora_id;
*/


