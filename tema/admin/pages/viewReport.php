<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MedTech | Relatório</title>

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
  <!-- DataTables -->
  <link rel="stylesheet" href="tema/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="tema/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="tema/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<?php
    include_once('tema/admin/includes/menulateral.php');
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
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Relatórios de Departamentos</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                      <div class="row">
                        <div class="col-sm-12">
                          <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                            aria-describedby="example1_info">
                            <thead>
                              <tr role="row">
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                  colspan="1" aria-sort="ascending"
                                  aria-label="Nome do Departamento: activate to sort column ascending">Nome do
                                  Departamento
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Total de Plantões: activate to sort column ascending">Total de Plantões
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Faltas de Técnicos: activate to sort column ascending">Faltas de Técnicos
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Falta de Enfermeiros: activate to sort column ascending">Falta de
                                  Enfermeiros</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Falta de Funcionários: activate to sort column ascending">Falta de
                                  Funcionários</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              if (isset($_SESSION['relatorioView'])) {
                                $plantoes = $_SESSION['relatorioView'];
                                foreach ($plantoes as $row) {
                                  $row = serialize($row);
                                  $row = unserialize($row);
                                  ?>
                                  <tr>
                                    <td><?php echo $row->nome_departamento; ?></td>
                                    <td><?php echo $row->total_plantoes; ?></td>
                                    <td><?php echo $row->total_falta_tecnico; ?></td>
                                    <td><?php echo $row->total_falta_enfermeiro; ?></td>
                                    <td><?php echo $row->total_falta_tecnico; ?></td>
                                  </tr>
                                  <?php
                                }
                              }
                              ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th rowspan="1" colspan="1">Nome do
                                Departamento</th>
                                <th rowspan="1" colspan="1">Total de Plantões</th>
                                <th rowspan="1" colspan="1">Faltas de Técnicos</th>
                                <th rowspan="1" colspan="1">Faltas de Enfermeiros</th>
                                <th rowspan="1" colspan="1">Faltas de Funcionários</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
    </div>
  <!-- ./wrapper -->
  <!-- /.content-wrapper -->
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
  <!-- jQuery -->
  <script src="tema/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="tema/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="tema/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="tema/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="tema/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="tema/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="tema/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="tema/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="tema/admin/plugins/jszip/jszip.min.js"></script>
  <script src="tema/admin/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="tema/admin/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="tema/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="tema/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="tema/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="tema/admin/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="tema/admin/dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>