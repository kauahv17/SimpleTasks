<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/DB/database.php");
session_start();

$login = $_POST["usuario"];
$senha = sha1("{$_POST['senha']}{$_POST['usuario']}");

// Buscar o usuário no banco
$sql = "SELECT * FROM usuario WHERE login = '$login'";
$res = mysqli_query($conexao, $sql);

if (mysqli_num_rows($res) === 1) {
    $dados = mysqli_fetch_assoc($res);
    
    // Verifica se a senha está correta
    if ($dados['senha'] === $senha) {
        // Inicia sessão
        $_SESSION["idusuario"] = $dados["idusuario"];
        $_SESSION["login"] = $dados["login"];
        $_SESSION["nome"] = $dados["nome"];

        header("Location: /ProjetoIndividual/Pages/Home/home.php");
        exit;
    }
}

echo "<script>alert('Usuário ou senha incorretos!');history.back();</script>";
