<?php
include("../includes/auth.php");
include("../config/db.php");
include("../includes/header.php");

$res = $conn_students->query("SELECT * FROM students ORDER BY id DESC");
?>

<h3>Alunos</h3>
<a href="register.php" class="btn btn-success mb-3">Cadastrar Aluno + RFID</a>

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Matrícula</th>
    <th>Curso</th>
</tr>

<?php while($row = $res->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['nome'] ?></td>
    <td><?= $row['matricula'] ?></td>
    <td><?= $row['curso'] ?></td>
</tr>
<?php endwhile; ?>

</table>

<?php include("../includes/footer.php"); ?>
