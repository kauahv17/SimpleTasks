<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: /ProjetoIndividual/index.php");
    exit;
}
?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/includes/cabecalho.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/DB/database.php");
?>

<h1 align='center'>Tarefas</h1><br><br>

<div class="container">
    <div class="header-list">
        <h4>Lista de Tarefas</h4>

        <div class="btn-group-custom">
            <button class="btn-custom active" data-target="todas">Todas</button>
            <button class="btn-custom gray" data-target="pendentes">Pendentes</button>
            <button class="btn-custom green" data-target="concluidas">Concluídas</button>
        </div>
        <h5 id="qntd-tasks"></h5>
    </div>
    <hr>

    <?php
    $idusuario = $_SESSION['idusuario'];
    $sql = "SELECT * FROM tarefa WHERE idusuario = $idusuario";
    $result = mysqli_query($conexao, $sql);

    $tarefas_todas = "";
    $tarefas_pendentes = "";
    $tarefas_concluidas = "";

    while ($row = mysqli_fetch_assoc($result)) {
        $idtarefa = $row['idtarefa'];
        $titulo = htmlspecialchars($row['titulo']);
        $descricao = htmlspecialchars($row['descricao']);
        $estado = $row['estado'];

        $cor = $estado ? "verde" : "amarelo";
        $checked = $estado ? "checked" : "";

        $html = "<div class='task-item' data-id='$idtarefa'>
                    <div class='task-content'>
                        <div class='task-bar $cor'></div>
                        <div class='task-text'>
                            <strong>$titulo</strong>
                            <p>$descricao</p>
                        </div>
                    </div>
                    <div class='task-actions'>
                        <input type='checkbox' $checked>
                        <a href='#'><img src='/ProjetoIndividual/imgs/olhar.png' alt='Ver' class='btn-ver' ></a>
                        <a href='/ProjetoIndividual/Pages/NovaTarefa/novaTarefa.php?id=$idtarefa'>
                            <img src='/ProjetoIndividual/imgs/editar.png' alt='Editar'>
                        </a>
                        <a href='#' class='excluir-tarefa'><img src='/ProjetoIndividual/imgs/lixeira.png' alt='Excluir'></a>
                    </div>
                </div>";

        $tarefas_todas .= $html;
        if ($estado) {
            $tarefas_concluidas .= $html;
        } else {
            $tarefas_pendentes .= $html;
        }
    }
    ?>

    <!-- Lista de Todas as Tarefas -->
    <div class="task-list active" id="todas">
        <?= $tarefas_todas ?>
    </div>

    <!-- Lista de Tarefas Pendentes -->
    <div class="task-list" id="pendentes">
        <?= $tarefas_pendentes ?>
    </div>

    <!-- Lista de Tarefas Concluídas -->
    <div class="task-list" id="concluidas">
        <?= $tarefas_concluidas ?>
    </div>
</div>