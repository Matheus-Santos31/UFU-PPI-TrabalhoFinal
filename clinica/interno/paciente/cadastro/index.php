<?php

require_once "../../../conexaoMysql.php";
require_once "../../../login/autenticacao.php";

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
                        <a class="nav-link" href="../../">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../funcionario/cadastro/">Novo Funcionário</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Novo Paciente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../funcionario/listar/">Listar Funcionários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../listar/">Listar Pacientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../endereco/listar/">Listar Endereços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../agendamento/listar/">Listar Agendamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../meu_agendamento/listar/">Listar meus Agendamentos</a>
                    </li>
                </ul>
                <a href="../../../logout" class="d-flex">
                    <button class="btn btn-primary" type="submit">Logout</button>
                </a>
            </div>
        </div>
    </nav>
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<main class="container mt-4 col-sm-12 d-flex justify-content-center">
    <section>
        <h2>Cadastro de Paciente</h2>
            <form action="action.php" method="post" class="row g-2">
                <div class="col-sm-6 mb-2 form-floating">
                    <input type="text" id="nome" name="nome" class="form-control" placeholder=" ">
                    <label for="nome">Nome</label>
                </div>
                <div class="col-sm-6 mb-2 form-floating">
                    <input type="email" name="email" id="email" class="form-control" placeholder=" ">
                    <label for="email">Email</label>
                </div>
                <div class="col-sm-4 mb-2 form-floating">
                    <input type="telefone" name="telefone" id="telefone" class="form-control" placeholder=" ">
                    <label for="telefone">Telefone</label>
                </div>
                <div class="col-sm-2 mb-2 form-floating">
                    <input type="text" id="sexo" name="sexo" class="form-control" placeholder=" ">
                    <label for="sexo">Sexo</label>
                </div>
                <div class="col-sm-2 mb-2 form-floating">
                    <input type="text" id="cep" name="cep" class="form-control" placeholder=" ">
                    <label for="cep">CEP</label>
                </div>
                <div class="col-sm-4 mb-2 form-floating">
                    <input type="text"  id="cidade" name="cidade" class="form-control" placeholder=" ">
                    <label for="cidade">Cidade</label>
                </div>
                <div class="col-sm-8 mb-2 form-floating">
                    <input type="text" id="end" name="end" class="form-control" placeholder=" ">
                    <label for="end">Logradouro</label>
                </div>
                <div class="col-sm-4 mb-2 form-floating">
                    <select class="form-select" id="estado" name="estado" placeholder=" ">
                        <option selected></option>
                        <option>MG</option>
                        <option>SP</option>
                        <option>RJ</option>
                        <option>BA</option>
                    </select>
                    <label for="estado">Estado</label>
                </div>
                <div class="col-sm-4 mb-2 form-floating">
                    <input type="text" id="peso" name="peso" class="form-control" placeholder=" ">
                    <label for="peso">Peso</label>
                </div>
                <div class="col-sm-4 mb-2 form-floating">
                    <input type="text" id="altura" name="altura" class="form-control" placeholder=" ">
                    <label for="altura">Altura</label>
                </div>
                <div class="col-sm-4 mb-2 form-floating">
                    <select class="form-select" id="tipoSanguineo" name="tipoSanguineo" placeholder=" ">
                        <option selected></option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>O+</option>
                        <option>O-</option>
                    </select>
                    <label for="tipoSanguineo">Tipo Sanguíneo</label>
                </div>
                <div class="col-md-12 mb-2">
                    <button type="submit" class="btn btn-primary">
                        Cadastrar 
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF"><path d="M0 0h24v24H0z" fill="none"/><path d="M18 7l-1.41-1.41-6.34 6.34 1.41 1.41L18 7zm4.24-1.41L11.66 16.17 7.48 12l-1.41 1.41L11.66 19l12-12-1.42-1.41zM.41 13.41L6 19l1.41-1.41L1.83 12 .41 13.41z"/></svg>
                    </button>
                </div>
            </form>
    </section>
</main>
</body>
</html>