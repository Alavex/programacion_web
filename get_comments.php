<?php
$servername = "sql104.infinityfree.com";
$username = "if0_36746929";
$password = "LdePPOLTMO";
$dbname = "if0_36746929_salud_mental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$article_id = $conn->real_escape_string($_GET['article_id']);

$sql = "SELECT * FROM comments WHERE article_id = $article_id";
$result = $conn->query($sql);

$comments = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
}

echo json_encode($comments);

$conn->close();
?>