<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="tema/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="tema/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="tema/admin/dist/css/adminlte.min.css">
  <script>
    function validarSenhas(event) {
      const senha = document.getElementById('senha').value;
      const confirmarSenha = document.getElementById('confirmar_senha').value;

      if (senha !== confirmarSenha) {
        alert('As senhas não coincidem.');
        event.preventDefault(); // Impede o envio do formulário
      }
    }
  </script>
  <style>
    .centralizar {
      text-align: center;
    }
  </style>
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a class="h1">
          <b>Cadastro</b>
          <br>
          <b>de<b />
            </br>
            <b>Usuário<b>
        </a>
      </div>
      <div class="card-body">
        <?php
        if (isset($_GET['message'])) {
          switch ($_GET['typeMessage']) {
            case 'sucess':
              ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
                <?= $_GET['message'] ?>
              </div>
              <?php
              break;
            case 'warning':
              ?>
              <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Aviso!</h5>
                <?= $_GET['message'] ?>
              </div>
              <?php
              break;
            case 'error':
              ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Erro!</h5>
                <?= $_GET['message'] ?>
              </div>
              <?php
              break;


          }
        }
        ?>
        <p class="login-box-msg">Registre-se como novo usuário</p>

        <form action="index.php?c=usuario&a=cadastro" method="post" onsubmit="validarSenhas(event)">
          <div class="input-group mb-3">
            <input type="text" name="nome" class="form-control" placeholder="Digite seu Nome Completo" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Digite seu Email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="telefone" name="telefone" class="form-control" placeholder="Digite seu Telefone" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua Senha">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="confirmar_senha" name="confirmar_senha" class="form-control"
              placeholder="Confirmar Senha">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <!-- Centralize this div -->
          <div class="d-flex justify-content-center">
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block">Registrar</button>
            </div>
          </div>
          <a href="index.php" class="text-center d-block mt-2">
              <b>Já tenho Conta</b>
            </a>
          <!-- /.col -->
      </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="tema/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="tema/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="tema/admin/dist/js/adminlte.min.js"></script>
</body>

</html>