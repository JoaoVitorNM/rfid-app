<?php
// Banco 1 – Dados dos alunos
$host = "localhost";
$user = "root";
$pass = "";

$conn_students = new mysqli($host, $user, $pass, "rfid_students");

// Banco 2 – RFID e logs
$conn_tags = new mysqli($host, $user, $pass, "rfid_tags");

if ($conn_students->connect_error || $conn_tags->connect_error) {
    die("Erro de conexão: " . $conn_students->connect_error . " / " . $conn_tags->connect_error);
}
?>
