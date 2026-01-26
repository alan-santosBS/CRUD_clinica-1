<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../db.php';

$id = $_GET['id'] ?? null;
if (!$id) { header('Location: index.php'); exit; }
$stmt = $pdo->prepare('SELECT * FROM paciente WHERE id = ?');
$stmt->execute([$id]);
$p = $stmt->fetch();
if (!$p) { echo "Paciente não encontrado"; exit; }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="utf-8"><title>Detalhes Paciente</title></head>
<body>
    <h1>Detalhes do Paciente</h1>
    <a href="index.php">Voltar</a>
    <p><strong>ID:</strong> <?= htmlspecialchars($p['id']) ?></p>
    <p><strong>Nome:</strong> <?= htmlspecialchars($p['nome']) ?></p>
    <p><strong>Data Nascimento:</strong> <?= htmlspecialchars($p['data_nascimento']) ?></p>
    <p><strong>Tipo Sanguíneo:</strong> <?= htmlspecialchars($p['tipo_sanguineo']) ?></p>
</body>
</html>
