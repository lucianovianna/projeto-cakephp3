-- Comandos no Mysql Workbench (usados no curso de mysql basico)
-- Obs.: os comandos não precisam estar necessariamente em maiúsculo


CREATE DATABASE bookstore;

USE bookstore;
--- dessa forma vai ser criada a tabela no database selecionado
create table books 
(
	id int unsigned NOT NULL auto_increment,
	title varchar(255) NOT NULL,
    author varchar(255) NOT NULL,
    price decimal(10,2) NOT NULL,
    PRIMARY KEY(id)
);

--- Confere as tabelas do database selecionado
SHOW tables;

--- Adiciona items na tabela
INSERT INTO books (title, author, price) 
--- como o id é auto_increment, não é necesário colocar ele;
VALUES ("1984", "George Orwel", 39.99),
	   ("Revolucao dos Bichos", "George Orwel", 29.99);

-- comandos de buscas:
SELECT * FROM books;
SELECT * FROM books WHERE price > 32.00;
SELECT title, price FROM books WHERE price > 32.00;
SELECT title, price FROM books WHERE price > 10.00 AND price < 30.00;
select * from books where title like "Rev%";

-- comandos de manipulação de tabela
ALTER TABLE books ADD year_publish decimal(4, 0) AFTER author;
ALTER TABLE books MODIFY title varchar(300) NOT NULL;

INSERT INTO books (title, author, year_publish, price) VALUES ("Myself", "Luciano Vianna", 1999, 1999.24);

ALTER TABLE books DROP year_publish;
ALTER TABLE books RENAME livros; --(Mudou o nome da tabela)
ALTER TABLE livros MODIFY id smallint unsigned NOT NULL auto_increment;

--- mostra os tipos de dados das colunas da tabela
EXPLAIN livros;

--- atualizar dado(s) de uma tabela
UPDATE livros SET title = "Livro de Exemplo", author = "Exemplo de Author" WHERE id = 3;
UPDATE livros SET price = 111.99 WHERE author = "George Orwell"; 
--- não funciona no safe update mode (teria que ser por ID)

--- deletar dado da tabela
DELETE FROM livros WHERE id = 3;

--- Deleta a tabela inteira
DROP TABLE livros;

SHOW TABLES;

-- Deleta o database
DROP DATABASE bookstore;

SHOW DATABASES;


---------------------------------------------------------
------------------------ PARTE 2 ------------------------
---------------------------------------------------------

-- FOREIGN KEY: chave que vincula duas tabelas;


DROP SCHEMA IF EXISTS bookstore;

show databases;


CREATE DATABASE bookstore;
use bookstore;

CREATE TABLE consumers
(
	consumer_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    gender CHAR(10) NOT NULL,
    age INT NOT NULL,
    date_cadastro TIMESTAMP NOT NULL DEFAULT NOW(),
    city VARCHAR(255) NOT NULL DEFAULT 'Blumenau',
    email VARCHAR(255) UNIQUE NOT NULL,
    PRIMARY KEY(consumer_id),
    CONSTRAINT Age_constraint CHECK(age >= 18)
);

ALTER TABLE consumers ALTER city DROP DEFAULT;

CREATE TABLE orders
(
	order_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    consumer_id INT UNSIGNED NOT NULL,
    order_date TIMESTAMP NOT NULL DEFAULT NOW(),
    order_value VARCHAR(255) NOT NULL,
    
    PRIMARY KEY(order_id),
    FOREIGN KEY(consumer_id) REFERENCES consumers(consumer_id)
);

CREATE TABLE book_category
(
	book_category_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    category_type VARCHAR(255) UNIQUE NOT NULL,
    book_description VARCHAR(255) NOT NULL,
    
    PRIMARY KEY(book_category_id)
);

CREATE TABLE authors
(
	author_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    gender CHAR(10) NOT NULL,
    date_of_birth DATE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    PRIMARY KEY(author_id)
);

CREATE TABLE books 
(
	book_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    book_category_id INT UNSIGNED NOT NULL,
	title VARCHAR(255) NOT NULL,
    date_publish DATE,
    date_acquisition DATE,
    book_comments VARCHAR(255),
    price DECIMAL(10,2) NOT NULL,
    author_id INT UNSIGNED NOT NULL,
    
    PRIMARY KEY(book_id),
    FOREIGN KEY(author_id) REFERENCES authors(author_id),
    FOREIGN KEY(book_category_id) REFERENCES book_category(book_category_id)
    
);

