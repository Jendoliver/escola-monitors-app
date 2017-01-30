CREATE DATABASE IF NOT EXISTS edm;
USE edm;

CREATE TABLE IF NOT EXISTS Admin(
username varchar(10) PRIMARY KEY,
password varchar(10) NOT NULL
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Curso(
id_curso int PRIMARY KEY,
tipo_curso tinyint NOT NULL, -- 0=Monitor, 1=Director, 2=Premonitor, 3=Otros
modalidad tinyint NOT NULL, -- 0=mati, 1=tarda, 2=finde, 3=intensiu
fecha_ini date NOT NULL,
fecha_fin date NOT NULL,
lugar varchar(50), -- lloc on es fa el curs
precio int NOT NULL-- precio del curso
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Alumno(
dni char(9) PRIMARY KEY,
nombre varchar(30) NOT NULL,
ape1 varchar(30) NOT NULL,
ape2 varchar(30),
fecha_nacimiento date,
direccion varchar(100),
telefono varchar(15),
email varchar(100),
calificacion_teoria tinyint DEFAULT 0, -- 0: Sin calificar, 1: Pendiente, 2: Aprobado, 3: No aprobado
calificacion_practicas tinyint DEFAULT 0, -- 0: Sin calificar, 1: Pendiente, 2: Aprobado, 3: No aprobado
dinero_debido int DEFAULT 0, -- La pasta que debe un alumno
fecha_memoria date DEFAULT '0000-00-00', -- La fecha de convocatoria en la que un alumno entrega la memoria
memoria bool DEFAULT 0, -- 0=No entregada, 1=Entregada
aprobado tinyint DEFAULT 0, -- 0=Pendiente, 1=No apto, 2=Apto
num_titulo int DEFAULT 0 -- El numero de titulo una vez aprobado
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Inscrito(
dni char(9),
id_curso int,
CONSTRAINT pk_inscrito PRIMARY KEY(`dni`,`id_curso`),
CONSTRAINT fk_inscrito_curso FOREIGN KEY(`id_curso`) REFERENCES Curso(`id_curso`),
CONSTRAINT fk_inscrito_alumno FOREIGN KEY(`dni`) REFERENCES Alumno(`dni`)
) DEFAULT CHARSET=utf8;