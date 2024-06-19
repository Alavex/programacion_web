<?php
$servername = "sql104.infinityfree.com";
$username = "if0_36746929";
$password = "LdePPOLTMO";
$dbname = "if0_36746929_salud_mental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM articles";
$result = $conn->query($sql);

$articles = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
}

echo json_encode($articles);

$conn->close();
?>