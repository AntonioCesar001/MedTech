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
    // Incluir o menu lateral
    include_once ('tema/admin/includes/menulateral.php');
    include_once('Source/Core/Helpers.php');
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
                <div class="section-content">
                    <h2 class="section-title">Escalas</h2>

                    <!-- Filtro de Pesquisa -->
                    <div class="form-group">
                        <label for="search-escala">Pesquisar</label>
                        <input type="text" class="form-control" id="search-escala"
                            placeholder="Departamento ou Unidade">
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Unidade</th>
                                <th>Departamento</th>
                                <th>Turno</th>
                                <th>Data da Escala</th>
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
                                    $dataFormatadaParaBR = datetobr($row->data_escala);
                                    ?>
                                    <tr>
                                        <td><?php echo $row->nome_unidade; ?></td>
                                        <td><?php echo $row->nome_departamento; ?></td>
                                        <td><?php echo $row->turno; ?></td>
                                        <td><?php echo $dataFormatadaParaBR; ?></td>
                                    </tr>
                                    <?php
                                }
                            } ?>
                        </tbody>
                    </table>
                    <button class="btn" data-toggle="modal" data-target="#escalaModal">Adicionar Escala</button>
                </div>

                <!-- Modal para Cadastro de Escala -->
                <div class="modal fade" id="escalaModal" tabindex="-1" aria-labelledby="escalaModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="escalaModalLabel">Cadastrar Escala</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="index.php?c=escala&a=cadastro" id="form-escala" method="post">
                                    <div class="form-group">
                                        <label for="unidade_escala">Unidade</label>
                                        <select class="form-control" id="unidade_escala" name="idUnidade">
                                            <option></option>
                                            <?php
                                            if (isset($_SESSION['unidade'])) {
                                                $a = $_SESSION['unidade'];
                                                foreach ($a as $row) {
                                                    $row = serialize($row);
                                                    $row = unserialize($row);
                                                    ?>
                                                    <option value="<?php echo $row->idUnidade; ?>">
                                                        <?php echo $row->nome_unidade; ?>
                                                    </option>
                                                    <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="departamento_escala">Departamento</label>
                                        <select class="form-control" id="departamento_escala" name="idDepartamento">
                                            <option></option>
                                            <?php
                                            if (isset($_SESSION['departamento'])) {
                                                $a = $_SESSION['departamento'];
                                                foreach ($a as $row) {
                                                    $row = serialize($row);
                                                    $row = unserialize($row);
                                                    ?>
                                                    <option value="<?php echo $row->idDepartamento; ?>">
                                                        <?php echo $row->nome_departamento; ?>
                                                    </option>
                                                    <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="turno">Turno</label>
                                        <select class="form-control" id="turno" name="turno">
                                            <option></option>
                                            <option value="SD">SD</option>
                                            <option value="MT">MT</option>
                                            <option value="SN">SN</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="data_escala">Data da Escala</label>
                                        <input type="date" class="form-control" id="data_escala" name="data_escala"
                                            required>
                                    </div>
                                    <button type="submit" class="btn">Salvar</button>
                                </form>
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