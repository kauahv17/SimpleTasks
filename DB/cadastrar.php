<?php
session_start();
//abrir conexão com o BD
include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/DB/database.php");
//recuperar os dados do formulário
$nome = $_POST["nome"];
$foto_perfil = "imgs/perfil.png";

$login = $_POST["usuario"];
$senha = sha1("{$_POST['senha']}{$_POST['usuario']}");
//criar o SQL que insere o usuário
$sql_usuario = "INSERT INTO usuario VALUES(null,'$nome','$login','$senha','$foto_perfil');";
//executar o SQL e verificar se deu erro
$res = mysqli_query($conexao, $sql_usuario);

if (mysqli_affected_rows($conexao) > 0) {
    // Obter o ID do usuário recém-criado
    $idusuario = mysqli_insert_id($conexao);
    
    // Definir as variáveis de sessão
    $_SESSION["idusuario"] = $idusuario;
    $_SESSION["login"] = $login;
    $_SESSION["nome"] = $nome;
    $_SESSION["foto_perfil"] = $foto_perfil;
    
    header("Location: /ProjetoIndividual/Pages/Home/home.php");
    exit;
} else {
    echo "<meta http-equiv='refresh' content='0;url=/ProjetoIndividual/index.php'>
        <script type='text/javascript'>alert('Erro ao inserir usuário!');</script>";
}
