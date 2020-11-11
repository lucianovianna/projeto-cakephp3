/*
- bd relacional
    - equipes (times da conflito de nome)
    - partidas
    - jogadores
*/

-- Se o mysql não tiver entrando
-- sudo /etc/init.d/mysql start

DROP SCHEMA IF EXISTS partidas;
CREATE DATABASE partidas;
USE partidas;


CREATE TABLE usuarios {
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    created DATETIME,
    modified DATETIME
}


CREATE TABLE equipes (
    equipe_id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    data_fundacao DATE NOT NULL,
    created DATETIME,
    modified DATETIME,
    autor INT NOT NULL,
    
    FOREIGN KEY autor(autor) REFERENCES usuarios(usuario_id)
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
    autor INT NOT NULL,

    FOREIGN KEY autor(autor) REFERENCES usuarios(usuario_id),
    FOREIGN KEY equipe_id(equipe_id) REFERENCES equipes(equipe_id)
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
    autor INT NOT NULL,
    
    FOREIGN KEY autor(autor) REFERENCES usuarios(usuario_id),
    FOREIGN KEY equipe_casa_id(equipe_casa_id) REFERENCES equipes(equipe_id),
    FOREIGN KEY equipe_fora_id(equipe_fora_id) REFERENCES equipes(equipe_id)
);

INSERT INTO usuarios(nome, email, senha, created, modified) 
VALUES ("Padrão", "user@teste.com", "password", NOW(), NOW());

INSERT INTO equipes(nome, data_fundacao, created, modified) 
VALUES ("Goiás", "1980-10-10", NOW(), NOW()),
    ("Vila Nova", "1981-10-10", NOW(), NOW());



INSERT INTO jogadores(equipe_id, nome, sobrenome, idade, posicao, created, modified) 
VALUES (1, "Fulano", "da Silva", "35", "Goleiro", NOW(), NOW()),
    (2, "Ciclano", "Costa", "33", "Goleiro", NOW(), NOW());



INSERT INTO partidas(equipe_casa_id, equipe_fora_id, data_partida, created, modified)
VALUES (2, 1, NOW(), NOW(), NOW());



/*
SELECT eq.nome AS Equipe_da_Casa, eq2.nome AS Equipe_de_Fora, pt.data_partida
FROM partidas pt 
JOIN equipes eq ON eq.equipe_id = pt.equipe_casa_id 
JOIN equipes eq2 ON eq2.equipe_id = pt.equipe_fora_id;
*/