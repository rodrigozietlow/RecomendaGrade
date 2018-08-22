CREATE DATABASE recomendagrade;
USE recomendagrade;

CREATE TABLE curso(
id INTEGER AUTO_INCREMENT PRIMARY KEY,
nomeCurso VARCHAR(100) NOT NULL,
nomePeriodos VARCHAR(100), #semestre or anual
qtPeriodos INTEGER,
cargaMinima REAL, #horas
extras VARCHAR(50), #criar tabela extras
nomeCoordenador VARCHAR(50),
publico BOOLEAN, #true or false
dataCadastro DATE NOT NULL);

INSERT INTO curso(nomeCurso,nomePeriodos,qtPeriodos,cargaMinima,extras,nomeCoordenador,publico,dataCadastro)
	VALUES ('ADS','semestre', 7,'1000', 'Horas Complementares','Coordenador',false,'2018-08-22');

#DROP DATABASE recomendagrade;