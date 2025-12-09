<?php

try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "CREATE DATABASE IF NOT EXISTS koinonia_asistencias CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $pdo->exec($sql);
    
    echo "✅ Base de datos 'koinonia_asistencias' creada exitosamente\n";
    
    // Verificar que existe
    $result = $pdo->query("SHOW DATABASES LIKE 'koinonia_asistencias'");
    if ($result->rowCount() > 0) {
        echo "✅ Verificado: La base de datos existe\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
