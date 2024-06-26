<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedTech | Departamento</title>
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
                            <li class="breadcrumb-item"><a>Departamento</a></li>
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
                        <div class="section-content">
                            <h2 class="section-title">Lista de Departamentos</h2>
                            <!-- Filtro de Pesquisa -->
                            <div class="form-group">
                                <label for="search-departamento">Pesquisar</label>
                                <input type="text" class="form-control" id="search-departamento"
                                    placeholder="Nome ou Especialidade">
                            </div>

                            <table class="table table-bordered" id="lista-departamentos">
                                <thead>
                                    <tr>
                                        <th>Nome do Departamento</th>
                                        <th>Unidade</th>
                                        <th>Número de Leitos</th>
                                        <th>Alta Prevista</th>
                                        <th>Leitos Ocupados</th>
                                        <th>Número de Óbitos</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="lista-departamentos">
                                    <!-- Dados dos departamentos serão carregados aqui -->
                                    <!-- Exemplo de um departamento -->
                                    <?php
                                if (isset($_SESSION['departamento'])) {
                                    $a = $_SESSION['departamento'];
                                    foreach ($a as $row) {
                                        $row = serialize($row);
                                        $row = unserialize($row);
                                        ?>
                                        <tr>
                                            <td><?php echo $row->nome; ?></td>
                                            <td><?php echo $row->nome_unidade; ?></td>
                                            <td><?php echo $row->numero_leito; ?></td>
                                            <td><?php echo $row->alta_prevista; ?></td>
                                            <td><?php echo $row->leito_ocupado; ?></td>
                                            <td><?php echo $row->numero_obito; ?></td>
                                            <td>
                                                <button class="btn btn-info btn-sm"
                                                    onclick="visualizarDepartamento('Departamento A')">Visualizar</button>
                                                <button class="btn btn-warning btn-sm"
                                                    onclick="editarDepartamento('Departamento A')">Editar</button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } ?>
                                </tbody>
                            </table>

                        </div>

                        <!-- Modal para Cadastro de Departamento -->
                        <div class="modal fade" id="departamentoModal" tabindex="-1"
                            aria-labelledby="departamentoModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="departamentoModalLabel">Cadastrar Departamento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form-departamento">
                                            <div class="form-group">
                                                <label for="nome_departamento">Nome do Departamento</label>
                                                <input type="text" class="form-control" id="nome_departamento"
                                                    name="nome_departamento" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="unidade_departamento">Unidade</label>
                                                <input type="text" class="form-control" id="unidade_departamento"
                                                    name="unidade_departamento" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="num_leitos">Número de Leitos</label>
                                                <input type="number" class="form-control" id="num_leitos"
                                                    name="num_leitos" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alta_prevista">Alta Prevista</label>
                                                <input type="number" class="form-control" id="alta_prevista"
                                                    name="alta_prevista" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="leitos_ocupados">Leitos Ocupados</label>
                                                <input type="number" class="form-control" id="leitos_ocupados"
                                                    name="leitos_ocupados" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="num_obitos">Número de Óbitos</label>
                                                <input type="number" class="form-control" id="num_obitos"
                                                    name="num_obitos" required>
                                            </div>
                                            <button type="submit" class="btn">Salvar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2024 <a href="#">MedTech</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versão</b> 1.0.0
        </div>
    </footer>


    <!-- JavaScript -->
    <script>
        // Função para filtrar as escalas
        // Função para filtrar os departamentos
        document.getElementById('search-departamento').addEventListener('keyup', function () {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#lista-departamentos tbody tr');

            rows.forEach(row => {
                const deptName = row.cells[0].textContent.toLowerCase();
                const unitName = row.cells[1].textContent.toLowerCase();
                if (deptName.includes(searchValue) || unitName.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

    </script>
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