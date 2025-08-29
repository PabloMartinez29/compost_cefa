# Setup Inicial - Compost CEFA

## Requisitos Previos

- PHP 8.2 o superior
- Composer
- Node.js 18 o superior
- npm o yarn
- Laragon (recomendado para Windows)

## Instalación Paso a Paso

### 1. Clonar el Repositorio

```bash
git clone <url-del-repositorio>
cd compost_cefa
```

### 2. Instalar Dependencias de PHP

```bash
composer install
```

### 3. Configurar Variables de Entorno

```bash
cp .env.example .env
php artisan key:generate
```

Edita el archivo `.env` con tu configuración de base de datos.

### 4. Configurar Base de Datos

```bash
php artisan migrate
php artisan db:seed
```

### 5. Instalar Dependencias de Node.js

```bash
npm install
```

### 6. Compilar Assets de Vite

**Opción A: Comando manual**
```bash
npm run build
```

**Opción B: Script automatizado (Windows)**
```powershell
.\build-assets.ps1
```

**Opción C: Script automatizado (Linux/Mac)**
```bash
./build-assets.sh
```

### 7. Configurar Almacenamiento

```bash
php artisan storage:link
```

### 8. Ejecutar el Servidor

```bash
php artisan serve
```

O usar Laragon para iniciar el servidor.

## Verificación

1. Accede a `http://localhost:8000`
2. Deberías ver la página de bienvenida sin errores
3. Haz clic en "Iniciar Sesión" - no debería haber errores de Vite

## Solución de Problemas

### Error: ViteManifestNotFoundException

Si ves este error, significa que los assets de Vite no están compilados:

```bash
npm run build
```

### Error: Node.js no encontrado

Instala Node.js desde [nodejs.org](https://nodejs.org/)

### Error: npm no encontrado

Node.js incluye npm por defecto. Si no funciona, reinstala Node.js.

### Error: Permisos en Linux/Mac

```bash
chmod +x build-assets.sh
```

## Comandos Útiles

- `npm run dev` - Modo desarrollo con hot reload
- `npm run build` - Compilar para producción
- `npm run build:watch` - Compilar en modo watch
- `php artisan cache:clear` - Limpiar caché de Laravel
- `php artisan config:clear` - Limpiar caché de configuración

## Estructura de Assets

Los assets compilados se guardan en:
- `public/build/manifest.json` - Mapa de assets
- `public/build/assets/` - Archivos CSS y JS optimizados

## Notas Importantes

- Siempre ejecuta `npm run build` después de cambios en assets
- El directorio `public/build/` se regenera automáticamente
- Para desarrollo, usa `npm run dev` para hot reload
- Los assets se optimizan automáticamente (minificación, hashing)
