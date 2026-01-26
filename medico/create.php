<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $especialidade = $_POST['especialidade'] ?? '';

    $stmt = $pdo->prepare('INSERT INTO medico (nome, especialidade) VALUES (?, ?)');
    $stmt->execute([$nome, $especialidade]);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="utf-8"><title>Adicionar Médico</title></head>
<body>
    <h1>Adicionar Médico</h1>
    <a href="index.php">Voltar</a>
    <form method="post">
        <label>Nome:<br><input type="text" name="nome" required></label><br>
        <label>Especialidade:<br><input type="text" name="especialidade" required></label><br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
