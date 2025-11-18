<?php
include("../includes/auth.php");
include("../config/db.php");
include("../includes/header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome      = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $curso     = $_POST['curso'];
    $rfid_uid  = $_POST['rfid_uid'];

    // Inserir no banco de alunos
    $stmt = $conn_students->prepare("INSERT INTO students (nome, matricula, curso) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $matricula, $curso);
    $stmt->execute();
    $student_id = $stmt->insert_id;

    // Inserir UID no banco de tags
    $stmt2 = $conn_tags->prepare("INSERT INTO tags (student_ref, rfid_uid) VALUES (?, ?)");
    $stmt2->bind_param("is", $student_id, $rfid_uid);
    $stmt2->execute();

    $msg = "Cadastro realizado com sucesso!";
}
?>

<h3>Cadastrar Aluno + Tag RFID</h3>

<?php if (isset($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>

<form method="POST">
    <label>Nome:</label>
    <input type="text" name="nome" class="form-control" required>

    <label>Matrícula:</label>
    <input type="text" name="matricula" class="form-control" required>

    <label>Curso:</label>
    <input type="text" name="curso" class="form-control" required>

    <label>UID do Cartão RFID:</label>
    <input type="text" name="rfid_uid" class="form-control" required>

    <button class="btn btn-primary mt-3">Cadastrar</button>
</form>

<?php include("../includes/footer.php"); ?>
