CREATE DATABASE IF NOT EXISTS edm;
USE edm;

CREATE TABLE IF NOT EXISTS Admin(
username varchar(10) PRIMARY KEY,
password varchar(10)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Curso(
id_curso int PRIMARY KEY,
tipo_curso bool, -- 0=Monitor, 1=Director
modalidad varchar(10), -- mati, tarda, finde, intensiu
ano int, -- ano en el que se realiza el curso
precio int -- precio del curso
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Alumno(
dni char(9) PRIMARY KEY,
nombre varchar(30),
ape1 varchar(30),
ape2 varchar(30),
fecha_nacimiento date,
direccion varchar(100),
telefono char(9),
email varchar(100),
horas_recuperar int DEFAULT 0, -- Las horas que debe recuperar un alumno, se introducen manualmente
dinero_debido int DEFAULT 0, -- La pasta que debe un alumno
fecha_memoria date DEFAULT NULL, -- La fecha de convocatoria en la que un alumno entrega la memoria
memoria bool DEFAULT 0, -- 0=No entregada, 1=Entregada
aprobado bool DEFAULT 0-- 0=No aprobado, 1=Aprobado
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Inscrito(
dni char(9),
id_curso int,
CONSTRAINT pk_inscrito PRIMARY KEY(`dni`,`id_curso`),
CONSTRAINT fk_inscrito_curso FOREIGN KEY(`id_curso`) REFERENCES Curso(`id_curso`),
CONSTRAINT fk_inscrito_alumno FOREIGN KEY(`dni`) REFERENCES Alumno(`dni`)
) DEFAULT CHARSET=utf8;