<?php

$pagina = 1;

// caso o número da página tenha sido passada pela URL,
// atualiza o valor da variável $pagina
if (isset($_GET['pagina'])) {
    $pagina = intval($_GET['pagina']);
}

require_once('db.php');

// query para obter o total de professores cadastrados
$sql = 'SELECT COUNT(*) as total FROM professores';
$query = $conn->query($sql);
$resultado = $query->fetch_assoc();
$total_de_professores = $resultado['total'];

// cálculo dos parâmetros que serão utilizados
$quantidade_por_pagina = 10;
$offset = $quantidade_por_pagina * ($pagina - 1);
$total_de_paginas = ceil($total_de_professores / $quantidade_por_pagina);
$primeiro_exibido = min($quantidade_por_pagina * ($pagina - 1) + 1, $total_de_professores);
$ultimo_exibido = min($quantidade_por_pagina * $pagina, $total_de_professores);

// query para obter os professores correspondentes à página definida anteriormente
$sql2 = "SELECT * FROM professores LIMIT $quantidade_por_pagina OFFSET $offset";
$query2 = $conn->query($sql2);
$professores = $query2->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professores</title>

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <main>
        <h1>Professores Cadastrados</h1>
        <div class="container">
            <div class="menu">
                <div class="menu-esquerda">
                    <a class="destacar" href="/cadastrar.php">Cadastrar</a>
                </div>
                <div class="menu-direita">
                    <?php echo $primeiro_exibido . '-' . $ultimo_exibido . ' de ' . $total_de_professores?>
                    <?php if ($pagina > 1): ?>
                    <a href="/?pagina=<?php echo $pagina - 1; ?>">Anterior</a>
                    <?php else: ?>
                    <span>Anterior</span>
                    <?php endif; ?>

                    <?php if ($pagina < $total_de_paginas): ?>
                    <a href="/?pagina=<?php echo $pagina + 1; ?>">Próximo</a>
                    <?php else: ?>
                    <span>Próximo</span>
                    <?php endif; ?>
                </div>
            </div>

            <div id="listagem">
                <table>
                    <colgroup>
                        <col class="id" span="1" />
                        <col class="nome" span="1" />
                        <col class="formacao" span="1" />
                        <col class="especialidade" span="1" />
                    </colgroup>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Formação</th>
                        <th>Especialidade</th>
                    </tr>
                    <?php foreach($professores as $professor): ?>
                    <tr>
                        <td>
                            <a href="/professor.php?id=<?php echo "$professor[id]"; ?>">
                                <?php echo "$professor[id]"; ?>
                            </a>
                        </td>
                        <td>
                            <a href="/professor.php?id=<?php echo "$professor[id]"; ?>">
                                <?php echo "$professor[nome]"; ?>
                            </a>
                        </td>
                        <td>
                            <a href="/professor.php?id=<?php echo "$professor[id]"; ?>">
                                <?php echo "$professor[formacao]"; ?>
                            </a>
                        </td>
                        <td>
                            <a href="/professor.php?id=<?php echo "$professor[id]"; ?>">
                                <?php echo "$professor[especialidade]"; ?>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </main>
</body>
</html>