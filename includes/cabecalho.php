<!DOCTYPE html>
<html lang="en">

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "SimpleTasks"; ?></title>
    <!--  BOOTSTRAP  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--  FONT AWESOME  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--  CSS  -->
    <link rel="stylesheet" href="/ProjetoIndividual/Includes/headerStyle.css">
    <!--  JavaScript  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS exclusivo da Home -->
    <?php
    $atualPage = basename($_SERVER["SCRIPT_FILENAME"]);
    if ($atualPage === "home.php"): ?>
        <link rel="stylesheet" href="/ProjetoIndividual/Pages/Home/homeStyle.css">
        <script src="/ProjetoIndividual/Pages/Home/cards.js" defer></script>

    <?php elseif ($atualPage === "formularioCadastrar.php" or $atualPage === "index.php"): ?>
        <link rel="stylesheet" href="/ProjetoIndividual/Pages/Login/formStyle.css">

    <?php elseif ($atualPage === "tarefas.php"): ?>
        <link rel="stylesheet" href="/ProjetoIndividual/Pages/Tarefas/tarefasStyle.css">
        <script src="/ProjetoIndividual/Pages/Tarefas/tarefas.js" defer></script>

    <?php elseif ($atualPage === "novaTarefa.php"): ?>
        <link rel="stylesheet" href="/ProjetoIndividual/Pages/NovaTarefa/novaTarefaStyle.css">
        <script src="/ProjetoIndividual/Pages/NovaTarefa/check.js" defer></script>

    <?php elseif ($atualPage === "perfil.php"): ?>
        <link rel="stylesheet" href="/ProjetoIndividual/Pages/Perfil/perfilStyle.css">
        <script src="/ProjetoIndividual/Pages/Perfil/edit.js" defer></script>

    <?php endif; ?>

</head>

<body>
    <header>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="/ProjetoIndividual/Pages/Home/home.php">
                    <img src="/ProjetoIndividual/imgs/logo.png" alt="Logo" title="Tarefas"><b> SimpleTasks</b>
                </a>
                <div class="navbar-nav">

                    <?php if (isset($_SESSION["login"])): ?>
                        <a class="nav-link" href="/ProjetoIndividual/Pages/Home/home.php">Início</a>
                        <a class="nav-link" href="/ProjetoIndividual/Pages/Tarefas/tarefas.php">Minhas Tarefas</a>
                        <a class="nav-link" href="/ProjetoIndividual/Pages/NovaTarefa/novaTarefa.php">Nova Tarefa</a>
                        <a class="nav-link" href="/ProjetoIndividual/Pages/Perfil/perfil.php">Perfil</a>
                        <a class="nav-link" href="/ProjetoIndividual/logout.php">Sair</a>

                    <?php else: ?>
                        <a class="nav-link" href="/ProjetoIndividual/Pages/Login/formularioCadastrar.php">Cadastrar</a>
                        <a class="nav-link" href="/ProjetoIndividual/index.php">Logar</a>
                    <?php endif; ?>

                </div>
        </div>
        </nav>
    </header>