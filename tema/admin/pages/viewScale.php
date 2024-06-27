<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedTech | Escala</title>
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
                            <li class="breadcrumb-item"><a>Escala</a></li>
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
                    <div class="table responsive" style="padding: 1.5%">
                        <div class="section-content">
                            <h2 class="section-title">Lista de Escalas</h2>

                            <!-- Filtro de Pesquisa -->
                            <div class="form-group">
                                <label for="search-escala">Pesquisar</label>
                                <input type="text" class="form-control" id="search-escala"
                                    placeholder="Departamento ou Unidade">
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Departamento</th>
                                        <th>Unidade</th>
                                        <th>Turno</th>
                                        <th>Data da Escala</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="lista-escalas">
                                    <!-- Dados das escalas serão carregados aqui -->
                                    <!-- Exemplo de uma escala -->
                                    <?php
                                    if (isset($_SESSION['escala'])) {
                                        $a = $_SESSION['escala'];
                                        foreach ($a as $row) {
                                            $row = serialize($row);
                                            $row = unserialize($row);
                                            ?>
                                            <tr>
                                                <td><?php echo $row->nome_unidade; ?></td>
                                                <td><?php echo $row->nome_departamento; ?></td>
                                                <td><?php echo $row->turno; ?></td>
                                                <td><?php echo $row->data_escala; ?></td>
                                                <td>
                                            <button class="btn btn-info btn-sm"
                                                onclick="visualizarEscala('Departamento A')">Visualizar</button>
                                            <button class="btn btn-warning btn-sm"
                                                onclick="editarEscala('Departamento A')">Editar</button>
                                        </td>
                                            </tr>
                                            <?php
                                        }
                                    } ?>
                                </tbody>
                            </table>
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
    <script>
        // Função para filtrar as escalas
        document.getElementById('search-escala').addEventListener('keyup', function () {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#lista-escalas tr');

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