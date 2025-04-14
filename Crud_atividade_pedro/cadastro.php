<?php
require 'connect.php';
$banco = new Banco();
$conexao = $banco->conectar();

// Consulta para popular o campo "Responsável"
$sqlResponsavel = "SELECT idResponsavel, NomeResponsavel FROM responsavel";
$resultResponsavel = mysqli_query($conexao, $sqlResponsavel);

// Consulta para popular o campo "Estação"
$sqlEstacao = "SELECT idEstacao, NomeEstacao FROM estacao";
$resultEstacao = mysqli_query($conexao, $sqlEstacao);

// Verifica se o formulário foi enviado para processar os dados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $TituloTarefa = $_POST['TituloTarefa'];
    $DescricaoTarefa = $_POST['Descricao'];
    $DataInicio = $_POST['DataInicio'];
    $DataEntrega = $_POST['DataEntrega'];
    $StatusTarefa = $_POST['StatusTarefas'];
    $Responsavel = $_POST['responsavel'];
    $Estacao = $_POST['estacao'];

    // Debug para verificar os dados recebidos
    var_dump($Responsavel);
    var_dump($Estacao);

    // Prepara a SQL para inserção
    $sql = "INSERT INTO tarefa (TituloTarefa, Descricao, DataInicio, DataEntrega, StatusTarefas, idResponsavel, idEstacao) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepara o statement
    $stmt = mysqli_prepare($conexao, $sql);

    // Verifica se a preparação funcionou
    if ($stmt) {
        // Liga os parâmetros à consulta
        mysqli_stmt_bind_param($stmt, 'sssssii', $TituloTarefa, $DescricaoTarefa, $DataInicio, $DataEntrega, $StatusTarefa, $Responsavel, $Estacao);

        // Executa o statement
        if (mysqli_stmt_execute($stmt)) {
            // Redireciona para a página index.php após sucesso
            header("Location: index.php");
            exit(); // Não se esqueça de chamar exit() após o header para garantir que o script seja interrompido
        } else {
            echo "<script>alert('Erro ao cadastrar tarefa: " . mysqli_stmt_error($stmt) . "');</script>";
        }

        // Fecha o statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erro na preparação da consulta: " . mysqli_error($conexao) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Criar Tarefa</title>
    <style>
        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">Criar Nova Tarefa</h1>
    <form method="post" action="" enctype="multipart/form-data">

    <!-- Forms -->
        <label for="tituloTarefa">Título da Tarefa:</label>
        <input type="text" id="tituloTarefa" name="TituloTarefa" required>

        <label for="descricaoTarefa">Descrição da Tarefa:</label>
        <textarea id="descricaoTarefa" name="Descricao" rows="4" required></textarea>

        <label for="dataInicio">Data de Início:</label>
        <input type="date" id="dataInicio" name="DataInicio" required>

        <label for="dataEntrega">Data de Entrega:</label>
        <input type="date" id="dataEntrega" name="DataEntrega" required>

        <label for="statusTarefa">Status da Tarefa:</label>
        <select id="statusTarefa" name="StatusTarefas" required>
            <option value="pendente">Pendente</option>
            <option value="em andamento">Em Andamento</option>
            <option value="concluido">Concluído</option>
        </select>

        <label for="responsavel">Responsável:</label>
        <select id="responsavel" name="responsavel" required>
            <?php

                while ($row = mysqli_fetch_assoc($resultResponsavel)): ?>
                <option value="<?php echo $row['idResponsavel']; ?>">
                    <?php echo $row['NomeResponsavel']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="estacao">Estação:</label>
        <select id="estacao" name="estacao" required>
            <?php
            while ($row = mysqli_fetch_assoc($resultEstacao)): ?>
                <option value="<?php echo $row['idEstacao']; ?>">
                    <?php echo $row['NomeEstacao']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <a href="index.php">Home</a>
        <br>

        <input type="submit" value="Criar Tarefa">
    </form>
</body>

</html>
