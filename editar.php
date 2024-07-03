<?php

require_once('db.php');

// requisições de alteração, enviadas quando o usuário clica no botão "Salvar",
// são processadas no bloco abaixo
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $sql = "
        UPDATE professores 
        SET nome = '$_POST[nome]',
            cpf = '$_POST[cpf]',
            endereco = '$_POST[endereco]',
            telefone = '$_POST[telefone]',
            email = '$_POST[email]',
            formacao = '$_POST[formacao]',
            especialidade = '$_POST[especialidade]',
            experiencia = '$_POST[experiencia]'
        WHERE id = $_POST[id]
    ";
    $query = $conn->query($sql);

    if (!$query) {
        die('Falha ao editar professor: ' . $conn->error);
    }

    // após salvar as alterações nos dados do professor no banco de dados,
    // redireciona o cliente para a página de visualização do professor
    header("Location: /professor.php?id=$_POST[id]");
    exit();
}

// caso a URL não possua o parâmetro com o id, redireciona para a página inicial
if (!isset($_GET['id'])) {
    header('Location: /');
    exit();
}

$sql = "SELECT * FROM professores WHERE id = $_GET[id]";
$query = $conn->query($sql);

// quando o id não existe, redireciona o cliente para a página inicial
if ($query->num_rows === 0) {
    header('Location: /');
    exit();
}

$professor = $query->fetch_assoc();

// define um array com as opções de especialidades possíveis
$especialidades = [
    "Português",
    "Matemática",
    "História",
    "Geografia",
    "Artes",
    "Física",
    "Química",
    "Filosofia",
    "Sociologia",
    "Educação Física",
    "Biologia",
    "Inglês"
];

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
                    <a href="/professor.php?id=<?php echo $professor['id'] ?>">Voltar</a>
                </div>
                <div class="menu-direita">
                    <label for="submit-form"><span class="destacar">Salvar</span></label>
                    <a href="/professor.php?id=<?php echo $professor['id'] ?>">Cancelar</a>
                </div>
            </div>

            <form class="dados" method="post">
                <input type="hidden" name="id" value="<?php echo $professor['id']; ?>" />
                <table>
                    <colgroup>
                        <col span="1" />
                        <col span="1" />
                    </colgroup>
                    <tr>
                        <td>Nome</td>
                        <td><input name="nome" value="<?php echo $professor['nome'] ?>" maxlength="120" required /></td>
                    </tr>
                    <tr>
                        <td>CPF</td>
                        <td><input name="cpf" value="<?php echo $professor['cpf'] ?>" maxlength="11" required /></td>
                    </tr>
                    <tr>
                        <td>Endereço</td>
                        <td><input name="endereco" value="<?php echo $professor['endereco'] ?>" maxlength="120" required /></td>
                    </tr>
                    <tr>
                        <td>Telefone</td>
                        <td><input name="telefone" value="<?php echo $professor['telefone'] ?>" maxlength="100" required /></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td><input type="email" name="email" value="<?php echo $professor['email'] ?>" maxlength="100" required /></td>
                    </tr>
                    <tr>
                        <td>Formação</td>
                        <td><input name="formacao" value="<?php echo $professor['formacao'] ?>" maxlength="50" required /></td>
                    </tr>
                    <tr>
                        <td>Especialidade</td>
                        <td>
                            <select name="especialidade">
                                <?php foreach($especialidades as $especialidade): ?>
                                    <?php if ($especialidade === $professor['especialidade']): ?>
                                        <option value="<?php echo $especialidade; ?>" selected><?php echo $especialidade; ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $especialidade; ?>"><?php echo $especialidade; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Experiência</td>
                        <td>
                            <textarea name="experiencia" rows="5" maxlength="512" required><?php echo $professor['experiencia'] ?></textarea>
                        </td>
                    </tr>
                </table>
                <input type="submit" id="submit-form" class="hidden" />
            </form>
        </div>
    </main>
</body>
</html>