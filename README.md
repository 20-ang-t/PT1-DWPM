## Sistema de Gestión de Empleados

## 📝 Descripción

Aplicación CRUD básica para la gestión de empleados desarrollada con PHP y MySQL, que permite crear, listar, editar y eliminar empleados. Cada empleado registrado contiene: nombre completo, cargo, correo electrónico y fecha de ingreso.



## 🌟 Características Principales

* **CRUD completo** de empleados
* **Validación de campos** obligatorios
* **Ordenación automática** por fecha de ingreso (descendente)
* **Interfaz intuitiva** con diseño responsive
* **Seguridad básica** contra inyecciones SQL


 **Clona el repositorio**:

    ```bash
    git clone https:https://github.com/20-ang-t/-Proyecto-Energ-as-Renovables
   
    ```


## 🛠️ Stack Tecnológico

| **Componente**  | **Tecnología**                        |
|-----------------|---------------------------------------|
| Frontend        | HTML, CSS                             |
| Backend         | PHP (Orientado a Objetos)             |
| Base de datos   | MySQL                                 |
| Conexión BD     | PDO                                   |
| Seguridad       | Prepared Statements, htmlspecialchars |

## 📂 Estructura del Proyecto

```
gestion-empleados/
│
├── includes/
│   ├── config.php         # Configuración de la base de datos
│   ├── funciones.php      # Funciones auxiliares
│   └── header.php         # Cabecera común
│
├── assets/
│   └── css/
│       └── styles.css     # Estilos CSS
│
├── empleados.php          # Página principal (listado y creación)
├── editar-empleado.php    # Página de edición
├── gestion_empleados.sql  # Script SQL de la base de datos
└── README.md              # Este archivo
```

## ⚙️ Instalación

### Requisitos
* Servidor web (Apache, Nginx)
* PHP 7.4+
* MySQL 5.7+

### Pasos:
1. **Importar base de datos**:
   ```bash
   mysql -u usuario -p gestion_empleados < gestion_empleados.sql
   ```

2. **Configurar conexión** (editar `includes/config.php`):
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'tu_usuario');
   define('DB_PASS', 'tu_contraseña'); 
   define('DB_NAME', 'gestion_empleados');
   ```

3. **Subir archivos** al directorio raíz de tu servidor web.

## 🖥️ Uso

1. Accede a `empleados.php` en tu navegador
2. **Para crear empleados**:
   - Completa el formulario superior
   - Campos obligatorios: nombre, cargo, email y fecha
3. **Para editar/eliminar**:
   - Usa los botones en la columna "Acciones"

## 🔐 Seguridad
* **Protección SQL**: Uso de PDO con prepared statements
* **Validación**: En servidor y cliente
* **Sanitización**: htmlspecialchars en toda salida

## 📌 Notas
* Los empleados se ordenan automáticamente por fecha de ingreso (más recientes primero)
* El email y nombre completo deben ser únicos en el sistema

## 🤝 Contribuciones
Las mejoras son bienvenidas. Por favor, abre un issue antes de enviar pull requests.

## 📧 Contacto
Para soporte técnico, abre un issue en el repositorio del proyecto.

---

> **Nota**: Proyecto desarrollado como prueba técnica. Se recomienda añadir más medidas de seguridad para entornos de producción.
