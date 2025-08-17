-- Script de creación de la base de datos y tabla empleados
-- Proyecto: Gestión de Empleados (CRUD con PHP y MySQL)
-- Autor: [Miguel Ángel García Torres]
-- Fecha: [16-08-2025]

-- Crear la base de datos 
CREATE DATABASE IF NOT EXISTS gestion_empleados;
-- Usar la base de datos
USE gestion_empleados;
-- Crear tabla empleados
CREATE TABLE empleados (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre_completo VARCHAR(100) NOT NULL,
  cargo VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  fecha_ingreso DATE NOT NULL,
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
