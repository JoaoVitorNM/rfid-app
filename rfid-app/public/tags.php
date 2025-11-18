<?php
include("../includes/auth.php");
include("../config/db.php");
include("../includes/header.php");

$res = $conn_tags->query("SELECT * FROM tags ORDER BY tag_id DESC");
?>

<h3>Tags RFID</h3>

<table class="table table-bordered">
<tr>
    <th>ID Tag</th>
    <th>ID Aluno (Ref.)</th>
    <th>UID</th>
</tr>

<?php while ($row = $res->fetch_assoc()): ?>
<tr>
    <td><?= $row['tag_id'] ?></td>
    <td><?= $row['student_ref'] ?></td>
    <td><?= $row['rfid_uid'] ?></td>
</tr>
<?php endwhile; ?>
</table>

<?php include("../includes/footer.php"); ?>
