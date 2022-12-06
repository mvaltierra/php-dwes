-- Active: 1670270332429@@127.0.0.1@3306
CREATE DATABASE taud3
    DEFAULT CHARACTER SET = 'utf8mb4';

USE taud3;

CREATE table Equipo (
    IdEquipo INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL ,
    Puntos INT NOT NULL
);

CREATE table Participante(
    IdParticipante INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255), 
    Provincia VARCHAR(255), 
    IdEquipo INT,
    Foreign Key (IdEquipo) REFERENCES Equipo (IdEquipo)
);
