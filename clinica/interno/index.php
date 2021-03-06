<?php

require_once "../conexaoMysql.php";
require_once "../login/autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

try {
    $emailUsuario = $_SESSION["emailUsuario"];
    $sqlMed = <<<SQL
    SELECT pe.nome, pe.sexo, pe.email, pe.telefone, pe.cep, pe.logradouro, 
      pe.cidade, pe.estado, fu.dataContrato, fu.salario, me.especialidade, me.crm
    FROM Funcionario fu 
    INNER JOIN Pessoa pe 
    on fu.id = pe.id 
    INNER JOIN Medico me on fu.id = me.id
    WHERE pe.email = ?
    SQL;
    $stmtMed = $pdo->prepare($sqlMed);
    $stmtMed->execute([$emailUsuario]);
  }
  catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
  }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Clínica Biazonne, atendimento diferenciado.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Clínica - Home</title>
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="./global.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="logo">
                <a class="navbar-brand d-flex text-align-bottom logoIcone" href="#">
                    <img src="../image/logo2.png">
                </a>
                <a class="navbar-brand marca" href="#">Biazonne</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./funcionario/cadastro/">Novo Funcionário</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./paciente/cadastro/">Novo Paciente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./funcionario/listar/">Listar Funcionários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./paciente/listar/">Listar Pacientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./endereco/listar/">Listar Endereços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./agendamento/listar/">Listar Agendamentos</a>
                    </li>
                    <li class="nav-item" style="display: none" id="meus_agendamentos">
                        <a class="nav-link" href="./meu_agendamento/listar/">Listar meus Agendamentos</a>
                    </li>
                </ul>
                <a href="../logout" class="d-flex text-decoration-none">
                    <button class="btn btn-primary" type="submit">Logout</button>
                </a>
            </div>
        </div>
    </nav>
</header>
    <div class="sub-Nav">
    </div>
    <div class="spacing"></div>
    <div class="bg-image"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <main class="container text-content">
        <section class="row mt-3">
            <h2>Informações da Clínica</h2>
            <p>Focada no bem-estar do cliente, nossa clínica foca principalmente em conforto, confiabilidade e
                flexibilidade,
                tanto em horários quanto nas formas de pagamento.
            </p>
            <p>Contando com diversos profissionais da área, cada um com sua especialização, para podermos
                resolver todo e qualquer problema, que você nosso paciente tiver.
            </p>
        </section>
        <section class="row">
            <h2>Valores</h2>
            <ul>
                <li> Ética, credibilidade, confiança
                    <br>
                    Atuar com base nos mais elevados princípios éticos e morais de justiça, honestidade, humildade e
                    transparência.
                </li>
                <li>
                    Foco estratégico no paciente
                    <br>
                    Atender as necessidades dos pacientes utilizando as melhores práticas e soluções médicas.
                </li>
                <li> Inovação e excelência <br>
                    Buscar soluções inovadoras e criativas para todas as dimensões do nosso negócio, visando atender as
                    necessidades e superar as expectativas dos pacientes e demais partes interessadas quanto aos
                    processos e
                    serviços.
                </li>
            </ul>
        </section>
        <section class="row">
            <div>
                <img class="img-thumbnail" src="../galeria/images/Clinica2.jpg">
            </div>
        </section>
    </main>
    <footer class="d-flex justify-content-center copyRight">&copy; Copyright 2022 - Todos os direitos reservados</footer>
<?php
    $rowMed = $stmtMed->fetch();
    if($rowMed['especialidade'] != null){
        echo <<<HTML
            <script>
                window.onload = function () {
                    const navMeusAgendamentos = document.getElementById('meus_agendamentos');
                    navMeusAgendamentos.style.display = 'block';
                }
            </script>
        HTML;
    }
?>
</body>
</html>