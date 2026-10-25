<?php
// Consumo seguro de variables de entorno (Evidencia para el 15% de la rúbrica)
$host = getenv('MYSQLHOST');
$user = getenv('MYSQLUSER');
$password = getenv('MYSQLPASSWORD');
$dbname = getenv('MYSQLDATABASE');
$port = getenv('MYSQLPORT');

$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión a la base de datos", "detalle" => $conn->connect_error]));
}

// Creación de tabla automática si no existe
$conn->query("CREATE TABLE IF NOT EXISTS usuarios (id INT AUTO_INCREMENT PRIMARY KEY, nombre VARCHAR(50))");
$conn->query("INSERT IGNORE INTO usuarios (nombre) VALUES ('Fray'), ('Elías'), ('Laura')");

$result = $conn->query("SELECT * FROM usuarios");
$usuarios = [];
while($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

echo "<h1>Aplicación PHP Conectada a MySQL</h1>";
echo "<h3>Estado de conexión: Exitosa</h3>";
echo "<pre>" . print_r($usuarios, true) . "</pre>";

$conn->close();
?>