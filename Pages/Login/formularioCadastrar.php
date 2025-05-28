<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/includes/cabecalho.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetoIndividual/DB/database.php");

?>
<h1 align='center'>Cadastre-se</h1><br><br>

<div class="container">
    <form class="form-login" id="registerForm" action="/ProjetoIndividual/DB/cadastrar.php" method="POST">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input class="form-control" type="text" name="nome" id="nome" required>
        </div>
        <div class="form-group">
            <label for="usuario">Apelido</label>
            <input class="form-control" type="text" name="usuario" id="usuario" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input class="form-control" type="password" name="senha" id="senha" required>
        </div>
        <br>
        <div class="group-bt">
            <button class="login-bt" type="submit">Cadastrar</button>
            <button class="login-bt" type="reset">Limpar</button>
            <button class="login-bt" type="cancel" onclick="javascript:window.location='/ProjetoIndividual/index.php'">Cancelar</button>
        </div>
    </form>
</div>
<script src="/ProjetoIndividual/Pages/Login/login.js"></script>