<?php

// define os parâmetros para a conexão com o banco de dados
// alterar conforme as configurações do MySQL instalado na máquina
define('HOST', 'localhost');  
define('USERNAME', 'root');
define('PASSWORD', '123456');
define('DATABASE', 'projeto');

$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

if (!$conn) {
    die('Falha na conexão com o banco de dados: ' . mysqli_connect_error());
}