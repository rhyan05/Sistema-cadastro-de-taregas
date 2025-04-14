<?php
require 'connect.php';

// Verificar se o ID foi passado via URL
if (isset($_GET['id'])) {
    $idTarefa = $_GET['id'];

    $banco = new Banco();
    $conexao = $banco->conectar();

    $sql = "SELECT * FROM tarefa WHERE idTarefa = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $idTarefa);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($Tarefa = $result->fetch_assoc()) {
        $titulo = $Tarefa['TituloTarefa'];
        $descricao = $Tarefa['Descricao'];
        $dataInicio = $Tarefa['DataInicio'];
        $dataEntrega = $Tarefa['DataEntrega'];
        $status = $Tarefa['StatusTarefas'];
        $idResponsavel = $Tarefa['idResponsavel'];
        $idEstacao = $Tarefa['idEstacao'];
    } else {
        echo "Tarefa não encontrada!";
        exit;
    }
    
    $sqlResponsaveis = "SELECT idResponsavel, NomeResponsavel FROM responsavel";
    $resultResponsaveis = mysqli_query($conexao, $sqlResponsaveis);
    
    $sqlEstacoes = "SELECT idEstacao, NomeEstacao FROM estacao";
    $resultEstacoes = mysqli_query($conexao, $sqlEstacoes);
} else {
    echo "ID da tarefa não fornecido!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $dataInicio = $_POST['dataInicio'];
    $dataEntrega = $_POST['dataEntrega'];
    $status = $_POST['status'];
    $idResponsavel = $_POST['idResponsavel'];
    $idEstacao = $_POST['idEstacao'];

    $sqlUpdate = "UPDATE tarefa SET TituloTarefa = ?, Descricao = ?, DataInicio = ?, DataEntrega = ?, StatusTarefas = ?, idResponsavel = ?, idEstacao = ? WHERE idTarefa = ?";
    $stmtUpdate = $conexao->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ssssssii", $titulo, $descricao, $dataInicio, $dataEntrega, $status, $idResponsavel, $idEstacao, $idTarefa);
    
    if ($stmtUpdate->execute()) {
        echo "Tarefa atualizada com sucesso!";
        header("Location: index.php"); // Redirecionar para a página principal ou listagem de tarefas
    } else {
        echo "Erro ao atualizar a tarefa.";
    }
    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Tarefa</title>
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
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

    .voltar-btn {
        padding: 10px 20px;
        background-color: #dc3545;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        display: inline-block;
        margin-top: 10px;
    }

    .voltar-btn:hover {
        background-color: #c82333;
    }

    .update-btn {
        background-color: #28a745; 
        padding: 10px 20px;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .update-btn:hover {
        background-color: #218838; 
    }

    </style>
</head>

<body>
    <h1>Atualizar Tarefa</h1>
    <div class="container">
        <form action="" method="POST">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>" required>

            <label for="descricao">Descrição</label>
            <input type="text" id="descricao" name="descricao" value="<?php echo $descricao; ?>" required>

            <label for="dataInicio">Data Início</label>
            <input type="date" id="dataInicio" name="dataInicio" value="<?php echo $dataInicio; ?>" required>

            <label for="dataEntrega">Data Entrega</label>
            <input type="date" id="dataEntrega" name="dataEntrega" value="<?php echo $dataEntrega; ?>" required>

            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="Pendente" <?php echo ($status == 'Pendente') ? 'selected' : ''; ?>>Pendente</option>
                <option value="Concluída" <?php echo ($status == 'Concluída') ? 'selected' : ''; ?>>Concluída</option>
                <option value="Em andamento" <?php echo ($status == 'Em andamento') ? 'selected' : ''; ?>>Em andamento</option>
            </select>

            <label for="idResponsavel">Responsável</label>
            <select id="idResponsavel" name="idResponsavel" required>
                <?php while ($responsavel = mysqli_fetch_assoc($resultResponsaveis)): ?>
                    <option value="<?php echo $responsavel['idResponsavel']; ?>" <?php echo ($responsavel['idResponsavel'] == $idResponsavel) ? 'selected' : ''; ?>>
                        <?php echo $responsavel['NomeResponsavel']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="idEstacao">Estação</label>
            <select id="idEstacao" name="idEstacao" required>
                <?php while ($estacao = mysqli_fetch_assoc($resultEstacoes)): ?>
                    <option value="<?php echo $estacao['idEstacao']; ?>" <?php echo ($estacao['idEstacao'] == $idEstacao) ? 'selected' : ''; ?>>
                        <?php echo $estacao['NomeEstacao']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit" class="botao update-btn">Atualizar Tarefa</button>
            <a href="./index.php" class="voltar-btn">Voltar</a>

        </form>
    </div>
</body>

</html>
