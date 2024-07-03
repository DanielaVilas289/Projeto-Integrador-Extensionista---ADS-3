<?php

// caso não tenha sido passado o id pela URL, redireciona para a página inicial
if (!isset($_GET['id'])) {
    header('Location: /');
    exit(); 
}

require_once('db.php');

// query para buscar o professor associado ao id
$sql = "SELECT * FROM professores WHERE id = $_GET[id]";
$query = $conn->query($sql);

// quando o id não existe no banco de dados, redireciona para a página inicial
if ($query->num_rows === 0) {
    header('Location: /');
    exit();
}

$professor = $query->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professores</title>

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/professor.css">
</head>
<body>
    <main>
        <h1>Professor</h1>
        <div class="container">
            <div class="menu">
                <div class="menu-esquerda">
                    <a href="/">Voltar</a>
                </div>
                <div class="menu-direita">
                    <a class="destacar" href="/editar.php?id=<?php echo $professor['id']; ?>">Editar</a>
                    <form method="post" action="excluir.php" onsubmit="confirmarExclusao(event)">
                        <input type="hidden" name="id" value="<?php echo $professor['id']; ?>" />
                        <button class="destacar">Excluir</button>
                    </form>
                </div>
            </div>

            <div class="dados">
                <table>
                    <colgroup>
                        <col span="1" />
                        <col span="1" />
                    </colgroup>
                    <tr>
                        <td>Nome</td>
                        <td><?php echo $professor['nome'] ?></td>
                    </tr>
                    <tr>
                        <td>CPF</td>
                        <td><?php echo $professor['cpf'] ?></td>
                    </tr>
                    <tr>
                        <td>Endereço</td>
                        <td><?php echo $professor['endereco'] ?></td>
                    </tr>
                    <tr>
                        <td>Telefone</td>
                        <td><?php echo $professor['telefone'] ?></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td><?php echo $professor['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Formação</td>
                        <td><?php echo $professor['formacao'] ?></td>
                    </tr>
                    <tr>
                        <td>Especialidade</td>
                        <td><?php echo $professor['especialidade'] ?></td>
                    </tr>
                    <tr>
                        <td>Experiência</td>
                        <td><?php echo $professor['experiencia'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </main>
    <script src="js/professor.js"></script>
</body>
</html>