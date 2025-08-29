# Configuración de Vite en Compost CEFA

## Problema Resuelto: ViteManifestNotFoundException

El error `ViteManifestNotFoundException` ocurre cuando Laravel no puede encontrar el archivo `manifest.json` en `public/build/`. Esto sucede porque los assets de Vite no han sido compilados.

## Solución Permanente

### 1. Compilar Assets de Vite

Para compilar todos los assets de Vite, ejecuta:

```bash
npm run build
```

Este comando:
- Compila todos los archivos CSS y JS configurados en `vite.config.js`
- Genera el archivo `manifest.json` en `public/build/`
- Crea los archivos de assets optimizados en `public/build/assets/`

### 2. Scripts Disponibles

- `npm run build` - Compila los assets para producción
- `npm run dev` - Inicia el servidor de desarrollo de Vite
- `npm run build:watch` - Compila los assets en modo watch (para desarrollo)
- `npm run postinstall` - Se ejecuta automáticamente después de `npm install`

### 3. Archivos Configurados en Vite

Los siguientes archivos están configurados en `vite.config.js`:

**CSS:**
- `resources/css/app.css` - Tailwind CSS base
- `resources/css/auth.css` - Estilos para autenticación
- `resources/css/dashboard-admin.css` - Estilos del dashboard de administrador
- `resources/css/tailwind-compost.css` - Estilos personalizados de compost
- `resources/css/welcome.css` - Estilos de la página de bienvenida

**JavaScript:**
- `resources/js/app.js` - JavaScript principal con Alpine.js

### 4. Uso en Vistas Blade

Para usar los assets compilados en las vistas Blade:

```php
@vite(['resources/css/auth.css'])
@vite(['resources/js/app.js'])
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

### 5. Flujo de Trabajo Recomendado

**Para Desarrollo:**
1. Ejecuta `npm run dev` para iniciar el servidor de desarrollo
2. Los cambios se compilan automáticamente

**Para Producción:**
1. Ejecuta `npm run build` antes de desplegar
2. Asegúrate de que el directorio `public/build/` esté incluido en el despliegue

### 6. Verificación

Para verificar que todo funciona correctamente:

1. Ejecuta `npm run build`
2. Verifica que existe `public/build/manifest.json`
3. Verifica que existen los archivos en `public/build/assets/`
4. Accede a la aplicación y verifica que no hay errores de Vite

### 7. Troubleshooting

Si vuelves a ver el error `ViteManifestNotFoundException`:

1. Verifica que `public/build/manifest.json` existe
2. Si no existe, ejecuta `npm run build`
3. Verifica que todos los archivos CSS y JS referenciados en `vite.config.js` existen
4. Limpia la caché de Laravel: `php artisan cache:clear`

## Notas Importantes

- El directorio `public/build/` está en `.gitignore` porque se genera automáticamente
- Para producción, siempre ejecuta `npm run build` antes de desplegar
- Los assets se optimizan automáticamente (minificación, hashing, etc.)
