<?php
$servername = "sql104.infinityfree.com";
$username = "if0_36746929";
$password = "LdePPOLTMO";
$dbname = "if0_36746929_salud_mental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error]));
}

$conn->set_charset("utf8");

$data = json_decode(file_get_contents('php://input'), true);
$article_id = $conn->real_escape_string($data['article_id']);
$username = $conn->real_escape_string($data['username']);
$comment = $conn->real_escape_string($data['comment']);

$sql = "INSERT INTO comments (article_id, username, comment) VALUES ('$article_id', '$username', '$comment')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>