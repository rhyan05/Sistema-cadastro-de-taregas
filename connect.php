<?php
define("SERVER", "localhost");
define("USER", "root");
define("SENHA", "");
define("DATABASE", "pedro_atividade");

class Banco
{
    public function conectar()
    {

        $conexao = mysqli_connect(SERVER, USER, SENHA, DATABASE);

        if (mysqli_connect_errno()) {
            die("Falha ao conectar ao banco de dados: " . mysqli_connect_error());
        }
        mysqli_set_charset($conexao, "utf8");
        return $conexao;
    }
}

// Para testar, basta instanciar a classe e chamar o método.
$banco = new Banco();
$conexao = $banco->conectar();

if ($conexao) {
    echo "Conexão realizada com sucesso!";
}
