<?php
include("../config/db.php");

$rfid_uid = $_GET['uid'] ?? null;
$location = $_GET['location'] ?? "Desconhecido";

if (!$rfid_uid) die("UID não informado!");

$sql = "SELECT tag_id FROM tags WHERE rfid_uid=?";
$stmt = $conn_tags->prepare($sql);
$stmt->bind_param("s", $rfid_uid);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    $tag = $res->fetch_assoc();
    $tag_id = $tag['tag_id'];

    $sql2 = "INSERT INTO access_logs (tag_id, reader_location) VALUES (?, ?)";
    $stmt2 = $conn_tags->prepare($sql2);
    $stmt2->bind_param("is", $tag_id, $location);
    $stmt2->execute();

    echo "Acesso registrado!";
} else {
    echo "Etiqueta não cadastrada!";
}

