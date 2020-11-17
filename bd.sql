/*
- bd relacional
    - usuarios
    - equipes
    - partidas
    - jogadores


Se o mysql não tiver entrando:
sudo /etc/init.d/mysql start
*/


DROP SCHEMA IF EXISTS partidas;
CREATE DATABASE partidas;
USE partidas;


CREATE TABLE usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nome_de_usuario VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    created DATETIME,
    modified DATETIME
);
-- ALTER TABLE usuarios MODIFY nome_de_usuario VARCHAR(255) UNIQUE NOT NULL;
-- ALTER TABLE usuarios MODIFY email VARCHAR(255) UNIQUE NOT NULL;

CREATE TABLE equipes (
    equipe_id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) UNIQUE NOT NULL,
    data_fundacao DATE NOT NULL,
    created DATETIME,
    modified DATETIME,
    usuario_id INT,

    CONSTRAINT FK_usuario_id_Equipe FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id)
);
-- ALTER TABLE equipes MODIFY nome VARCHAR(255) UNIQUE NOT NULL; 

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


/*
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
*/


-- RELATÓRIOS:
-- Todos os Jogos: Time casa, Time visitante, gols casa, gols visitante:
SELECT eq.nome AS Equipe_da_Casa, eq2.nome AS Equipe_de_Fora, pt.gols_casa AS Gols_Casa, pt.gols_fora AS Gols_Fora, pt.data_partida
FROM partidas pt 
JOIN equipes eq ON eq.equipe_id = pt.equipe_casa_id 
JOIN equipes eq2 ON eq2.equipe_id = pt.equipe_fora_id
ORDER BY pt.data_partida DESC;


-- Times com mais vitorias: Time, numero de gols, numero de vitorias;
SELECT nome, count(CASE WHEN pt.gols_casa > pt.gols_fora OR pt2.gols_fora > pt2.gols_casa THEN 1 ELSE 0 END) AS Vitorias, SUM(pt.gols_casa AND pt2.gols_fora) AS Saldo_de_Gols 
FROM equipes AS eq
JOIN partidas pt ON eq.equipe_id = pt.equipe_casa_id   -- quando o time é o de casa
JOIN partidas pt2 ON eq.equipe_id = pt2.equipe_fora_id -- quando o time é o de fora
GROUP BY eq.nome
ORDER BY Vitorias DESC;
-- NECESSITA DE CORREÇÃO



-- Jogadores com mais vitorias: Jogador, numero de vitorias.




 -- Consulta o num. de jogadores por equipe.
SELECT count(j.jogador_id) AS Num_de_Jogadores, e.nome FROM jogadores AS j
JOIN equipes AS e ON j.equipe_id = e.equipe_id
GROUP BY e.nome; 



