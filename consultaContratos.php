<?php
$nomeServidor = "localhost";
$nomeUsuario  = "root";
$senha        = "";
$nomeDb       = "sistemaDeContratos";

$conn = new mysqli($nomeServidor, $nomeUsuario, $senha, $nomeDb);
if ($conn->connect_error) {
  die("Conexao com DB falhou: " . $conn->connect_error);
}

$sql = "SELECT b.nome, c.verba, ct.codigo, ct.data_inclusao, ct.valor, ct.prazo
        FROM Tb_contrato AS ct, Tb_banco AS b, Tb_convenio AS c, Tb_convenio_servico AS cs
        WHERE c.banco = b.codigo AND ct.convenio_servico = cs.codigo AND cs.convenio = c.codigo";
$retorno = $conn->query($sql);

if ($retorno->num_rows > 0) {

  while ($registro = $retorno->fetch_assoc()) {

    $dataInclusao = new DateTime($registro["data_inclusao"]);
    $dataPrazo = new DateTime($registro["prazo"]);

    echo "---> Nome Banco: " . $registro["nome"] . 
         " | Verba R$: " . number_format($registro["verba"], 2, ',', '.') . 
         " | Codigo do contrato: " . $registro["codigo"] . 
         " | Data Inclusao: " . $dataInclusao->format('d/m/Y H:i:s') . 
         " | Valor R$: " . number_format($registro["valor"], 2, ',', '.') . 
         " | Prazo: " . $dataPrazo->format('d/m/Y') . "\n\n";
  }
} else {
  echo "Nao foram encontrados contratos!";
}

$conn->close();
?>
