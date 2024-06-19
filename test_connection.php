<?php
$servername = "sql104.infinityfree.com";
$username = "if0_36746929";
$password = "LdePPOLTMO";
$dbname = "if0_36746929_salud_mental";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>