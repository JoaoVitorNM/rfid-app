<?php
include("../includes/auth.php");
include("../config/db.php");

$id = $_GET['id'];

$sql = "DELETE FROM students WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: list.php");
    exit();
} else {
    echo "Erro ao excluir: " . $conn->error;
}
