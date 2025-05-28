<?php
session_start();
if (!isset($_SESSION["idusuario"])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/DB/database.php");

header('Content-Type: application/json');

// Verifica se é uma atualização de estado
if (isset($_POST['idtarefa']) && isset($_POST['estado'])) {
    $idtarefa = $_POST['idtarefa'];
    $estado = $_POST['estado'];
    $idusuario = $_SESSION['idusuario'];

    // Verifica se a tarefa pertence ao usuário
    $sql_verificar = "SELECT * FROM tarefa WHERE idtarefa = $idtarefa AND idusuario = $idusuario";
    $res_verificar = mysqli_query($conexao, $sql_verificar);

    if (mysqli_num_rows($res_verificar) === 0) {
        echo json_encode(['success' => false, 'message' => 'Tarefa não encontrada ou não pertence ao usuário']);
        exit;
    }

    // Atualiza o estado da tarefa
    $sql = "UPDATE tarefa SET estado = $estado WHERE idtarefa = $idtarefa AND idusuario = $idusuario";
    $res = mysqli_query($conexao, $sql);

    if ($res) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => mysqli_error($conexao)]);
    }
    exit;
}

// Verifica se é uma atualização completa da tarefa
if (!isset($_POST['idtarefa']) || !isset($_POST['titulo']) || !isset($_POST['descricao'])) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
    exit;
}

$idtarefa = $_POST['idtarefa'];
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$idusuario = $_SESSION['idusuario'];

// Verifica se a tarefa pertence ao usuário
$sql_verificar = "SELECT * FROM tarefa WHERE idtarefa = $idtarefa AND idusuario = $idusuario";
$res_verificar = mysqli_query($conexao, $sql_verificar);

if (mysqli_num_rows($res_verificar) === 0) {
    echo json_encode(['success' => false, 'message' => 'Tarefa não encontrada ou não pertence ao usuário']);
    exit;
}

// Atualiza a tarefa
$sql = "UPDATE tarefa SET titulo = '$titulo', descricao = '$descricao' WHERE idtarefa = $idtarefa AND idusuario = $idusuario";
$res = mysqli_query($conexao, $sql);

if ($res) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conexao)]);
} 