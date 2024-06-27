<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>MedTech</title>

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
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="tema/admin/dist/img/medtech.jpg" alt="AdminLTELogo" height="60" width="60">
    </div>
    <?php
    include_once ('tema/admin/includes/menulateral.php');
    if (isset($_SESSION['main'])) {
        $a = $_SESSION['main'];
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
                                <li class="breadcrumb-item"><a>MedTech</a></li>
                                <li class="breadcrumb-item active">Principal</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                    foreach ($a as $row) {
                                        $row = serialize($row);
                                        $row = unserialize($row);
                                        if ($row->total_departamentos) {
                                            ?>
                                            <h3><?= $row->total_departamentos; ?></h3>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <p><br>Departamentos Inseridos<br></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-stethoscope"></i>
                                </div>
                                <a href="index.php?c=departamento&a=visualizar" class="small-box-footer">Mais informações <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>100<sup style="font-size: 20px">%</sup></h3>
                                    <p><br>Relatórios Detalhados<br></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-medical"></i>
                                </div>
                                <a href="index.php?c=relatorio&a=visualizar" class="small-box-footer">Mais informações <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <?php
                                    foreach ($a as $row) {
                                        $row = serialize($row);
                                        $row = unserialize($row);
                                        if ($row->qtd_funcionarios) {
                                            ?>
                                            <h3><?= $row->qtd_funcionarios; ?></h3>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <p><br>Funcionarios Cadastrados<br></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <a href="index.php?c=funcionario&a=visualizar" class="small-box-footer">Mais informações <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <?php
                                    foreach ($a as $row) {
                                        $row = serialize($row);
                                        $row = unserialize($row);
                                        if ($row->qtd_relatorio || $row->qtd_relatorio === 0) {
                                            ?>
                                            <h3><?= $row->qtd_relatorio; ?></h3>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <p><br>Escala do Dia<br></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <a href="index.php?c=escala&a=visualizar" class="small-box-footer">Mais informações <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div><!-- /.container-fluid -->


                <!-- DONUT CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Gerenciamento de Leitos</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->

        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="#">MedTech</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Versão</b> 1.0.0
            </div>
        </footer>
        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="tema/admin/dist/scripts.js"></script>
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
        <script src="scripts.js"></script>
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
        <script>
            $(function () {
                /* ChartJS
                 * -------
                 * Here we will create a few charts using ChartJS
                 */
                //-------------
                //- DONUT CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                var donutData = {
                    labels: [
                        'Leitos Ocupados',
                        'Quantidades de Leitos',
                        'Leitos Livres',
                    ],
                    datasets: [
                        <?php
                        foreach ($a as $row) {
                            $row = serialize($row);
                            $row = unserialize($row);
                            if ($row->qtd_leitos_livres || $row->numero_leitos || $row->leitos_ocupados) {
                                ?>
                                                                                        {
                                    data: [
                                        <?= $row->leitos_ocupados; ?>,
                                        <?= $row->numero_leitos; ?>,
                                        <?= $row->qtd_leitos_livres; ?>
                                    ],
                                    backgroundColor: ['#f56954', '#00a65a', '#f39c12',],
                                }
                                                                                        <?php
                            }
                        }
    }
    ?>

                ]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

        })
    </script>
</body>

</html>