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
include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/DB/database.php");
?>

<h1 align='center'>Home</h1>
<h2 class="bem-vindo">Olá, <?php echo $_SESSION["nome"]; ?>! 👋</h2>
<p class="bem-vindo">Veja abaixo suas tarefas mais recentes</p><br><br>

<!-- cards.html -->
<div class="container py-4" style="background-color: #eeeeee;">
    <div class="row g-4">

        <?php
        // Buscar tarefas do banco de dados
        $idusuario = $_SESSION['idusuario'];
        
        // Tarefas pendentes (estado = 0)
        $sql_pendentes = "SELECT * FROM tarefa WHERE idusuario = $idusuario AND estado = 0 ORDER BY idtarefa DESC LIMIT 3";
        $result_pendentes = mysqli_query($conexao, $sql_pendentes);
        $count_pendentes = mysqli_num_rows($result_pendentes);
        
        // Tarefas concluídas (estado = 1)
        $sql_concluidas = "SELECT * FROM tarefa WHERE idusuario = $idusuario AND estado = 1 ORDER BY idtarefa DESC LIMIT 3";
        $result_concluidas = mysqli_query($conexao, $sql_concluidas);
        $count_concluidas = mysqli_num_rows($result_concluidas);
        
        // Todas as tarefas
        $sql_todas = "SELECT * FROM tarefa WHERE idusuario = $idusuario ORDER BY idtarefa DESC LIMIT 3";
        $result_todas = mysqli_query($conexao, $sql_todas);
        $count_todas = mysqli_num_rows($result_todas);
        ?>

        <!-- Card - Tarefas Pendentes -->
        <div class="col-md-4">
            <div class="task-card">
                <div class="task-header">
                    <div>
                        <h5 class="mb-0">Tarefas Pendentes</h5>
                        <small class="text-muted"><?php echo $count_pendentes; ?></small>
                    </div>
                    <button class="toggle-btn amarelo" onclick="toggleDropdown(this)">
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                </div>
                <div class="task-body amarelo">
                    <?php
                    if ($count_pendentes > 0) {
                        while ($row = mysqli_fetch_assoc($result_pendentes)) {
                            $titulo = htmlspecialchars($row['titulo']);
                            echo "<div class='task-item'>
                                    <span>$titulo</span><input type='checkbox'>
                                </div>";
                        }
                    } else {
                        echo "<div class='task-item'>
                                <span>Nenhuma tarefa pendente</span>
                            </div>";
                    }
                    ?>
                    <div class="text-end mt-2">
                        <a href="/ProjetoIndividual/Pages/Tarefas/tarefas.php"><button class="btn btn-light btn-sm">Ver mais</button></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card - Tarefas Concluídas -->
        <div class="col-md-4">
            <div class="task-card">
                <div class="task-header">
                    <div>
                        <h5 class="mb-0">Tarefas Concluídas</h5>
                        <small class="text-muted"><?php echo $count_concluidas; ?></small>
                    </div>
                    <button class="toggle-btn verde" onclick="toggleDropdown(this)">
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                </div>
                <div class="task-body verde">
                    <?php
                    if ($count_concluidas > 0) {
                        while ($row = mysqli_fetch_assoc($result_concluidas)) {
                            $titulo = htmlspecialchars($row['titulo']);
                            echo "<div class='task-item'>
                                    <span>$titulo</span><input type='checkbox' checked>
                                </div>";
                        }
                    } else {
                        echo "<div class='task-item'>
                                <span>Nenhuma tarefa concluída</span>
                            </div>";
                    }
                    ?>
                    <div class="text-end mt-2">
                        <a href="/ProjetoIndividual/Pages/Tarefas/tarefas.php"><button class="btn btn-light btn-sm">Ver mais</button></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card - Todas as Tarefas -->
        <div class="col-md-4">
            <div class="task-card">
                <div class="task-header">
                    <div>
                        <h5 class="mb-0">Todas as Tarefas</h5>
                        <small class="text-muted"><?php echo $count_todas; ?></small>
                    </div>
                    <button class="toggle-btn cinza" onclick="toggleDropdown(this)">
                        <b><i class="fa-solid fa-chevron-down"></i></b>
                    </button>
                </div>
                <div class="task-body cinza">
                    <?php
                    if ($count_todas > 0) {
                        while ($row = mysqli_fetch_assoc($result_todas)) {
                            $titulo = htmlspecialchars($row['titulo']);
                            $estado = $row['estado'];
                            $checked = $estado ? "checked" : "";
                            echo "<div class='task-item'>
                                    <span>$titulo</span><input type='checkbox' $checked>
                                </div>";
                        }
                    } else {
                        echo "<div class='task-item'>
                                <span>Nenhuma tarefa</span>
                            </div>";
                    }
                    ?>
                    <div class="text-end mt-2">
                        <a href="/ProjetoIndividual/Pages/Tarefas/tarefas.php"><button class="btn btn-light btn-sm">Ver mais</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="baixo-dos-cards" class="container">
            <a href="/ProjetoIndividual/Pages/NovaTarefa/novaTarefa.php"><button id="new-task-bt" class="btn btn-secondary">+ Nova tarefa</button></a>
        </div>
    </div>
</div>