CREATE TABLE order_items
(
	item_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    order_id INT UNSIGNED NOT NULL,
    book_id INT UNSIGNED NOT NULL,
    item_price DECIMAL(10, 2) NOT NULL,
    item_comment VARCHAR(255) NOT NULL,
    
    PRIMARY KEY(item_id),
    FOREIGN KEY(order_id) REFERENCES orders(order_id),
    FOREIGN KEY(book_id) REFERENCES books(book_id)
);

/*
explain books;
explain authors;
explain consumers;
explain orders;
explain book_category;
explain order_items;

show tables;
*/

-- Inserindo valores nas tabelas
insert into consumers ( consumer_id, first_name, last_name, gender, age, city, email ) 
values ( 1, 'Jackson', 'Lima', 'Masculino', 26, 'Blumenau', 'jackson.lima91@outlook.com' ), 
( 2, 'Guilherme', 'Pompermayer', 'Masculino', 31, 'Bento Gonçalves', 'gui.pomper@outlook.com' ), 
( 3, 'Wesley', 'Williams', 'Masculino', 32, 'São Paulo', 'wesley@gmail.com' ); 

insert into orders (consumer_id, order_id, order_value) 
values ( 1, 1, 'Interesse em Viagem da Terra e outros livros' ), 
(2, 2, 'Interesse em Geração de Valor'), 
(3, 3, 'Interesse em A venda desafiadora'); 

insert into book_category (book_category_id, category_type, book_description) 
values ( 1, 'Ficção científica', 'Interesse em Viagem da Terra e outros livros' ), 
( 2, 'Motivacional', 'Interesse em Geração de Valor' ), 
(3, 'Vendas', 'Interesse em A venda desafiadora'); 

insert into authors ( author_id, first_name, Last_name, gender, date_of_birth, email ) 
values ( 1, 'Machado', 'De Assis', 'Masculino', '1945-11-20', 'machado@gmail.com' ), 
( 2, 'Steven', 'Spielbierg', 'Masculino', '1975-10-11', 'spielberg@gmail.com' ), 
( 3, 'Flavio', 'Augusto', 'Masculino', '1973-12-6', 'flavio@gmail.com' ); 

insert into books ( book_id, book_category_id, author_id, title, date_publish, date_acquisition, book_comments, price ) 
values ( 1, 1, 1, 'Viagem ao Centro da terra', '1990-8-15', '1998-10-15', 'Livro de Ficção científica', '10.50' ), 
( 2, 2, 2, 'Geração de valor', '1998-10-15', '1998-10-15', 'Livro de Ficção científica', '28.50' ), ( 3, 3, 3, 'A venda desafiador', '2002-10-15', '2002-10-15', 'Livro de Ficção científica', '19.50' ); 

insert into order_items ( item_id, order_id, book_id, item_price, item_comment ) 
values (1, 1, 1, '10.50', 'Livro para material escolar'), 
(2, 2, 2, '28.50', 'Livro motivacional'), 
(3, 3, 3, '10.50', 'Livro de negócios');


--# Buscas avançadas
SELECT DISTINCT first_name as Nome FROM authors; -- Seleciona os distintos; Funciona com apenas uma coluna.
SELECT COUNT(DISTINCT gender) FROM authors; -- Contagem dos distintos; Funciona com uma apenas uma coluna.
SELECT * FROM consumers ORDER BY city; -- Pode ordernar (por padrão é crescente)
SELECT * FROM consumers ORDER BY city, first_name DESC; -- Pode usar dois parametros para ordenação (DESC é decrescente)

-- INNER JOIN: Consulta registros em que o valor é correspondente entre duas tabelas
SELECT first_name, last_name, title, date_publish , category_type FROM books
INNER JOIN authors ON books.author_id = authors.author_id
INNER JOIN book_category ON books.book_category_id = book_category.book_category_id;
-- Na table books temos um author_id para cada livro e na table books temos um book_category_id para cada livro, logo podemos fazer essa consulta de INNER JOIN.

