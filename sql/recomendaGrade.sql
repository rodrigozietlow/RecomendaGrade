CREATE DATABASE recomendagrade;

CREATE TABLE disciplina(
id INTEGER AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL, #não pode duplicar
periodo INTEGER NOT NULL,
creditos VARCHAR(25) NOT NULL,
cargaHoraria REAL NOT NULL,
idCurso INTEGER NOT NULL,
idRequisito INTEGER,
dataCadastro DATE NOT NULL,
FOREIGN KEY (idCurso) REFERENCES curso(id));

INSERT INTO disciplina(nome,periodo,creditos,cargaHoraria,idCurso,idRequisito,dataCadastro)
	VALUES ('Matematica',1, 4,60,1,1,'2018-08-22');