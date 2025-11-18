<?php
$host = "localhost";
$user = "root";
$pass = "";

// Banco 1 (dados pessoais)
$conn_students = new mysqli($host, $user, $pass, "rfid_students");

// Banco 2 (tags + logs)
$conn_tags = new mysqli($host, $user, $pass, "rfid_tags");

if ($conn_students->connect_error || $conn_tags->connect_error) {
    die("Erro: " . $conn_students->connect_error . " / " . $conn_tags->connect_error);
}
?>
