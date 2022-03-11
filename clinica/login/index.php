<?php

function checkLogin($pdo, $email, $senha)
{
  $sql = <<<SQL
    SELECT a.senhaHash
    FROM Pessoa p
    inner join
    Funcionario a
    on a.id = p.id
    WHERE email = ?
    SQL;

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch();
    if (!$row) return false; // nenhum resultado (email não encontrado)

    return password_verify($senha, $row['senhaHash']);
  } catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

$errorMsg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  require "../conexaoMysql.php";
  $pdo = mysqlConnect();

  $email = $_POST["email"] ?? "";
  $senha = $_POST["senha"] ?? "";

  if (checkLogin($pdo, $email, $senha)) {
    header("location: ../interno");
    exit();
  } else
    $errorMsg = "Dados incorretos";
}

?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clínica - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    body {
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      background-image: url("../galeria/images/bg1.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      margin: 0;
      padding: 0;
    }

    main {
      padding: 3rem;
      padding-top: 2rem;
      width: 60%;
      border: 0.5px solid lightgray;
      border-radius: 5px;
      background-color: #fff;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    form {
      margin-bottom: 2rem;
    }

    main>h3 {
      text-align: center;
      color: #222;
      margin-bottom: 2rem;
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
              <a class="nav-link" href="../#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../galeria">Galeria</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../endereco">Novo Endereço</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../agendamento">Agendamento</a>
            </li>
          </ul>
          <a href="#" class="d-flex">
            <button class="btn btn-primary" type="submit">Login</button>
          </a>
        </div>
      </div>
    </nav>
  </header>
  <div class="container">
    <main>
      <h3>Efetue login</h3>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="row g-3">
        <div class="col-sm-12">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" name="email" class="form-control" id="email">
        </div>
        <div class="col-sm-12">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" name="senha" class="form-control" id="senha">
        </div>
        <div class="col-sm-12 d-grid">
          <button type="submit" class="btn btn-primary btn-block">Entrar</button>
        </div>
      </form>

      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST" && $errorMsg !== "") {
        echo <<<HTML
        <div class="alert alert-warning alert-dismissible" role="alert">
          <strong>$errorMsg</strong>
          <button type="button" class="btn-close" data-dismiss="alert"></button>
        </div>
        HTML;
      }
      ?>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>