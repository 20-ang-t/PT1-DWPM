# Sistema de Gestión de Empleados

[![6b532dd2-9f11-4b0e-8685-fa319c65ce4b.png](https://i.postimg.cc/QCWyX59M/6b532dd2-9f11-4b0e-8685-fa319c65ce4b.png)](https://postimg.cc/H8d2zrtG)


El nombre del repositorio es PT1-DWPM, el cual corresponde al siguiente acrónimo:

* **P → Prueba**
* **T1 → Técnica 1**
* **D → Desarrollo**
* **W → WEB**
* **P → PHP**
* **M → MySQL**

En conjunto, PT1-DWPM significa:
“Prueba Técnica 1: Desarrollo Web con PHP y MySQL”.

## 📝 Descripción

Aplicación CRUD básica para la gestión de empleados desarrollada con PHP nativo (sin frameworks) y MySQL, que permite crear, listar, editar y eliminar empleados. Cada empleado registrado contiene: nombre completo, cargo, correo electrónico y fecha de ingreso.

## 🌟 Características Principales

* **CRUD completo** de empleados
* **Validación de campos** obligatorios
* **Ordenación automática** por fecha de ingreso (descendente)
* **Interfaz intuitiva** con diseño responsive
* **Seguridad básica** contra inyecciones SQL

## 🛠️ Stack Tecnológico

| **Componente**  | **Tecnología**                                 |
|-----------------|------------------------------------------------|
| Frontend        | HTML, CSS (sin frameworks)                   |
| Backend         | PHP 7.4+ (Orientado a Objetos, sin frameworks) |
| Base de datos   | MySQL 5.7+                                     |
| Conexión BD     | PDO                                            |
| Seguridad       | Prepared Statements, htmlspecialchars          |

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
* Servidor web (Apache, Nginx) con PHP 7.4+ y MySQL 5.7+
* Puerto típico: 80 (HTTP) o 443 (HTTPS)
* Extensiones PHP requeridas:
  - PDO MySQL
  - mbstring (para manejo de cadenas)

### Pasos:

1. **Clona el repositorio**:
    ```bash
    git clone https://github.com/20-ang-t/PT1-DWPM
    ```

2. **Importar base de datos**:
   ```bash
   mysql -u usuario -p gestion_empleados < gestion_empleados.sql
   ```

3. **Configurar conexión** (editar `includes/config.php`):
   ```php
   define('DB_HOST', 'localhost');      // Normalmente 'localhost' o '127.0.0.1'
   define('DB_USER', 'tu_usuario');     // Usuario con permisos para la BD
   define('DB_PASS', 'tu_contraseña');  // Contraseña del usuario
   define('DB_NAME', 'gestion_empleados'); // Nombre de la base de datos
   ```

4. **Subir archivos** al directorio raíz de tu servidor web (normalmente htdocs, www o public_html).

5. **Ejecutar el proyecto**:
   - Inicia tu servidor web (Apache/Nginx)
   - Abre tu navegador en: `http://localhost/gestion-empleados/empleados.php`
   - Si usas un puerto diferente, ajusta la URL (ej: `http://localhost:8080/gestion-empleados/empleados.php`)

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
* **Nota importante**: Este proyecto es una demostración técnica. Para entornos de producción se recomienda:
  - Implementar autenticación de usuarios
  - Añadir CSRF protection
  - Configurar HTTPS

## 📌 Notas técnicas
* **Enfoque sin frameworks**: Desarrollado completamente con PHP nativo para cumplir con los requisitos
* **Compatibilidad**: Probado con PHP 7.4+ y MySQL 5.7+
* **Requisitos PHP**: 
  - PDO_MYSQL habilitado
  - mbstring para manejo correcto de caracteres

## 🤝 Contribuciones
Las mejoras son bienvenidas. Por favor, abre un issue antes de enviar pull requests.

## 📧 Contacto
Para soporte técnico, abre un issue en el repositorio del proyecto.

---

> **Nota para producción**: Este proyecto es una prueba técnica básica. Se deben implementar medidas adicionales de seguridad para usarse en entornos reales.
