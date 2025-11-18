<?php
include("../includes/auth.php");
include("../config/db.php");
include("../includes/header.php");

$sql = "
SELECT access_logs.*, tags.rfid_uid, tags.student_ref
FROM access_logs
INNER JOIN tags ON access_logs.tag_id = tags.tag_id
ORDER BY access_logs.id DESC
";

$res = $conn_tags->query($sql);
?>

<h3>Logs de Acesso</h3>

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>UID</th>
    <th>ID Aluno</th>
    <th>Local</th>
    <th>Data/Hora</th>
</tr>

<?php while ($row = $res->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['rfid_uid'] ?></td>
    <td><?= $row['student_ref'] ?></td>
    <td><?= $row['reader_location'] ?></td>
    <td><?= $row['access_time'] ?></td>
</tr>
<?php endwhile; ?>
</table>

<?php include("../includes/footer.php"); ?>
