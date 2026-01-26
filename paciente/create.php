<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? '';
    $tipo_sanguineo = $_POST['tipo_sanguineo'] ?? '';
    $stmt = $pdo->prepare('INSERT INTO paciente (nome, data_nascimento, tipo_sanguineo) VALUES (?, ?, ?)');
    $stmt->execute([$nome, $data_nascimento, $tipo_sanguineo]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="utf-8"><title>Adicionar Paciente</title></head>
<body>
    <h1>Adicionar Paciente</h1>
    <a href="index.php">Voltar</a>
    <form method="post">
        <label>Nome:<br><input type="text" name="nome" required></label><br>
        <label>Data de Nascimento:<br><input type="date" name="data_nascimento" required></label><br>
        <label>Tipo Sanguíneo:<br><input type="text" name="tipo_sanguineo" maxlength="3" required></label><br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
