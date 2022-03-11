<?php

require "../../../conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$cep = $_POST["cep"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$logradouro = $_POST["logradouro"] ?? "";
$estado = $_POST["estado"] ?? "";
$peso = $_POST["peso"] ?? "";
$altura = $_POST["altura"] ?? "";
$tipoSanguineo = $_POST["tipoSanguineo"] ?? "";

$hashsenha = password_hash($senha, PASSWORD_DEFAULT);

$sql1 = <<<SQL
    INSERT INTO Pessoa (
        nome, sexo, email, telefone, cep, logradouro, cidade, estado
    )
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    SQL;

$sql2 = <<<SQL
    INSERT INTO Funcionario (
        id, dataContrato, salario, senhaHash
    )
    VALUES(?, ?, ?, ?)
    SQL;

$sql3 = <<<SQL
    INSERT INTO Medico (
        id, especialidade, crm
    )
    VALUES(?, ?, ?)
    SQL;

try {
  $pdo->beginTransaction();
  
  $stmt1 = $pdo->prepare($sql1);
  if (!$stmt1->execute([
        $nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $estado
    ])) throw new Exception('Falha na primeira inserção');

  $idNovaPessoa = $pdo->lastInsertId();
  
  $stmt2 = $pdo->prepare($sql2);
  if(!$stmt2->execute([
        $idNovaPessoa, $dataInicio, $salario, $hashsenha
    ])) throw new Exception('Falha na segunda inserção');

  if($especialidade != "" && $crm != ""){
      $stmt3 = $pdo->prepare($sql3);
      if(!$stmt3->execute([
              $idNovaPessoa, $especialidade, $crm
          ])) throw new Exception('Falha na terceira inserção');

  };

  $pdo->commit();
  
  header("location: ../../");
  exit();
} 
catch (Exception $e) {  
  //error_log($e->getMessage(), 3, 'log.php');
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}