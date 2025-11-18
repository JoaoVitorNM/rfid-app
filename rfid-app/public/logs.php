<?php
include("../includes/auth.php");
include("../config/db.php");
include("../includes/header.php");

$where = [];
$params = [];
$types  = "";

if (!empty($_GET['aluno'])) {
    $where[] = "students.name LIKE ?";
    $params[] = "%".$_GET['aluno']."%";
    $types   .= "s";
}
if (!empty($_GET['matricula'])) {
    $where[] = "students.matricula LIKE ?";
    $params[] = "%".$_GET['matricula']."%";
    $types   .= "s";
}
if (!empty($_GET['data_inicio']) && !empty($_GET['data_fim'])) {
    $where[] = "access_logs.access_time BETWEEN ? AND ?";
    $params[] = $_GET['data_inicio']." 00:00:00";
    $params[] = $_GET['data_fim']." 23:59:59";
    $types   .= "ss";
}

$sql = "SELECT access_logs.id, students.name, students.matricula, students.course, students.rfid_uid, 
               access_logs.reader_location, access_logs.access_time
        FROM access_logs
        JOIN students ON access_logs.student_id = students.id";

if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY access_logs.access_time DESC";

$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Registros de Acesso</h2>

<form method="get" class="row g-3 mb-4">
  <div class="col-md-3">
    <input type="text" class="form-control" name="aluno" placeholder="Nome do aluno" value="<?= $_GET['aluno'] ?? '' ?>">
  </div>
  <div class="col-md-2">
    <input type="text" class="form-control" name="matricula" placeholder="Matrícula" value="<?= $_GET['matricula'] ?? '' ?>">
  </div>
  <div class="col-md-2">
    <input type="date" class="form-control" name="data_inicio" value="<?= $_GET['data_inicio'] ?? '' ?>">
  </div>
  <div class="col-md-2">
    <input type="date" class="form-control" name="data_fim" value="<?= $_GET['data_fim'] ?? '' ?>">
  </div>
  <div class="col-md-2">
    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
  </div>
</form>

<table class="table table-striped mt-3">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Aluno</th>
      <th>Matrícula</th>
      <th>Curso</th>
      <th>UID RFID</th>
      <th>Local</th>
      <th>Data/Hora</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['matricula'] ?></td>
        <td><?= $row['course'] ?></td>
        <td><?= $row['rfid_uid'] ?></td>
        <td><?= $row['reader_location'] ?></td>
        <td><?= date("d/m/Y H:i:s", strtotime($row['access_time'])) ?></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
</div>
</body>
</html>
