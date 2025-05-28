<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: /ProjetoIndividual/index.php");
    exit;
}

// Carregar o nome do usuário do banco de dados se não estiver na sessão
if (!isset($_SESSION["nome"])) {
    include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/DB/database.php");
    $idusuario = $_SESSION["idusuario"];
    $sql = "SELECT nome FROM usuario WHERE idusuario = $idusuario";
    $res = mysqli_query($conexao, $sql);
    if ($row = mysqli_fetch_assoc($res)) {
        $_SESSION["nome"] = $row["nome"];
    }
}
?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/includes/cabecalho.php");
?>

<h1 align='center'>Perfil</h1><br><br>

<div class="container perfil-container">
    <div class="perfil-card">
        <form action="/ProjetoIndividual/DB/trocarFoto.php" method="POST" enctype="multipart/form-data">
            <div class="avatar-wrapper">
                <?php
                $foto = $_SESSION['foto_perfil'] ?? 'imgs/perfil.png';
                ?>
                <img src="/ProjetoIndividual/<?php echo $foto; ?>" alt="Avatar" class="avatar-img">

                <label class="upload-icon">
                    <img src="/ProjetoIndividual/imgs/trocar_foto.png" alt="Upload">
                    <input type="file" name="nova-imagem" accept="image/*" hidden>
                </label>
            </div>
        </form>

        <form method="POST" action="/ProjetoIndividual/DB/trocarNome.php" class="perfil-nome" id="form-nome">
            <input type="text" name="novo-nome" id="input-nome" class="input-nome" value="<?php echo $_SESSION['nome']; ?>" readonly>
            <img src="/ProjetoIndividual/imgs/editar.png" alt="Editar" class="icon-edit" id="btn-editar-nome">
        </form>

        <a href="/ProjetoIndividual/logout.php"><button class="btn-sair">Sair da conta</button></a>
    </div>
</div>