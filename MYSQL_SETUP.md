# 🗄️ Configuración de MySQL para Koinonia

## Paso 1: Iniciar MySQL en Herd

1. Abre **Herd** (el ícono en la barra de tareas)
2. Ve a **Servicios** o **Services**
3. Asegúrate de que **MySQL** esté activado/corriendo
4. Si no está corriendo, haz clic para iniciarlo

## Paso 2: Crear la Base de Datos

Abre una terminal en la carpeta del proyecto y ejecuta:

```powershell
# Opción 1: Si tienes phpMyAdmin
# Ve a http://localhost/phpmyadmin y crea una BD llamada: koinonia_asistencias

# Opción 2: Usando la CLI de Herd
herd mysql

# Luego dentro de MySQL:
CREATE DATABASE koinonia_asistencias CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

## Paso 3: Ejecutar las Migraciones

Una vez creada la base de datos, ejecuta:

```powershell
php artisan migrate:fresh
```

Esto creará todas las tablas necesarias.

## Paso 4: (Opcional) Agregar Datos de Prueba

Si quieres datos de prueba:

```powershell
php artisan db:seed
```

## ✅ Verificar la Conexión

Para verificar que todo funciona:

```powershell
php artisan tinker

# Dentro de tinker:
DB::connection()->getPdo();
# Si ves información de la conexión, ¡funciona!

# También puedes probar:
User::count();
# Debería devolver 0 si acabas de migrar
```

## 🔧 Solución de Problemas

### Error: "Connection refused"
- Verifica que MySQL esté corriendo en Herd
- Revisa que el puerto sea 3306 en el `.env`

### Error: "Access denied"
- Verifica el usuario y contraseña en `.env`
- Por defecto Herd usa: usuario `root`, sin contraseña

### Error: "Unknown database"
- Asegúrate de haber creado la base de datos `koinonia_asistencias`

## 📱 Nota sobre Optimizaciones Móviles

El sistema ahora está **completamente optimizado para móviles**:
- ✅ Botones más grandes (mínimo 48x48px) para touch
- ✅ Inputs con font-size 16px (evita zoom en iOS)
- ✅ Diseño responsive en todas las vistas
- ✅ Animaciones más rápidas en móvil
- ✅ Meta tags optimizados para PWA
- ✅ Touch-friendly spacing y padding

**Prueba en tu celular para ver las mejoras!** 📱
