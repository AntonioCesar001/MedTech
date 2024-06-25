<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedTech - Funcionário</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="tema/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="tema/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="tema/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="tema/admin/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="tema/admin/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="tema/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="tema/admin/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="tema/admin/plugins/summernote/summernote-bs4.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="tema/admin/css/styles.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php
    include_once ('tema/admin/includes/menulateral.php');
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Funcionário</a></li>
                            <li class="breadcrumb-item active">Cadastro</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="container mt-5">
                        <h1 class="text-center"> Funcionários </h1>
                        <div class="section-content">
                            <!-- Filtro de Pesquisa -->
                            <div class="form-group">
                                <label for="search-funcionario">Pesquisar</label>
                                <input type="text" class="form-control" id="search-funcionario"
                                    placeholder="Nome ou Especialidade">
                            </div>

                            <table class="table table-bordered" id="lista-funcionarios">
                                <thead>
                                    <tr>
                                        <th>Nome Completo</th>
                                        <th>Especialidade</th>
                                        <th>Carga Horária</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="lista-funcionarios">
                                    <!-- Dados dos funcionários serão carregados aqui -->
                                    <!-- Exemplo de um funcionário -->
                                    <?php
                                    if (isset($_SESSION['funcionario'])) {
                                        $a = $_SESSION['funcionario'];
                                        foreach ($a as $row) {
                                            $row = serialize($row);
                                            $row = unserialize($row);
                                            ?>
                                            <tr>
                                                <td><?php echo $row->nome; ?></td>
                                                <td><?php echo $row->especialidade; ?></td>
                                                <td><?php echo $row->cargaHoraria; ?></td>
                                                <td>
                                                    <button class="btn btn-info btn-sm"
                                                        onclick="visualizarFuncionario('Funcionário A')">Visualizar</button>
                                                    <button class="btn btn-warning btn-sm"
                                                        onclick="editarFuncionario('Funcionário A')">Editar</button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } ?>
                                </tbody>
                            </table>
                            
                            <button class="btn" data-toggle="modal" data-target="#funcionarioModal">Adicionar
                                Funcionário</button>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Modal para Cadastro de Funcionário -->
        <div class="modal fade" id="funcionarioModal" tabindex="-1" aria-labelledby="funcionarioModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="funcionarioModalLabel">Cadastrar Funcionário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="index.php?c=funcionario&a=cadastro" method="post" id="form-funcionario">
                            <div class="form-group">
                                <label for="nome_completo">Nome Completo</label>
                                <input type="text" class="form-control" id="nome_completo" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="especialidade">Especialidade</label>
                                <input type="text" class="form-control" id="especialidade" name="especialidade"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="matricula">Matrícula</label>
                                <input type="text" class="form-control" id="matricula" name="matricula" required>
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" required>
                            </div>
                            <div class="form-group">
                                <label for="carga_horaria">Carga Horária</label>
                                <input type="text" class="form-control" id="carga_horaria" name="cargaHoraria" required>
                            </div>
                            <button type="submit" class="btn">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2024 <a href="#">MedTech</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versão</b> 1.0.0
        </div>
    </footer>


    <script>
        document.getElementById('search-funcionario').addEventListener('keyup', function () {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#lista-funcionarios tbody tr');

            rows.forEach(row => {
                const nomeCompleto = row.cells[0].textContent.toLowerCase();
                const especialidade = row.cells[1].textContent.toLowerCase();
                if (nomeCompleto.includes(searchValue) || especialidade.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="tema/admin/dist/js/scripts.js"></script>
    <!-- jQuery -->
    <script src="tema/admin/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="tema/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="tema/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="tema/admin/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="tema/admin/plugins/sparklines/sparkline.js"></script>
    <!-- </div> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="tema/admin/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="tema/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="tema/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="tema/admin/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="tema/admin/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="tema/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="tema/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="tema/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="tema/admin/plugins/moment/moment.min.js"></script>
    <script src="tema/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="tema/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="tema/admin/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="tema/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="tema/admin/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="tema/admin/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="tema/admin/dist/js/pages/dashboard.js"></script>
</body>

</html>