-- LEFT JOIN: Consulta registros da tabela a esquerda e os registro correspondentes da tabela a direita
-- porém se não houver correspondentes retornará nulo.
SELECT first_name, last_name, title, date_publish FROM books
LEFT JOIN authors ON books.author_id = authors.author_id;

-- RIGHT JOIN: contrario do que o left faz
SELECT first_name, last_name, title, date_publish FROM books
RIGHT JOIN authors ON books.author_id = authors.author_id;


---------------------------------------------------------
------------------------ PARTE 3 ------------------------
---------------------------------------------------------


-- UNION: misturará os dados das consultas unidas, ignorando dados repitidos
SELECT first_name FROM authors;
UNION /*ALL */ /*Usando o ALL o UNION retornará também os dados repitidos*/
SELECT title FROM books;

-- Consulta UNION avançada
SELECT first_name, last_name, title, date_publish FROM books
INNER JOIN authors ON books.author_id = authors.author_id
UNION
SELECT title, date_publish, category_type, book_description FROM books
INNER JOIN book_category ON books.book_category_id = book_category.book_category_id;


-- Exemplo de ORDER BY e GROUP BY
-- Adicionando coluna 'country' na tabela 'authors' e atualizando os valores
ALTER TABLE authors ADD country VARCHAR(255);
UPDATE authors SET country = "Brasil" WHERE author_id = 1;
UPDATE authors SET country = "EUA" WHERE author_id = 2;
UPDATE authors SET country = "Brasil" WHERE author_id = 3;

-- Essa consulta vai mostrar o numero de autores de um país especifico, ordenando de forma decrescente.
SELECT count(author_id), country FROM authors
GROUP BY country
ORDER BY count(author_id) DESC;

-- Essa consulta retorna o numero de autores por livro (titulo)
SELECT count(a.author_id), b.title FROM authors AS a
INNER JOIN books AS b ON a.author_id = b.author_id
GROUP BY b.title;

-------------------------------
--- Principais funções do MySQL

SELECT MIN(price) FROM books; -- retorna o valor min
SELECT MAX(price) FROM books; -- retorna o valor max
SELECT AVG(price) FROM books); -- retorna o avg
SELECT SUM(price) AS Valor_Total FROM books; -- retorna a soma

SELECT CHAR_LENGTH(title) as Num_De_Letras FROM books; -- Retorna o tamanho da string
SELECT INSTR("String", "g"); -- Indica a posição onde está do segundo elemento no primeiro (contando a partir de 1), se retornar 0 é porque não possui, se houver mais de um ele marca o 1°.

SELECT CONCAT("SQL ", "TREINAMENTO ", "TUTORIAL"); -- Concatenação de strings
SELECT CONCAT_WS(" ", "SQL", "TREINAMENTO", "TUTORIAL"); -- Concatenação de strings, porém o primeiro elemento é o delimitador

SELECT LCASE("MAIUSCULO") -- Transforma em minusculo
SELECT UCASE("minusculo") -- Transforma em maiusculo

SELECT LEFT("Exemplo de Left", 3); -- Extrai um substring de numero N a partir da esquerda
SELECT RIGHT("Exemplo de Rigth", 5); -- Extrai um substring de numero N a partir da direita

SELECT lpad("String Teste", 20, ". "); -- Caso a string do 1° parametro não tenha o tamanho minimo que é definido no 2° tamanho, a função aumenta ele pela ESQUERDA com o conteudo do 3° parametro.
SELECT rpad("String Teste", 20, " ."); -- O mesmo que o lpad(), porém pela DIREITA.

SELECT LTRIM("       Teste do LTRIM"); -- Remove os espaços à esquerda da String
SELECT RTRIM("Teste do RTRIM       "); -- Remove os espaços à direita da String
SELECT TRIM("     Teste do TRIM    "); -- Remove os espaços a esqueda e a direita da String, sem remover os do meio

SELECT MID("Rio de Janeiro", 5, 2); -- Retira do 1° parametro, a partir da posição indicada no 2° parametro, um trecho do tamanho indicado no 3° parametro [nesse caso retirará: "de"].
SELECT SUBSTRING("Rio de Janeiro", 8, 7); -- Basicamente a mesma coisa do MID(). [tbm pode ser SUBSTR]
SELECT REPEAT("*", 10); -- Repete uma String/Char N vezes
SELECT REPLACE("google.net", ".net", ".com.br"); -- Substitui uma substr por outra;
SELECT REVERSE("AEIOU"); -- Inverte a string [tbm funciona para int]


