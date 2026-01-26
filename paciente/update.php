<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../db.php';

$id = $_GET['id'] ?? null;
if (!$id) { header('Location: index.php'); exit; }

$stmt = $pdo->prepare('SELECT * FROM paciente WHERE id = ?');
$stmt->execute([$id]);
$p = $stmt->fetch();
if (!$p) { echo "Paciente não encontrado"; exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? '';
    $tipo_sanguineo = $_POST['tipo_sanguineo'] ?? '';
    $u = $pdo->prepare('UPDATE paciente SET nome = ?, data_nascimento = ?, tipo_sanguineo = ? WHERE id = ?');
    $u->execute([$nome, $data_nascimento, $tipo_sanguineo, $id]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="utf-8"><title>Editar Paciente</title></head>
<body>
    <h1>Editar Paciente</h1>
    <a href="index.php">Voltar</a>
    <form method="post">
        <label>Nome:<br><input type="text" name="nome" value="<?= htmlspecialchars($p['nome']) ?>" required></label><br>
        <label>Data de Nascimento:<br><input type="date" name="data_nascimento" value="<?= htmlspecialchars($p['data_nascimento']) ?>" required></label><br>
        <label>Tipo Sanguíneo:<br><input type="text" name="tipo_sanguineo" maxlength="3" value="<?= htmlspecialchars($p['tipo_sanguineo']) ?>" required></label><br>
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
