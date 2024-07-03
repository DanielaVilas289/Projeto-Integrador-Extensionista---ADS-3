<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once('db.php');

    // query para inserir um novo professor ao banco de dados
    $sql = "
        INSERT INTO professores(
            nome,
            cpf,
            endereco,
            telefone,
            email,
            formacao,
            especialidade,
            experiencia
        )
        VALUES (
            '$_POST[nome]',
            '$_POST[cpf]',
            '$_POST[endereco]',
            '$_POST[telefone]',
            '$_POST[email]',
            '$_POST[formacao]',
            '$_POST[especialidade]',
            '$_POST[experiencia]'
        )
    ";
    $query = $conn->query($sql);
    
    if (!$query) {
        die('Falha ao cadastrar professor: ' . $conn->error);
    }

    // pega o id do professor que foi cadastrado
    $id = $conn->insert_id;
    
    // redireciona o cliente para a página do professor que foi cadastrado
    header("Location: /professor.php?id=$id");
    exit();
}

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
        <h1>Cadastrar Professor</h1>
        <div class="container">
            <div class="menu">
                <div class="menu-esquerda">
                    <a href="/">Voltar</a>
                </div>
                <div class="menu-direita">
                    <label for="submit-form"><span class="destacar">Cadastrar</span></label>
                    <a href="/">Cancelar</a>
                </div>
            </div>

            <form class="dados" method="post">
                <table>
                    <colgroup>
                        <col span="1" />
                        <col span="1" />
                    </colgroup>
                    <tr>
                        <td>Nome</td>
                        <td><input name="nome" maxlength="120" required /></td>
                    </tr>
                    <tr>
                        <td>CPF</td>
                        <td><input name="cpf" maxlength="14" required /></td>
                    </tr>
                    <tr>
                        <td>Endereço</td>
                        <td><input name="endereco" maxlength="120" required /></td>
                    </tr>
                    <tr>
                        <td>Telefone</td>
                        <td><input name="telefone" maxlength="100" required /></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td><input name="email" type="email" maxlength="100" required /></td>
                    </tr>
                    <tr>
                        <td>Formação</td>
                        <td><input name="formacao" maxlength="50" required /></td>
                    </tr>
                    <tr>
                        <td>Especialidade</td>
                        <td>
                            <select name="especialidade" required>
                                <option value="">Selecione uma especialidade</option>
                                <option value="Artes">Artes</option>
                                <option value="Biologia">Biologia</option>
                                <option value="Educação Física">Educação Física</option>
                                <option value="Filosofia">Filosofia</option>
                                <option value="Física">Física</option>
                                <option value="Geografia">Geografia</option>
                                <option value="História">História</option>
                                <option value="Inglês">Inglês</option>
                                <option value="Matemática">Matemática</option>
                                <option value="Português">Português</option>
                                <option value="Química">Química</option>
                                <option value="Sociologia">Sociologia</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Experiência</td>
                        <td><textarea name="experiencia" rows="5" maxlength="512" required></textarea></td>
                    </tr>
                </table>
                <input type="submit" id="submit-form" class="hidden" />
            </form>
        </div>
    </main>
</body>
</html>