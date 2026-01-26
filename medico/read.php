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
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="utf-8"><title>Detalhes Médico</title></head>
<body>
    <h1>Detalhes do Médico</h1>
    <a href="index.php">Voltar</a>
    <p><strong>ID:</strong> <?= htmlspecialchars($medico['id']) ?></p>
    <p><strong>Nome:</strong> <?= htmlspecialchars($medico['nome']) ?></p>
    <p><strong>Especialidade:</strong> <?= htmlspecialchars($medico['especialidade']) ?></p>
</body>
</html>
