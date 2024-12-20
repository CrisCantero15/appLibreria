# 📚 Librería - **LibroSphere**  
Proyecto web diseñado como una librería para la compra de libros, que incluye un sistema de autenticación de usuarios y funcionalidades tanto para administradores como para usuarios habituales.

---

## 🌟 Descripción  

**LibroSphere** es un proyecto desarrollado para consolidar los conocimientos adquiridos durante mis estudios de **Desarrollo de Aplicaciones Web (DAW)**, con un enfoque en el desarrollo del lado servidor.  

### Características principales:  
1. **Sistema de autenticación de usuarios**:  
   - Utiliza una base de datos creada con **SQL** (⚠️ *La BBDD no se incluye en este repositorio*).  
   - Implementación desplegada mediante un servidor local de **Apache**.  
2. **Roles de usuario**:  
   - **Administrador**:  
     - Acceso a un panel de control con funcionalidades como:  
       - Visualización de pedidos realizados y usuarios registrados.  
       - Edición y eliminación de pedidos y usuarios.  
   - **Usuario habitual**:  
     - Acceso al catálogo de libros de LibroSphere.  
     - Posibilidad de realizar compras (registradas en la base de datos).  
3. **Registro de nuevos usuarios**:  
   - A través de un formulario en la opción *"Nuevo usuario"* de la vista `access.php`.

---

## 🌐 Web Services  

El proyecto incorpora dos tipos de servicios para ampliar su funcionalidad:  

1. **Servicio SOAP**  
2. **Servicio REST**  

Ambos servicios permiten que un proveedor externo pueda acceder al catálogo de **LibroSphere** y usarlo en su propia aplicación.  

En el repositorio se incluyen documentos en PDF que explican:  
- La funcionalidad de estos servicios.  
- Las acciones disponibles para los usuarios del servicio.  

---

## 🛠️ Tecnologías utilizadas  

- **SQL** - Base de datos para la gestión de usuarios y pedidos.  
- **PHP** - Desarrollo del lado servidor.  
- **Apache** - Servidor local para el despliegue de la aplicación.  
- **HTML/CSS** - Estructura y diseño del proyecto.  

---

## 🚀 Cómo empezar  

⚠️ *Nota: Este proyecto requiere configuración manual del servidor local y la base de datos SQL. La base de datos no está incluida.*  

### Pasos iniciales:  

1. Clona este repositorio:  
   ```bash
   git clone https://github.com/tu-usuario/librosphere.git
