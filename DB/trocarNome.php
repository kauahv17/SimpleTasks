<?php
session_start();
if (!isset($_SESSION['idusuario'])) {
    header("Location: /ProjetoIndividual/index.php");
    exit;
}

include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/DB/database.php");

$idusuario = $_SESSION['idusuario'];
$novoNome = trim($_POST['novo-nome'] ?? '');

if ($novoNome !== '') {
    // Atualiza apenas o nome
    $sql = "UPDATE usuario SET nome = '$novoNome' WHERE idusuario = $idusuario";
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['nome'] = $novoNome;
        header("Location: /ProjetoIndividual/Pages/Perfil/perfil.php");
        exit;
    } else {
        echo "<div style='background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc;'>";
        echo "<h3>Erro ao atualizar nome:</h3>";
        echo "<p>Erro MySQL: " . mysqli_error($conexao) . "</p>";
        echo "<p><a href='javascript:history.back()'>Voltar</a></p>";
        echo "</div>";
        exit;
    }
} else {
    echo "<div style='background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc;'>";
    echo "<h3>Nome vazio:</h3>";
    echo "<p>O campo de nome não pode ficar vazio.</p>";
    echo "<p><a href='javascript:history.back()'>Voltar</a></p>";
    echo "</div>";
    exit;
}
