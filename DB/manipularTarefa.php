<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: /ProjetoIndividual/index.php");
    exit;
}

include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/DB/database.php");

// Verifica se os campos básicos foram fornecidos
if (!isset($_POST['titulo']) || !isset($_POST['descricao']) || !isset($_POST['estado'])) {
    header("Location: /ProjetoIndividual/Pages/Tarefas/tarefas.php");
    exit;
}

$titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
$descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
$estado = $_POST['estado'];
$idusuario = $_SESSION['idusuario'];

// Verifica se é uma edição (tem ID) ou criação nova
if (isset($_POST['idtarefa']) && !empty($_POST['idtarefa'])) {
    $idtarefa = $_POST['idtarefa'];
    
    // Verifica se a tarefa pertence ao usuário
    $sql = "SELECT * FROM tarefa WHERE idtarefa = $idtarefa AND idusuario = $idusuario";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) == 0) {
        header("Location: /ProjetoIndividual/Pages/Tarefas/tarefas.php");
        exit;
    }

    // Atualiza a tarefa existente
    $sql = "UPDATE tarefa SET titulo = '$titulo', descricao = '$descricao', estado = $estado WHERE idtarefa = $idtarefa AND idusuario = $idusuario";
    $result = mysqli_query($conexao, $sql);

    if ($result) {
        header("Location: /ProjetoIndividual/Pages/Tarefas/tarefas.php");
    } else {
        echo "Erro ao atualizar a tarefa: " . mysqli_error($conexao);
    }
} else {
    // Cria uma nova tarefa
    $sql = "INSERT INTO tarefa (titulo, descricao, estado, idusuario) VALUES ('$titulo', '$descricao', $estado, $idusuario)";
    $result = mysqli_query($conexao, $sql);

    if ($result) {
        header("Location: /ProjetoIndividual/Pages/Tarefas/tarefas.php");
    } else {
        echo "Erro ao criar a tarefa: " . mysqli_error($conexao);
    }
}
