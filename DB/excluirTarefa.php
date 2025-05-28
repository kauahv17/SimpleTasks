<?php
session_start();
if (!isset($_SESSION["login"])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/DB/database.php");

if (!isset($_POST['idtarefa'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'ID da tarefa não fornecido']);
    exit;
}

$idtarefa = $_POST['idtarefa'];
$idusuario = $_SESSION['idusuario'];

// Exclui a tarefa diretamente
$sql = "DELETE FROM tarefa WHERE idtarefa = $idtarefa AND idusuario = $idusuario";
$result = mysqli_query($conexao, $sql);

header('Content-Type: application/json');
if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao excluir a tarefa']);
}
?> 