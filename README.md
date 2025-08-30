# 🌱 Sistema de Compostaje CEFA

Sistema web para la gestión del proceso de compostaje en el CEFA, desarrollado con Laravel y Tailwind CSS.

## 📋 Requisitos Previos

- **PHP** 8.2 o superior
- **Composer** (gestor de dependencias de PHP)
- **Node.js** 18 o superior
- **npm** (incluido con Node.js)
- **MySQL** o **MariaDB**
- **Git**

## 🚀 Instalación Paso a Paso

### 1. Clonar el Repositorio

```Terminal
git clone <URL_DEL_REPOSITORIO>
cd compost_cefa
```

### 2. Instalar Dependencias de PHP

```Terminal
composer install
```

### 3. Configurar Variables de Entorno

```Terminal
# Copiar el archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate
```

### 4. Configurar Base de Datos

Edita el archivo `.env` con tu configuración de base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=compost_cefa
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 5. Crear la Base de Datos

Crea una base de datos MySQL llamada `compost` (o el nombre que prefieras).

### 6. Ejecutar Migraciones

```terminal
php artisan migrate
```

### 7. Ejecutar Seeders (Datos Iniciales)

```Terminal
php artisan db:seed
```

### 8. Instalar Dependencias de Node.js

```Terminal
npm install
```

### 9. Compilar Assets de Vite

```Terminal
npm run build
```

### 10. Configurar Almacenamiento

```Terminal
php artisan storage:link
```

### 11. Configurar Permisos (Solo Linux/Mac)

```Terminal
chmod -R 775 storage bootstrap/cache
```

## 👤 Crear Usuario Administrador

### Opción 1: Usando Tinker

```Terminal
php artisan tinker
```

En Tinker, ejecuta:

$user = new App\Models\User(); 
$user->name = "Administrador"; 
$user->email = "admin@test.com"; 
$user->password = bcrypt("123456"); 
$user->role = "admin"; 
$user->save(); 


## 🏃‍♂️ Ejecutar el Proyecto

### Opción 1: Servidor de Desarrollo de Laravel

```Terminal
php artisan serve
```

Accede a: `http://localhost:8000`

### Opción 2: Usando Laragon (Recomendado para Windows)

1. Coloca el proyecto en la carpeta `www` de Laragon
2. Inicia Laragon
3. Accede a: `http://compost_cefa.test`

## 🔐 Credenciales de Acceso

### Administrador
- **Email:** admin@cefa.com
- **Contraseña:** password123

### Aprendiz (crear manualmente)
- **Email:** aprendiz@cefa.com
- **Contraseña:** password123

## 📁 Estructura del Proyecto

```
compost_cefa/
├── app/                    # Lógica de la aplicación
├── config/                 # Archivos de configuración
├── database/               # Migraciones y seeders
├── public/                 # Archivos públicos
├── resources/              # Vistas, CSS, JS
│   ├── css/               # Archivos CSS
│   ├── js/                # Archivos JavaScript
│   └── views/             # Vistas Blade
├── routes/                 # Definición de rutas
└── storage/                # Archivos de almacenamiento
```

## 🎨 Características del Sistema

### Dashboard de Administrador
- Gestión de pasantes
- Control de pilas de compostaje
- Gestión de maquinaria
- Reportes y estadísticas
- Control de residuos orgánicos

### Dashboard de Aprendiz
- Visualización de tareas asignadas
- Registro de horas de práctica
- Seguimiento de progreso
- Gestión de pilas asignadas

## 🛠️ Comandos Útiles

### Desarrollo
```Terminal
npm run dev          # Modo desarrollo con hot reload
npm run build        # Compilar assets para producción
php artisan serve    # Iniciar servidor de desarrollo
```

### Base de Datos
```Terminal
php artisan migrate              # Ejecutar migraciones
php artisan migrate:rollback     # Revertir última migración
php artisan migrate:fresh        # Recrear base de datos
php artisan db:seed              # Ejecutar seeders
```

### Caché
```Terminal
php artisan cache:clear          # Limpiar caché
php artisan config:clear         # Limpiar caché de configuración
php artisan view:clear           # Limpiar caché de vistas
```

### Tinker
```Terminal
php artisan tinker               # Abrir consola interactiva
```

## 🐛 Solución de Problemas

### Error: ViteManifestNotFoundException
```Terminal
npm run build
```

### Error: Permisos en Linux/Mac
```Terminal
chmod -R 775 storage bootstrap/cache
```

### Error: Base de Datos
```Terminal
php artisan migrate:fresh --seed
```

### Error: Composer
```Terminal
composer dump-autoload
```

## 📝 Notas Importantes

- **Zona Horaria:** El sistema está configurado para Colombia (America/Bogota)
- **Assets:** Siempre ejecuta `npm run build` después de cambios en CSS/JS
- **Base de Datos:** Asegúrate de tener MySQL/MariaDB instalado y funcionando
- **Puertos:** El servidor por defecto usa el puerto 8000

## 🤝 Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📞 Soporte

Si tienes problemas durante la instalación:

1. Verifica que todos los requisitos estén instalados
2. Revisa los logs de error
3. Asegúrate de que la base de datos esté configurada correctamente
4. Ejecuta `composer install` y `npm install` nuevamente

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

---

**Desarrollado para el CEFA** 🌱