SELECT CURRENT_TIME(); -- HH:MM:SS
SELECT CURRENT_DATE(); -- ANO-MES-DIA
SELECT CURRENT_TIMESTAMP(); --  ANO-MES-DIA HH:MM:SS

SELECT ADDDATE("2020-11-09", INTERVAL 12 MONTH); -- Retorna uma data nesse formato com porém com um intervalo de X DAY/MONTH/YEAR [nesse exemplo retornará: 2021-11-09]. O interval pode ser 0.
SELECT ADDTIME("2020-11-09 12:00:00", "00:20:00"); -- Retorna a data e hora nesse formato e com o intervalo estipulado no 2° parametro [nesse ex. retonará: 2020-11-09 12:20:00]. Também funciona colocando apenas HH:MM:SS no 1° parametro. O 2° parametro pode ser '0'

SELECT DATEDIFF("2020-11-09", "1999-03-24"); -- Retorna, em dias, a diferença entre as datas
SELECT TIMEDIFF("10:00:00","09:00:00"); -- Retorna, no formato HH-MM-SS, a diferença entre os horários
SELECT DATE_FORMAT("1999-03-24", "%d-%m-%y"); -- Formata a data de diversas formas, nesse caso ficará: 24-03-99.
SELECT DATE_SUB("2020-11-09", INTERVAL 15 DAY); -- Subtrai a data do intervalo estipulado. [nesse caso retornará: 2020-10-25].

SELECT DAYNAME("2020-11-09"); -- Nomeia o dia [nesse caso retorna: Monday].
SELECT DAYOFMONTH("2020-11-09"); -- Retorna o dia do mes. 
SELECT DAYOFWEEK("2020-11-09"); -- Retorna o dia da semana (domingo = 1).
SELECT DAYOFYEAR("2020-11-09"); -- Retorna o dia do ano [nesse caso retorna: 314].

SELECT SEC_TO_TIME(3600); -- Converte segundos em TIME (HH:MM:SS).
SELECT TIME_TO_SEC("01:20:00"); -- Converte TIME em segundos.
SELECT STR_TO_DATE("August 10 2020", "%M %d %Y"); -- COnverte para o formato DATE (ANO-MES-DIA) de acordo com o formato passado no 2° parametro.


-- regexp
SELECT title FROM books WHERE title regexp '^[VG]'; -- Retorna os que começam com V ou com G
SELECT title FROM books WHERE title regexp '^[Ger]'; -- Retorna os que começam com "Ger"
SELECT title FROM books WHERE title regexp '^[V]|G'; -- Outra forma de retornar os que começam com V ou com G
SELECT title FROM books WHERE title regexp '^[^Ger]'; -- Retornar os que não começam com "Ger"
SELECT title FROM books WHERE title regexp '[ar]$'; -- Retornar os que terminam com 'a' ou 'r'; $ significa fim da string



-- Exemplo de concatenação:
-- Adicionando colunas street, bairro e cep para concatenar o endereço
ALTER TABLE consumers ADD rua VARCHAR(255), ADD bairro VARCHAR(255), ADD cep VARCHAR(255); 

UPDATE consumers SET rua = "Av A", bairro = "Jardim Alfa", cep = 71158963 WHERE consumer_id = 1;
UPDATE consumers SET rua = "Av B",  bairro = "Jardim Beta",  cep = 73515954 WHERE consumer_id = 2;
UPDATE consumers SET rua = "Av G",  bairro = "Jardim Gama",  cep = 71456982 WHERE consumer_id = 3;

SELECT first_name, CONCAT(rua, ", ", bairro, " - ", cep) AS Endereço FROM consumers
ORDER BY cep; 
SELECT first_name, CONCAT_WS(" - ", rua, bairro, cep) AS Endereço FROM consumers
ORDER BY cep;
-- Ambas concatenam o endereço e ordenam por CEP

SELECT count(author_id), country FROM authors
GROUP BY country
HAVING count(author_id) > 2; -- Contar o numero de autores por pais, mostrando os países que há mais que dois




