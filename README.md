# Manual de Usuario – Sistema de Turnero

## 1. Introducción

El Sistema de Turnero es una aplicación web desarrollada en Laravel que permite administrar ciudadanos, trámites, usuarios y turnos de atención.

El sistema está diseñado para que el administrador pueda registrar información, consultar datos y controlar el estado de atención de los turnos.

---

# 2. Acceso al sistema

## Credenciales de acceso

- Usuario: `administrador@dominio.com`
- Contraseña: `12345678`

## Pasos para iniciar sesión

1. Abrir el navegador web.
2. Ingresar a la dirección del sistema.
3. Escribir el correo electrónico.
4. Escribir la contraseña.
5. Presionar el botón **Iniciar sesión**.

Si las credenciales son correctas, el sistema mostrará el panel principal.

---

# 3. Panel principal

Después de iniciar sesión, el sistema permite acceder a los distintos módulos:

- Ciudadanos
- Turnos
- Trámites
- Usuarios
- Perfil

Desde este panel el administrador puede gestionar toda la información del sistema.

---

# 4. Módulo de Ciudadanos

Este módulo permite registrar, consultar, editar y eliminar ciudadanos.

## 4.1 Registrar ciudadano

### Pasos:

1. Entrar al menú **Ciudadanos**.
2. Seleccionar **Registrar ciudadano**.
3. Capturar:
   - Nombre
   - Apellido
   - Clave de identificación
4. Presionar **Guardar**.

### Validaciones

- Todos los campos son obligatorios.
- La clave de identificación no puede repetirse.

Cuando el registro es correcto, el sistema muestra un mensaje de confirmación.

---

## 4.2 Consultar ciudadanos

### Pasos:

1. Entrar al módulo **Ciudadanos**.
2. El sistema mostrará la lista de ciudadanos registrados.

La información visible incluye:

- Nombre
- Apellido
- Clave de identificación

---

## 4.3 Buscar ciudadano

### Pasos:

1. Entrar a **Buscar ciudadano**.
2. Escribir la clave de identificación.
3. Presionar **Buscar**.

Si el ciudadano existe, el sistema mostrará sus datos.

Si no existe, aparecerá un mensaje indicando que no fue encontrado.

---

## 4.4 Editar ciudadano

### Pasos:

1. Seleccionar el ciudadano.
2. Presionar **Editar**.
3. Modificar los datos necesarios.
4. Presionar **Actualizar**.

El sistema guardará automáticamente los cambios.

---

## 4.5 Eliminar ciudadano

### Pasos:

1. Entrar al apartado **Eliminar ciudadanos**.
2. Seleccionar el ciudadano.
3. Presionar **Eliminar**.
4. Confirmar la acción.

El ciudadano será eliminado del sistema.

---

# 5. Módulo de Turnos

Este módulo permite generar y administrar turnos de atención.

## 5.1 Crear turno

### Pasos:

1. Entrar al módulo **Turnos**.
2. Seleccionar **Crear turno**.
3. Capturar la información:
   - Número de turno
   - Fecha
   - Trámite
   - Descripción
   - Ciudadano
4. Presionar **Guardar**.

### Características

- El número de turno se genera automáticamente.
- El estado inicial del turno es **En espera**.

---

## 5.2 Consultar turnos

### Pasos:

1. Entrar al módulo **Turnos**.
2. El sistema mostrará todos los turnos registrados.

La lista incluye:

- Número de turno
- Fecha
- Estado
- Ciudadano asociado

---

## 5.3 Filtrar turnos

El sistema permite realizar filtros por:

- Fecha
- Estado

### Estados disponibles

- En espera
- Ya atendido

---

## 5.4 Cambiar estado del turno

### Pasos:

1. Buscar el turno.
2. Presionar el botón de cambio de estado.

El sistema cambiará automáticamente entre:

- En espera
- Ya atendido

---

## 5.5 Editar turno

### Pasos:

1. Seleccionar el turno.
2. Presionar **Editar**.
3. Modificar los datos.
4. Guardar cambios.

---

## 5.6 Eliminar turno

### Pasos:

1. Seleccionar el turno.
2. Presionar **Eliminar**.
3. Confirmar la acción.

El turno será eliminado del sistema.

---

# 6. Módulo de Trámites

Este módulo permite administrar los trámites disponibles.

## Funciones disponibles

- Registrar trámites
- Buscar trámites
- Editar trámites
- Eliminar trámites
- Consultar trámites

Los trámites activos pueden utilizarse al crear turnos.

---

# 7. Módulo de Usuarios

Este módulo permite administrar usuarios del sistema.

## Funciones disponibles

- Registrar usuarios
- Consultar usuarios
- Buscar usuarios
- Editar usuarios
- Eliminar usuarios

---

# 8. Perfil de usuario

El sistema permite que el usuario administrador pueda:

- Editar su información
- Actualizar contraseña
- Eliminar cuenta

---

# 9. Mensajes del sistema

El sistema muestra mensajes automáticos para informar:

- Registro exitoso
- Actualización correcta
- Eliminación realizada
- Errores de validación
- Información no encontrada

---

# 10. Recomendaciones de uso

- Mantener seguras las credenciales de acceso.
- Verificar la información antes de guardar.
- No duplicar claves de identificación.
- Cerrar sesión al finalizar el uso del sistema.

---

# 11. Cierre de sesión

Para salir del sistema:

1. Presionar el menú del usuario.
2. Seleccionar **Cerrar sesión**.

Esto finalizará la sesión actual del administrador.

---

# 12. Tecnologías utilizadas

El sistema fue desarrollado con:

- Laravel
- PHP
- MySQL
- Blade
- HTML
- CSS
- JavaScript

---

# 13. Conclusión

El Sistema de Turnero permite llevar un control organizado de ciudadanos, trámites y turnos de atención, facilitando el trabajo administrativo y mejorando la gestión de los procesos dentro de la institución.
