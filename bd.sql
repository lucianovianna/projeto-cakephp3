/*
Para iniciar o servidor mysql:
sudo /etc/init.d/mysql start
*/


/*
DROP SCHEMA IF EXISTS partidas;
CREATE DATABASE partidas;
USE partidas;
*/

CREATE TABLE usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nome_de_usuario VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    created DATETIME,
    modified DATETIME
);


CREATE TABLE equipes (
    equipe_id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) UNIQUE NOT NULL,
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



-- RELATÓRIOS:
-- Todos os Jogos: Time casa, Time visitante, gols casa, gols visitante:
SELECT eq.nome AS Equipe_da_Casa,
    eq2.nome AS Equipe_de_Fora,
    pt.gols_casa AS Gols_Casa,
    pt.gols_fora AS Gols_Fora,
    pt.data_partida
FROM partidas AS pt
    JOIN equipes eq ON eq.equipe_id = pt.equipe_casa_id
    JOIN equipes eq2 ON eq2.equipe_id = pt.equipe_fora_id
ORDER BY pt.data_partida DESC;



-- Times com mais vitorias: Time, numero de gols, numero de vitorias;
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



-- Jogadores com mais vitorias: Jogador, numero de vitorias.
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



-- Consulta o num. de jogadores por equipe.
SELECT count(j.jogador_id) AS Num_de_Jogadores, e.nome FROM jogadores AS j
JOIN equipes AS e ON j.equipe_id = e.equipe_id
GROUP BY e.nome; 




-- INSERTS:


INSERT INTO usuarios(nome_de_usuario, email, senha, created, modified) 
VALUES ("Padrão", "usuario@teste.com", "password", NOW(), NOW());


INSERT INTO equipes(nome, data_fundacao, created, modified, usuario_id) 
VALUES 
    ("AAA111", "1999-10-10", NOW(), NOW(), 1),
    ("BBB222", "2003-10-10", NOW(), NOW(), 2),
    ("CCC333", "2010-10-10", NOW(), NOW(), 3),
    ("DDD444", "2020-10-10", NOW(), NOW(), 4),
    ("EEE555", "2019-10-10", NOW(), NOW(), 5),
    ("FFF666", "2018-10-10", NOW(), NOW(), 6),
    ("GGG777", "2017-10-10", NOW(), NOW(), 1),
    ("HHH888", "2016-10-10", NOW(), NOW(), 2),
    ("III999", "2002-10-10", NOW(), NOW(), 6),
    ("JJJ100", "2008-10-10", NOW(), NOW(), 4);



INSERT INTO jogadores(equipe_id, nome, sobrenome, idade, posicao, created, modified, usuario_id) 
VALUES 
    (1, "Fulano", "da Silva", "35", "Goleiro", NOW(), NOW(), 1),
    (2, "Ciclano", "Souza", "33", "Zagueiro", NOW(), NOW(), 1),
    (2, "João", "Vitor", "35", "Goleiro", NOW(), NOW(), 2),
    (5, "Luciano", "Costa", "35", "Zagueiro", NOW(), NOW(), 5),
    (3, "Ulisses", "Santos", "35", "Meio Campo", NOW(), NOW(), 3),
    (10, "Neymar", "Junior", "29", "Atacante", NOW(), NOW(), 5);


INSERT INTO partidas(equipe_casa_id, equipe_fora_id, data_partida, gols_casa, gols_fora, created, modified, usuario_id)
VALUES 
    (1, 2, NOW(), 2, 2, NOW(), NOW(), 1),
    (1, 3, NOW(), 2, 2, NOW(), NOW(), 1),
    (1, 4, NOW(), 2, 2, NOW(), NOW(), 1),
    (1, 5, NOW(), 2, 2, NOW(), NOW(), 1),
    (2, 5, NOW(), 2, 2, NOW(), NOW(), 1),
    (2, 4, NOW(), 2, 2, NOW(), NOW(), 1),
    (2, 3, NOW(), 2, 2, NOW(), NOW(), 1),
    (2, 1, NOW(), 2, 2, NOW(), NOW(), 1),
    (3, 6, NOW(), 2, 2, NOW(), NOW(), 1),
    (3, 7, NOW(), 2, 2, NOW(), NOW(), 1),
    (3, 8, NOW(), 2, 2, NOW(), NOW(), 1),
    (3, 9, NOW(), 2, 2, NOW(), NOW(), 1),
    (3, 10, NOW(), 2, 2, NOW(), NOW(), 1),
    (10, 1, NOW(), 2, 2, NOW(), NOW(), 1); -- apenas empates

INSERT INTO partidas(equipe_casa_id, equipe_fora_id, data_partida, gols_casa, gols_fora, created, modified, usuario_id)
VALUES 
    (1, 2, NOW(), 3, 0, NOW(), NOW(), 1), -- +1 vit. e +3 saldo eq. AAA111; -3 saldo eq. BBB222
    (1, 3, NOW(), 2, 2, NOW(), NOW(), 1),
    (1, 4, NOW(), 2, 2, NOW(), NOW(), 1),
    (1, 5, NOW(), 2, 2, NOW(), NOW(), 1),
    (2, 5, NOW(), 3, 0, NOW(), NOW(), 1), -- +1 vit. +3 saldo eq. BBB222; -3 saldo eq. EEE555
    (2, 4, NOW(), 2, 2, NOW(), NOW(), 1),
    (2, 3, NOW(), 2, 2, NOW(), NOW(), 1),
    (2, 1, NOW(), 2, 2, NOW(), NOW(), 1),
    (3, 6, NOW(), 2, 2, NOW(), NOW(), 1),
    (3, 7, NOW(), 2, 2, NOW(), NOW(), 1),
    (3, 8, NOW(), 2, 2, NOW(), NOW(), 1),
    (3, 9, NOW(), 2, 2, NOW(), NOW(), 1),
    (3, 10, NOW(), 2, 2, NOW(), NOW(), 1),
    (10, 1, NOW(), 6, 0, NOW(), NOW(), 1);  -- +1 vit +6 saldo eq. JJJ100; -6 saldo eq AAA111

