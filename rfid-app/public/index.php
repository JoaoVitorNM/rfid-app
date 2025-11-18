<?php
session_start();
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    if ($user == "admin" && $pass == "123456") {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit();
    }

    $msg = "Usuário ou senha inválidos!";
}
?>

<?php include("../includes/header.php"); ?>

<div class="col-md-4 offset-md-4">
    <h3>Login</h3>
    <?php if (isset($msg)) echo "<div class='alert alert-danger'>$msg</div>"; ?>
    <form method="POST">
        <label>Usuário:</label>
        <input type="text" name="user" class="form-control" required>

        <label>Senha:</label>
        <input type="password" name="pass" class="form-control" required>

        <button class="btn btn-primary mt-3 w-100">Entrar</button>
    </form>
</div>

<?php include("../includes/footer.php"); ?>
