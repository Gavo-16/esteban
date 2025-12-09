<?php

try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "� Creando base de datos koinonia_db...\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS koinonia_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✅ Base de datos koinonia_db creada exitosamente\n\n";
    
    echo "🎉 ¡Listo! Ahora ejecuta: php artisan migrate --seed\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
