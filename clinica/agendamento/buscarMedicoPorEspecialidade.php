<?php
require "../conexaoMysql.php";
$pdo = mysqlConnect();

$especialidade = $_GET["especialidade"] ?? "";

try {

    $sql = <<<SQL
      SELECT p.nome 
      FROM Medico m
      inner join
      Pessoa p
      on m.id = p.id
      WHERE especialidade = ?
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$especialidade]);

    $medicos = [];
    while ($row = $stmt->fetch()) {
        $medico = htmlspecialchars($row['nome']);
        array_push($medicos, $medico);
    }
    echo json_encode($medicos);
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
