<?php
include './connect.php'; // Inclui a classe de conexão

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $banco = new Banco();
    $conexao = $banco->conectar(); 

    if ($conexao) {
        $sql = "DELETE FROM tarefa WHERE idTarefa=?";  
        
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id); 

        if ($stmt->execute()) {
            echo '<script>alert("Registro excluído com sucesso!");</script>';
        } else {
            echo '<script>alert("Erro: ' . $stmt->error . '");</script>';
        }

        $stmt->close();
    }
    
    echo '<script>window.location.href = "./index.php";</script>';
}
?>
