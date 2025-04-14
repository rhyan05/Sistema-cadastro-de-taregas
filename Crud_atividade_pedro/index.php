<?php
require 'connect.php';
$banco = new Banco();
$conexao = $banco->conectar();

// Consulta com JOIN para pegar os nomes dos responsáveis e estações
$sql = "SELECT t.*, r.NomeResponsavel, e.NomeEstacao 
        FROM tarefa t
        LEFT JOIN responsavel r ON t.idResponsavel = r.idResponsavel
        LEFT JOIN estacao e ON t.idEstacao = e.idEstacao";
$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas Eco</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #007BFF;
            color: #fff;
            margin: 0;
        }

        .container {
            width: 95%;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Estilização da Tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        table th {
            background-color: #007BFF;
            color: #fff;
        }

        table tr:hover {
            background-color: #f0f0f0;
        }

        button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        button.delete {
            background-color: #dc3545;
        }

        button.delete:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <h1>Lista de Tarefas No Ecossistema</h1>
    <div class="container">
        <a href="cadastro.php">Adicionar uma nova Tarefa no Eco</a>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Título Tarefa</th>
                    <th>Descrição Tarefa</th>
                    <th>Responsável</th>
                    <th>Data Início</th>
                    <th>Data Entrega</th>
                    <th>Status</th>
                    <th>Estação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($Tarefa = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $Tarefa['TituloTarefa']; ?></td>
                        <td><?php echo $Tarefa['Descricao']; ?></td>
                        <td><?php echo $Tarefa['NomeResponsavel']; ?></td> <!-- Nome do Responsável -->
                        <td><?php echo $Tarefa['DataInicio']; ?></td>
                        <td><?php echo $Tarefa['DataEntrega']; ?></td>
                        <td><?php echo $Tarefa['StatusTarefas']; ?></td>
                        <td><?php echo $Tarefa['NomeEstacao']; ?></td> <!-- Nome da Estação -->
                        <td>
                            <a href="update.php?id=<?php echo $Tarefa['idTarefa']; ?>">
                                <button>Editar</button>
                            </a>
                            <a href="delete.php?id=<?php echo $Tarefa['idTarefa']; ?>">
                                <button class="delete">Excluir</button>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php mysqli_close($conexao); ?>
    </div>
</body>

</html>
