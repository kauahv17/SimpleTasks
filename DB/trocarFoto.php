<?php
session_start();
if (!isset($_SESSION['idusuario'])) {
    header("Location: /ProjetoIndividual/index.php");
    exit;
}

include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/DB/database.php");

$idusuario = $_SESSION['idusuario'];

if (isset($_FILES['nova-imagem']) && $_FILES['nova-imagem']['error'] == 0) {
    $pastaDestino = $_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/imgs/";
    if (!file_exists($pastaDestino)) {
        mkdir($pastaDestino, 0755, true);
    }

    $fotoAtual = $_SESSION['foto_perfil'];

    if ($fotoAtual !== "imgs/perfil.png") {
        $caminhoAntigo = $_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/" . $fotoAtual;
        if (file_exists($caminhoAntigo)) {
            unlink($caminhoAntigo);
        }
    }

    $extensao = pathinfo($_FILES['nova-imagem']['name'], PATHINFO_EXTENSION);
    $nomeArquivo = "perfil_" . $idusuario . "." . $extensao;
    $caminhoCompleto = $pastaDestino . $nomeArquivo;

    if (move_uploaded_file($_FILES['nova-imagem']['tmp_name'], $caminhoCompleto)) {
        $caminhoBanco = "imgs/" . $nomeArquivo;

        $sql = "UPDATE usuario SET foto_perfil = '$caminhoBanco' WHERE idusuario = $idusuario";
        mysqli_query($conexao, $sql);


        $_SESSION['foto_perfil'] = $caminhoBanco;
    }
}

header("Location: /ProjetoIndividual/Pages/Perfil/perfil.php");
exit;
