<div class="container">
    <form class="form-login" id="loginForm" action="/ProjetoIndividual/DB/logar.php" method="POST">
        <div class="form-group">
            <label for="usuario">Nome de usuário</label><br>
            <input class="form-control" type="text" name="usuario" id="usuario">
        </div>
        <div class="form-group">
            <label for="senha">Senha</label><br>
            <input class="form-control" type="password" name="senha" id="senha">
        </div>
        <br>
        <div class="group-bt">
            <button class="login-bt" type="submit">Entrar</button>
            <button class="login-bt" type="reset">Limpar</button>
        </div>
    </form>
</div>
<script src="/ProjetoIndividual/Pages/Login/login.js"></script>