<?php

require_once "../../../conexaoMysql.php";
require_once "../../../login/autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

try {

  $sql = <<<SQL
    SELECT ad.data, ag.horario, ag.nome, ag.sexo, ag.email, pe.nome FROM Agenda ag INNER JOIN Pessoa pe on ag.medico_id = pe.id
  SQL;
  $stmt = $pdo->query($sql);
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lista de Agendamentos</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    body {
        font-family: Helvetica Neue, sans-serif;
        margin: 0;
    }

    img {
      width: 15px;
      height: 15px;
    }

  </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Biazonne</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="../../">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../funcionario/cadastro/">Novo Funcionário</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../paciente/cadastro/">Novo Paciente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../funcionario/listar/">Listar Funcionários</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../paciente/listar/">Listar Pacientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../endereco/listar/">Listar Endereços</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Listar Agendamentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../meu_agendamento/listar">Listar meus Agendamentos</a>
                        </li>
                    </ul>
                    <a href="../logout" class="d-flex">
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous">
    </script>
    <main class="container mt-4 col-sm-12 d-flex justify-content-center">

    <section>
        <h3>Agendamentos</h3>
        <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>Data</th>
            <th>Horário</th>
            <th>Paciente</th>
            <th>Sexo</th>
            <th>Email</th>
            <th>Médico</th>
        </tr>

        <?php
        while ($row = $stmt->fetch()) {

            $data = htmlspecialchars($row['data']);
            $horario = htmlspecialchars($row['horario']);
            $paciente = htmlspecialchars($row['nome']);
            $sexo = htmlspecialchars($row['sexo']);
            $email = htmlspecialchars($row['email']);
            $medico = htmlspecialchars($row['nome']);     

            echo <<<HTML
            <tr>
                <td>
                <a href="Ex01-exclui-cliente.php?cpf=$cpf">
                <img src="images/delete.png"></a>
                </td> 
                <td>$data</td>
                <td>$horario horas</td>
                <td>$paciente</td>
                <td>$sexo</td>
                <td>$email</td>
                <td>$medico</td>
            </tr>
            HTML;

        }
        ?>

        </table>
        <a href="../../">Menu de opções</a>
    </section>

</body>

</html>