<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM medico WHERE id = ?');
$stmt->execute([$id]);
$medico = $stmt->fetch();
if (!$medico) {
    echo "Médico não encontrado";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $especialidade = $_POST['especialidade'] ?? '';
    $u = $pdo->prepare('UPDATE medico SET nome = ?, especialidade = ? WHERE id = ?');
    $u->execute([$nome, $especialidade, $id]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="utf-8"><title>Editar Médico</title></head>
<body>
    <h1>Editar Médico</h1>
    <a href="index.php">Voltar</a>
    <form method="post">
        <label>Nome:<br><input type="text" name="nome" value="<?= htmlspecialchars($medico['nome']) ?>" required></label><br>
        <label>Especialidade:<br><input type="text" name="especialidade" value="<?= htmlspecialchars($medico['especialidade']) ?>" required></label><br>
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
