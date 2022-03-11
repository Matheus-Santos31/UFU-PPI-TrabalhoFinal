<?php

require_once "../conexaoMysql.php";
require_once "../login/autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Clínica Biazonne, atendimento diferenciado.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Clínica</title>
    <style>
        body {
            font-family: Helvetica Neue, sans-serif;
            margin: 0;
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
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./funcionario/cadastro/index.html">Novo Funcionário</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./paciente/cadastro/index.html">Novo Paciente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="endereco">Listar Funcionários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="agendamento">Listar Pacientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="agendamento">Listar Endereços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="agendamento">Listar Agendamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="agendamento">Listar meus Agendamentos</a>
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
        crossorigin="anonymous"></script>
<main>
    <section>
        <h2>Informações da Clínica</h2>
        <p>Focada no bem-estar do cliente, nossa clínica foca principalmente em conforto, confiabilidade e flexibilidade,
            tanto em horários quanto nas formas de pagamento.
        </p>
        <p>Contando com diversos profissionais da área, cada um com sua especialização, para podermos
            resolver todo e qualquer problema, que você nosso paciente tiver.
        </p>
    </section>
</main>
</body>
</html>