<?php
$nomeServidor = "localhost";
$nomeUsuario  = "root";
$senha        = "0wR79!G$22D#";
$nomeDb       = "sistemaDeContratos";

$conn = new mysqli($nomeServidor, $nomeUsuario, $senha, $nomeDb);
if ($conn->connect_error) {
  die("Conexao com DB falhou: " . $conn->connect_error);
}

$sql = "SELECT b.nome AS nomeBanco, c.verba AS verba, MIN(ct.data_inclusao) AS dataInclusaoAntigo, MAX(ct.data_inclusao) AS dataInclusaoRecente, SUM(ct.valor) AS somaValor 
        FROM Tb_banco AS b 
        JOIN Tb_convenio AS c ON b.codigo = c.banco 
        JOIN Tb_convenio_servico AS cs ON c.codigo = cs.convenio 
        JOIN Tb_contrato AS ct ON cs.codigo = ct.convenio_servico 
        GROUP BY b.nome, c.verba";
$retorno = $conn->query($sql);

if (isset($retorno->num_rows) && $retorno->num_rows > 0) {

  while ($registro = $retorno->fetch_assoc()) {

    $dataInclusaoAntigo  = new DateTime($registro["dataInclusaoAntigo"]);
    $dataInclusaoRecente = new DateTime($registro["dataInclusaoRecente"]);

    echo "\n---> Nome Banco: " . $registro["nomeBanco"] . 
         " | Verba R$: " . number_format($registro["verba"], 2, ',', '.') . 
         " | Data Inclusao contrato mais antigo: " . $dataInclusaoAntigo->format('d/m/Y H:i:s') . 
         " | Data Inclusao contrato mais recente: " . $dataInclusaoRecente->format('d/m/Y H:i:s') . 
         " | Soma do Valor dos contratos R$: " . number_format($registro["somaValor"], 2, ',', '.') . "\n\n";
  }
} else {
  echo "Nao foram encontrados registros!\n";
}

$conn->close();
?>