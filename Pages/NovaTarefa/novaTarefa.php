<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: /ProjetoIndividual/index.php");
    exit;
}

include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/includes/cabecalho.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/DB/database.php");

$titulo = "";
$descricao = "";
$estado = "0";
$idtarefa = "";

// Verifica se é uma edição
if (isset($_GET['id'])) {
    $idtarefa = $_GET['id'];
    $idusuario = $_SESSION['idusuario'];
    
    // Busca os dados da tarefa
    $sql = "SELECT * FROM tarefa WHERE idtarefa = $idtarefa AND idusuario = $idusuario";
    $result = mysqli_query($conexao, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $tarefa = mysqli_fetch_assoc($result);
        $titulo = htmlspecialchars($tarefa['titulo']);
        $descricao = htmlspecialchars($tarefa['descricao']);
        $estado = $tarefa['estado'];
    }
}
?>

<h1 align='center'><?php echo isset($_GET['id']) ? 'Editar Tarefa' : 'Nova Tarefa'; ?></h1><br><br>

<div class="container form-container">
    <form id="tarefaForm" action="/ProjetoIndividual/DB/manipularTarefa.php" method="POST">
        <?php if ($idtarefa): ?>
            <input type="hidden" name="idtarefa" value="<?php echo $idtarefa; ?>">
        <?php endif; ?>
        
        <div class="form-left">
            <label for="titulo">Título</label>
            <hr>
            <input type="text" id="titulo" name="titulo" placeholder="Título..." value="<?php echo $titulo; ?>">

            <label for="descricao">Descrição</label>
            <hr>
            <textarea id="descricao" name="descricao" placeholder="Descrição..."><?php echo $descricao; ?></textarea>
        </div>

        <div class="form-right">
            <label>Estado</label>
            <hr>
            <div class="estado-options">
                <div>
                    <input type="radio" id="naoConcluida" name="estado" value="0" <?php echo $estado == "0" ? "checked" : ""; ?>>
                    <label for="naoConcluida">Não Concluída</label>
                </div>
                <div>
                    <input type="radio" id="concluida" name="estado" value="1" <?php echo $estado == "1" ? "checked" : ""; ?>>
                    <label for="concluida">Concluída</label>
                </div>
            </div>

            <button type="submit" class="btn-salvar">Salvar</button>
        </div>
    </form>
</div>