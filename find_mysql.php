<?php

echo "🔍 Buscando MySQL de Herd...\n\n";

$ports = [3306, 3307, 3308, 3309, 33060];
$found = false;

foreach ($ports as $port) {
    echo "Probando puerto $port... ";
    try {
        $pdo = new PDO("mysql:host=localhost;port=$port", 'root', '', [
            PDO::ATTR_TIMEOUT => 2,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        echo "✅ CONECTADO!\n";
        echo "\n📊 Información:\n";
        echo "   Puerto: $port\n";
        echo "   Usuario: root\n";
        echo "   Contraseña: (vacía)\n\n";
        
        // Listar bases de datos
        echo "📁 Bases de datos disponibles:\n";
        $result = $pdo->query("SHOW DATABASES");
        while ($row = $result->fetch(PDO::FETCH_NUM)) {
            $db = $row[0];
            if (!in_array($db, ['information_schema', 'mysql', 'performance_schema', 'sys'])) {
                echo "   - $db\n";
            }
        }
        
        $found = true;
        echo "\n✨ Actualiza tu .env con:\n";
        echo "   DB_PORT=$port\n";
        break;
    } catch (PDOException $e) {
        echo "❌\n";
    }
}

if (!$found) {
    echo "\n⚠️  No se encontró MySQL corriendo en ningún puerto común.\n";
    echo "\n📝 Opciones:\n";
    echo "   1. Inicia MySQL en Herd (icono → Servicios → MySQL)\n";
    echo "   2. O usa SQLite en su lugar (más simple)\n";
}
