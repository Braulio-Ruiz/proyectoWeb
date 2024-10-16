-- Crear la base de datos
CREATE DATABASE MIPROYECTO;

-- Usar la base de datos
USE MIPROYECTO;

-- Crear la tabla de categorías
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

-- Crear la tabla de productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    precio INT NOT NULL,
    categoria_id INT,
    imagen VARCHAR(255),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);