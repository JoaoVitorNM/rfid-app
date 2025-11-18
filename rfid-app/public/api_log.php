<?php
include("../config/db.php");

$uid = $_GET['uid'] ?? null;
$loc = $_GET['location'] ?? "Desconhecido";

if (!$uid) die("UID ausente.");

// Procura UID
$stmt = $conn_tags->prepare("SELECT tag_id FROM tags WHERE rfid_uid=?");
$stmt->bind_param("s", $uid);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows == 0) {
    die("UID não registrado!");
}

$tag = $res->fetch_assoc();

// Insere log
$stmt2 = $conn_tags->prepare("INSERT INTO access_logs (tag_id, reader_location) VALUES (?, ?)");
$stmt2->bind_param("is", $tag['tag_id'], $loc);
$stmt2->execute();

echo "Acesso registrado!";
