<?php

// caso não tenha sido feita uma requisição post, redireciona o cliente para a página inicial
// caso não tenha sido informado um id na requisição, também redireciona para a página inicial
if ($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['id'])) {
    header('Location: /');
    exit();
}

require_once('db.php');

$sql = "DELETE FROM professores WHERE id = $_POST[id]";
$query = $conn->query($sql);

if (!$query) {
    die('Falha ao excluir professor: ' . $conn->error);
}

// após excluir o professor no banco de dados, redireciona para a página inicial
header("Location: /");