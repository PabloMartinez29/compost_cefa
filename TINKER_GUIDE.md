# 🔧 Guía de Tinker - Sistema de Compostaje CEFA

## ¿Qué es Tinker?

Tinker es la consola interactiva de Laravel que te permite ejecutar código PHP directamente en tu aplicación.

## 🚀 Cómo Usar Tinker

### 1. Abrir Tinker

```bash
php artisan tinker
```

### 2. Crear Usuario Administrador

Una vez dentro de Tinker, copia y pega este código:

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Administrador',
    'email' => 'admin@cefa.com',
    'password' => Hash::make('password123'),
    'role' => 'admin'
]);
```

### 3. Crear Usuario Aprendiz

```php
User::create([
    'name' => 'Aprendiz',
    'email' => 'aprendiz@cefa.com',
    'password' => Hash::make('password123'),
    'role' => 'aprendiz'
]);
```

### 4. Verificar Usuarios Creados

```php
User::all();
```

### 5. Salir de Tinker

```php
exit
```

## 🔍 Comandos Útiles en Tinker

### Ver Todos los Usuarios
```php
User::all();
```

### Buscar Usuario por Email
```php
User::where('email', 'admin@cefa.com')->first();
```

### Contar Usuarios
```php
User::count();
```

### Ver Usuarios Administradores
```php
User::where('role', 'admin')->get();
```

### Ver Usuarios Aprendices
```php
User::where('role', 'aprendiz')->get();
```

### Eliminar Usuario
```php
User::where('email', 'email@ejemplo.com')->delete();
```

## 🛠️ Solución de Problemas

### Error: Class 'User' not found
```php
use App\Models\User;
```

### Error: Hash not found
```php
use Illuminate\Support\Facades\Hash;
```

### Error: Database connection
Asegúrate de que:
1. La base de datos esté creada
2. Las migraciones se hayan ejecutado
3. El archivo `.env` esté configurado correctamente

## 📝 Ejemplo Completo

```bash
# 1. Abrir Tinker
php artisan tinker

# 2. En Tinker, ejecutar:
use App\Models\User;
use Illuminate\Support\Facades\Hash;

# 3. Crear administrador
User::create([
    'name' => 'Administrador',
    'email' => 'admin@cefa.com',
    'password' => Hash::make('password123'),
    'role' => 'admin'
]);

# 4. Crear aprendiz
User::create([
    'name' => 'Aprendiz',
    'email' => 'aprendiz@cefa.com',
    'password' => Hash::make('password123'),
    'role' => 'aprendiz'
]);

# 5. Verificar
User::all();

# 6. Salir
exit
```

## 🔐 Credenciales por Defecto

### Administrador
- **Email:** admin@cefa.com
- **Contraseña:** password123

### Aprendiz
- **Email:** aprendiz@cefa.com
- **Contraseña:** password123

## ⚠️ Notas Importantes

- Cambia las contraseñas después de la primera instalación
- Usa contraseñas seguras en producción
- No compartas las credenciales en repositorios públicos
- Considera usar variables de entorno para las credenciales

---

**¡Listo! Ya puedes acceder al sistema con estas credenciales.** 🎉
