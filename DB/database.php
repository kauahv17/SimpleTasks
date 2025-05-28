<?php

//configurar a conexão
$host = "localhost";
$user = "root";
$password = "";
$database = "tarefas";

//abrir a conexão
$conexao =  mysqli_connect($host, $user, $password, $database);

//testar a conexão
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}
