<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="tema/admin/css/styles.css">
    <style>
        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 30px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 30px;
            color: #4CAF50;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .section-content {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .sub-section-title {
            font-weight: bold;
            margin-top: 20px;
            color: #555;
        }

        .entry {
            margin: 10px 0;
            display: flex;
            align-items: center;
        }

        .entry input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        .btn:hover {
            background-color: #45a049;
        }

        form {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php
    include_once ('tema/admin/includes/menulateral.php');
    if (isset($_SESSION['relatorio'])) {
        $c = $_SESSION['relatorio'];
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
                    <div class="table responsive" style="padding: 10%">
                        <h1>Plantão ADM MRC</h1>
                        <form class="col-md-12" action="index.php?c=relatorio&a=cadastro" method "post" id="plantao-form">
                            <!-- Pre-defined Content -->
                            <div class="section-content">
                                <div class="section-title">Responsáveis:</div>
                                <div class="entry">
                                    <input type="text" name="responsavel[]" value="Nenhum responsável especificado">
                                </div>
                            </div>
                            <div class="section-content">
                                <div class="section-title">Relatório de Supervisão - MRC</div>
                                <div>Data:</div>
                                <?php
                                foreach ($c as $row => $relatorio) {
                                    $row = serialize($row);
                                    $row = unserialize($row);
                                    if ($relatorio->nome) {
                                        if (
                                            $relatorio->nome === 'Emergência'
                                            && $relatorio->idDepartamento === 1
                                            && $relatorio->idPlantao === 1
                                        ) {
                                            ?>
                                            <div class="sub-section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="emergencia_obstetrica[]"
                                                    value="Enfermeiro(a): <?= $relatorio->enfermeiro; ?>"></div>

                                            <div class="entry"><input type="text" name="emergencia_obstetrica[]"
                                                    value="Falta: <?= $relatorio->falta_enfermeiro; ?>"></div>

                                            <div class="entry"><input type="text" name="emergencia_obstetrica[]"
                                                    value="Dobra: <?= $relatorio->dobra_enfermeiro; ?>"></div>

                                            <div class="entry"><input type="text" name="emergencia_obstetrica[]"
                                                    value="Técnico(a): <?= $relatorio->tecnico; ?>"></div>

                                            <div class="entry"><input type="text" name="emergencia_obstetrica[]"
                                                    value="Falta: <?= $relatorio->falta_tecnico; ?>"></div>

                                            <div class="entry"><input type="text" name="emergencia_obstetrica[]"
                                                    value="Dobra: <?= $relatorio->dobra_tecnico; ?>"></div>

                                            <div class="entry"><input type="text" name="emergencia_obstetrica[]"
                                                    value="Func. Remanejada(o): <?= $relatorio->func_remanejado; ?>"></div>

                                            <div class="entry"><input type="text" name="emergencia_obstetrica[]"
                                                    value="Médico(a) Plantonista: <?= $relatorio->medico_plantonista; ?>">
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                foreach ($c as $row => $relatorio) {
                                    $row = serialize($row);
                                    $row = unserialize($row);
                                    if ($relatorio->nome) {
                                        if (
                                            $relatorio->nome === 'Centro Cirúrgico'
                                            && $relatorio->idDepartamento === 3
                                            && $relatorio->idUnidade === 1
                                            && $relatorio->idPlantao === 5
                                        ) {
                                            ?>
                                            <div class="sub-section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="centro_cirurgico[]"
                                                    value="Enfermeiro(a): <?= $relatorio->enfermeiro; ?>"></div>

                                            <div class="entry"><input type="text" name="centro_cirurgico[]"
                                                    value="Falta: <?= $relatorio->falta_enfermeiro; ?>"></div>

                                            <div class="entry"><input type="text" name="centro_cirurgico[]"
                                                    value="Dobra: <?= $relatorio->dobra_enfermeiro; ?>"></div>

                                            <div class="entry"><input type="text" name="centro_cirurgico[]"
                                                    value="Técnico(a): <?= $relatorio->tecnico; ?>"></div>

                                            <div class="entry"><input type="text" name="centro_cirurgico[]"
                                                    value="Falta: <?= $relatorio->falta_tecnico; ?>"></div>

                                            <div class="entry"><input type="text" name="centro_cirurgico[]"
                                                    value="Dobra: <?= $relatorio->dobra_tecnico; ?>"></div>

                                            <div class="entry"><input type="text" name="centro_cirurgico[]"
                                                    value="Func. Remanejada(o): <?= $relatorio->func_remanejado; ?>"></div>

                                            <div class="entry"><input type="text" name="centro_cirurgico[]"
                                                    value="Médico(a) Plantonista: <?= $relatorio->medico_plantonista; ?>"></div>
                                            <?php
                                        }
                                    }
                                }
                                foreach ($c as $row => $relatorio) {
                                    $row = serialize($row);
                                    $row = unserialize($row);
                                    if ($relatorio->nome) {
                                        if (
                                            $relatorio->nome === 'Centro Obstétrico'
                                            && $relatorio->idDepartamento === 2
                                            && $relatorio->idUnidade === 1
                                            && $relatorio->idPlantao === 3
                                        ) {
                                            ?>
                                            <div class="sub-section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="centro_obstetrico[]"
                                                    value="Enfermeiro(a): <?= $relatorio->enfermeiro; ?>"></div>
                                            <div class="entry"><input type="text" name="centro_obstetrico[]"
                                                    value="Falta: <?= $relatorio->falta_enfermeiro; ?>"></div>
                                            <div class="entry"><input type="text" name="centro_obstetrico[]"
                                                    value="Dobra: <?= $relatorio->dobra_enfermeiro; ?>"></div>
                                            <div class="entry"><input type="text" name="centro_obstetrico[]"
                                                    value="Técnico(a): <?= $relatorio->tecnico; ?>"></div>
                                            <div class="entry"><input type="text" name="centro_obstetrico[]"
                                                    value="Falta: <?= $relatorio->falta_tecnico; ?>"></div>
                                            <div class="entry"><input type="text" name="centro_obstetrico[]"
                                                    value="Dobra: <?= $relatorio->dobra_tecnico; ?>"></div>
                                            <div class="entry"><input type="text" name="centro_obstetrico[]"
                                                    value="Func. Remanejada(o): <?= $relatorio->func_remanejado; ?>"></div>
                                            <div class="entry"><input type="text" name="centro_obstetrico[]"
                                                    value="Médico(a) Plantonista: <?= $relatorio->medico_plantonista; ?>"></div>

                                            <div class="entry"><input type="text" name="centro_obstetrico[]"
                                                    value="Alta: <?= $relatorio->alta_prevista; ?>"></div>
                                            <div class="entry"><input type="text" name="centro_obstetrico[]"
                                                    value="Admissão: <?= $relatorio->admissao; ?>"></div>
                                            <div class="entry"><input type="text" name="centro_obstetrico[]"
                                                    value="Procedimentos Realizados: <?= $relatorio->procedimentos_realizados; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="centro_obstetrico[]"
                                                    value="Leitos Bloqueados: <?= $relatorio->leito_ocupado; ?>"></div>
                                        </div>
                                        <?php
                                        }
                                    }
                                }
                                ?>
                            <div class="section-content">
                                <?php
                                foreach ($c as $row => $relatorio) {
                                    $row = serialize($row);
                                    $row = unserialize($row);
                                    if ($relatorio->nome) {
                                        if (
                                            $relatorio->nome === 'Escala p/o Plantão Seguinte'
                                            && $relatorio->idDepartamento === 6
                                            && $relatorio->idUnidade === 1
                                            && $relatorio->idPlantao === 3
                                        ) {
                                            ?>
                                            <div class="section-title"><?= $relatorio->nome; ?>:</div>
                                            <div class="entry"><input type="text" name="escala_plantao[]"
                                                    value="Enfª: <?= $relatorio->enfermeiro; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="escala_plantao[]"
                                                    value="Tecª: <?= $relatorio->tecnico; ?>">
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                foreach ($c as $row => $relatorio) {
                                    $row = serialize($row);
                                    $row = unserialize($row);
                                    if ($relatorio->nome) {
                                        if (
                                            $relatorio->nome === 'UTI Neo'
                                            && $relatorio->idDepartamento === 5
                                            && $relatorio->idUnidade === 1
                                            && $relatorio->idPlantao === 9
                                        ) {
                                            ?>
                                            <div class="sub-section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="uti_neo[]"
                                                    value="Enfermeiro(a): <?= $relatorio->enfermeiro; ?>"></div>
                                            <div class="entry"><input type="text" name="uti_neo[]"
                                                    value="Falta: <?= $relatorio->falta_enfermeiro; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="uti_neo[]"
                                                    value="Dobra: <?= $relatorio->dobra_enfermeiro; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="uti_neo[]"
                                                    value="Técnico(a): <?= $relatorio->tecnico; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="uti_neo[]"
                                                    value="Falta: <?= $relatorio->falta_tecnico; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="uti_neo[]"
                                                    value="Dobra: <?= $relatorio->dobra_tecnico; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="uti_neo[]"
                                                    value="Func. Remanejada(o): <?= $relatorio->func_remanejado; ?>"></div>
                                            <div class="entry"><input type="text" name="uti_neo[]"
                                                    value="Médico(a) Plantonista e Prescritor(a): <?= $relatorio->medico_plantonista; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="uti_neo[]"
                                                    value="Ocupação de Leitos/Altas Previstas: <?= $relatorio->alta_prevista; ?>"></div>
                                            <?php
                                        }
                                    }
                                }
                                foreach ($c as $row => $relatorio) {
                                    $row = serialize($row);
                                    $row = unserialize($row);
                                    if ($relatorio->nome) {
                                        if (
                                            $relatorio->nome === 'UCIN Co'
                                            && $relatorio->idDepartamento === 7
                                            && $relatorio->idUnidade === 1
                                            && $relatorio->idPlantao === 10
                                        ) {
                                            ?>
                                            <div class="sub-section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="ucin_co[]"
                                                    value="Enfermeiro(a): <?= $relatorio->enfermeiro; ?>"></div>
                                            <div class="entry"><input type="text" name="ucin_co[]"
                                                    value="Falta: <?= $relatorio->falta_enfermeiro; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="ucin_co[]"
                                                    value="Dobra: <?= $relatorio->dobra_enfermeiro; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="ucin_co[]"
                                                    value="Técnico(a): <?= $relatorio->tecnico; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="ucin_co[]"
                                                    value="Falta: <?= $relatorio->falta_tecnico; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="ucin_co[]"
                                                    value="Dobra: <?= $relatorio->dobra_tecnico; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="ucin_co[]"
                                                    value="Func. Remanejada(o): <?= $relatorio->func_remanejado; ?>"></div>
                                            <div class="entry"><input type="text" name="ucin_co[]"
                                                    value="Médico(a) Plantonista e Prescritor(a): <?= $relatorio->medico_plantonista; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="ucin_co[]"
                                                    value="Ocupação de Leitos: <?= $relatorio->leito_ocupado; ?>"></div>
                                            <div class="entry"><input type="text" name="ucin_co[]"
                                                    value="Altas Previstas: <?= $relatorio->alta_prevista; ?>"></div>
                                            <?php
                                        }
                                    }
                                }
                                foreach ($c as $row => $relatorio) {
                                    $row = serialize($row);
                                    $row = unserialize($row);
                                    if ($relatorio->nome) {
                                        if (
                                            $relatorio->nome === 'UCIN Ca'
                                            && $relatorio->idDepartamento === 8
                                            && $relatorio->idUnidade === 1
                                            && $relatorio->idPlantao === 11
                                        ) {
                                            ?>
                                            <div class="sub-section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="ucin_ca[]"
                                                    value="Enfermeiro(a): <?= $relatorio->enfermeiro; ?>"></div>
                                            <div class="entry"><input type="text" name="ucin_ca[]"
                                                    value="Falta: <?= $relatorio->falta_enfermeiro; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="ucin_ca[]"
                                                    value="Dobra: <?= $relatorio->dobra_enfermeiro; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="ucin_ca[]"
                                                    value="Técnico(a): <?= $relatorio->tecnico; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="ucin_ca[]"
                                                    value="Falta: <?= $relatorio->falta_tecnico; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="ucin_ca[]"
                                                    value="Dobra: <?= $relatorio->dobra_tecnico; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="ucin_ca[]"
                                                    value="Func. Remanejada(o): <?= $relatorio->func_remanejado; ?>"></div>
                                            <div class="entry"><input type="text" name="ucin_ca[]"
                                                    value="Médico(a) Plantonista e Prescritor(a): <?= $relatorio->medico_plantonista; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="ucin_ca[]"
                                                    value="Ocupação de Leitos/Altas Previstas: <?= $relatorio->alta_prevista; ?>"></div>
                                            <?php
                                        }
                                    }
                                }
                                foreach ($c as $row => $relatorio) {
                                    $row = serialize($row);
                                    $row = unserialize($row);
                                    if ($relatorio->nome) {
                                        if (
                                            $relatorio->nome === 'Alojamento Conjunto'
                                            && $relatorio->idDepartamento === 9
                                            && $relatorio->idUnidade === 1
                                            && $relatorio->idPlantao === 12
                                        ) {
                                            ?>
                                            <div class="sub-section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                                    value="Enfermeiro(a): <?= $relatorio->enfermeiro; ?>"></div>
                                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                                    value="Falta: <?= $relatorio->falta_enfermeiro; ?>"></div>
                                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                                    value="Dobra: <?= $relatorio->dobra_enfermeiro; ?>"></div>
                                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                                    value="Técnico(a): <?= $relatorio->tecnico; ?>"></div>
                                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                                    value="Falta: <?= $relatorio->falta_tecnico; ?>"></div>
                                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                                    value="Dobra: <?= $relatorio->dobra_tecnico; ?>"></div>
                                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                                    value="Func. Remanejada(o): <?= $relatorio->func_remanejado; ?>"></div>
                                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                                    value="Médico(a) Plantonista e Prescritor(a): <?= $relatorio->medico_plantonista; ?>">
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <?php
                            foreach ($c as $row => $relatorio) {
                                $row = serialize($row);
                                $row = unserialize($row);
                                if ($relatorio->nome) {
                                    if (
                                        $relatorio->nome === 'Berçário'
                                        && $relatorio->idDepartamento === 11
                                        && $relatorio->idUnidade === 1
                                        && $relatorio->idPlantao === 14
                                    ) {
                                        ?>
                                        <div class="section-content">
                                            <div class="section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="bercario[]"
                                                    value="Enfermeiro(a): <?= $relatorio->enfermeiro; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="bercario[]"
                                                    value="Falta: <?= $relatorio->falta_enfermeiro; ?>"></div>
                                            <div class="entry"><input type="text" name="bercario[]"
                                                    value="Dobra: <?= $relatorio->dobra_enfermeiro; ?>"></div>
                                            <div class="entry"><input type="text" name="bercario[]"
                                                    value="Técnico(a): <?= $relatorio->tecnico; ?>"></div>
                                            <div class="entry"><input type="text" name="bercario[]"
                                                    value="Falta: <?= $relatorio->falta_tecnico; ?>"></div>
                                            <div class="entry"><input type="text" name="bercario[]"
                                                    value="Dobra: <?= $relatorio->dobra_tecnico; ?>"></div>
                                            <div class="entry"><input type="text" name="bercario[]"
                                                    value="Func. Remanejada(o): <?= $relatorio->func_remanejado; ?>"></div>
                                            <div class="entry"><input type="text" name="bercario[]"
                                                    value="Médico(a) Plantonista e Prescritor(a): <?= $relatorio->medico_plantonista; ?>">
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            foreach ($c as $row => $relatorio) {
                                $row = serialize($row);
                                $row = unserialize($row);
                                if ($relatorio->nome) {
                                    if (
                                        $relatorio->nome === 'Banco de Leite'
                                        && $relatorio->idDepartamento === 12
                                        && $relatorio->idUnidade === 1
                                        && $relatorio->idPlantao === 15
                                    ) {
                                        ?>
                                        <div class="section-content">

                                            <div class="section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="banco_de_leite[]"
                                                    value="Falta: <?= $relatorio->falta_presentes; ?>"></div>
                                            <div class="entry"><input type="text" name="banco_de_leite[]"
                                                    value="Dobra: <?= $relatorio->dobra_presentes; ?>"></div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            foreach ($c as $row => $relatorio) {
                                $row = serialize($row);
                                $row = unserialize($row);
                                if ($relatorio->nome) {
                                    if (
                                        $relatorio->nome === 'Recepção ADM'
                                        && $relatorio->idDepartamento === 13
                                        && $relatorio->idUnidade === 1
                                        && $relatorio->idPlantao === 20
                                    ) {
                                        ?>
                                        <div class="section-content">
                                            <div class="section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="recepcao_adm[]"
                                                    value="Falta:  <?= $relatorio->falta_presentes; ?>"></div>
                                            <div class="entry"><input type="text" name="recepcao_adm[]"
                                                    value="Dobra:  <?= $relatorio->dobra_presentes; ?>"></div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            foreach ($c as $row => $relatorio) {
                                $row = serialize($row);
                                $row = unserialize($row);
                                if ($relatorio->nome) {
                                    if (
                                        $relatorio->nome === 'USG'
                                        && $relatorio->idDepartamento === 14
                                        && $relatorio->idUnidade === 1
                                        && $relatorio->idPlantao === 21
                                    ) {
                                        ?>
                                        <div class="section-content">
                                            <div class="section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="usg[]"
                                                    value="Médico: <?= $relatorio->presentes; ?>"></div>
                                            <div class="entry"><input type="text" name="usg[]"
                                                    value="Téc de Enfermagem: <?= $relatorio->tecnico; ?>"></div>
                                            <div class="entry"><input type="text" name="usg[]"
                                                    value="Falta: <?= $relatorio->falta_tecnico; ?>"></div>
                                            <div class="entry"><input type="text" name="usg[]"
                                                    value="Dobra: <?= $relatorio->dobra_tecnico; ?>"></div>

                                        </div>
                                        <?php
                                    }
                                }
                            }
                            foreach ($c as $row => $relatorio) {
                                $row = serialize($row);
                                $row = unserialize($row);
                                if ($relatorio->nome) {
                                    if (
                                        $relatorio->nome === 'Técnico em Nutrição'
                                        && $relatorio->idDepartamento === 15
                                        && $relatorio->idUnidade === 1
                                        && $relatorio->idPlantao === 22
                                    ) {
                                        ?>
                                        <div class="section-content">
                                            <div class="section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="tecnico_em_nutricao[]"
                                                    value="Falta: <?= $relatorio->falta_presentes; ?>"></div>
                                            <div class="entry"><input type="text" name="tecnico_em_nutricao[]"
                                                    value="Dobra: <?= $relatorio->dobra_presentes; ?>"></div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            foreach ($c as $row => $relatorio) {
                                $row = serialize($row);
                                $row = unserialize($row);
                                if ($relatorio->nome) {
                                    if (
                                        $relatorio->nome === 'Óbitos'
                                        && $relatorio->idDepartamento === 16
                                        && $relatorio->idUnidade === 1
                                        && $relatorio->idPlantao === 23
                                    ) {
                                        ?>
                                        <div class="section-content">
                                            <div class="section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="obitos[]"
                                                    value="Falta: <?= $relatorio->falta_presentes; ?>"></div>
                                            <div class="entry"><input type="text" name="obitos[]"
                                                    value="Dobra: <?= $relatorio->dobra_presentes; ?>"></div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            foreach ($c as $row => $relatorio) {
                                $row = serialize($row);
                                $row = unserialize($row);
                                if ($relatorio->nome) {
                                    if (
                                        $relatorio->nome === 'Rouparia'
                                        && $relatorio->idDepartamento === 17
                                        && $relatorio->idUnidade === 1
                                        && $relatorio->idPlantao === 24
                                    ) {
                                        ?>
                                        <div class="section-content">
                                            <div class="section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="rouparia[]"
                                                    value="Rouparia: <?= $relatorio->presentes; ?>"></div>
                                            <div class="entry"><input type="text" name="rouparia[]"
                                                    value="Falta: <?= $relatorio->falta_presentes; ?>"></div>
                                            <div class="entry"><input type="text" name="rouparia[]"
                                                    value="Dobra: <?= $relatorio->dobra_presentes; ?>"></div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            foreach ($c as $row => $relatorio) {
                                $row = serialize($row);
                                $row = unserialize($row);
                                if ($relatorio->nome) {
                                    if (
                                        $relatorio->nome === 'Psicologia'
                                        && $relatorio->idDepartamento === 18
                                        && $relatorio->idUnidade === 1
                                        && $relatorio->idPlantao === 25
                                    ) {
                                        ?>
                                        <div class="section-content">
                                            <div class="section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="psicologia[]" value="Psicologia: 01"></div>
                                            <div class="entry"><input type="text" name="psicologia[]"
                                                    value="Falta: <?= $relatorio->falta_presentes; ?>"></div>
                                            <div class="entry"><input type="text" name="psicologia[]"
                                                    value="Dobra: <?= $relatorio->dobra_presentes; ?>"></div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            foreach ($c as $row => $relatorio) {
                                $row = serialize($row);
                                $row = unserialize($row);
                                if ($relatorio->nome) {
                                    if (
                                        $relatorio->nome === 'Terapeuta Ocupacional'
                                        && $relatorio->idDepartamento === 19
                                        && $relatorio->idUnidade === 1
                                        && $relatorio->idPlantao === 26
                                    ) {
                                        ?>
                                        <div class="section-content">
                                            <div class="section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="terapeuta_ocupacional[]"
                                                    value="Falta: <?= $relatorio->falta_presentes; ?>"></div>
                                            <div class="entry"><input type="text" name="terapeuta_ocupacional[]"
                                                    value="Dobra: <?= $relatorio->dobra_presentes; ?>"></div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            foreach ($c as $row => $relatorio) {
                                $row = serialize($row);
                                $row = unserialize($row);
                                if ($relatorio->nome) {
                                    if (
                                        $relatorio->nome === 'Higienização'
                                        && $relatorio->idDepartamento === 20
                                        && $relatorio->idUnidade === 1
                                        && $relatorio->idPlantao === 27
                                    ) {
                                        ?>
                                        <div class="section-content">
                                            <div class="section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="higienizacao[]"
                                                    value="Higienização: <?= $relatorio->presentes; ?>"></div>
                                            <div class="entry"><input type="text" name="higienizacao[]"
                                                    value="Falta: <?= $relatorio->falta_presentes; ?>"></div>
                                            <div class="entry"><input type="text" name="higienizacao[]"
                                                    value="Dobra: <?= $relatorio->dobra_presentes; ?>"></div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            foreach ($c as $row => $relatorio) {
                                $row = serialize($row);
                                $row = unserialize($row);
                                if ($relatorio->nome) {
                                    if (
                                        $relatorio->nome === 'Motorista'
                                        && $relatorio->idDepartamento === 10
                                        && $relatorio->idUnidade === 1
                                        && $relatorio->idPlantao === 13
                                    ) {
                                        ?>
                                        <div class="section-content">
                                            <div class="section-title"><?= $relatorio->nome; ?></div>
                                            <div class="entry"><input type="text" name="motorista[]"
                                                    value="Motorista: <?= $relatorio->presentes; ?>">
                                            </div>
                                            <div class="entry"><input type="text" name="motorista[]"
                                                    value="Falta: <?= $relatorio->falta_presentes; ?>"></div>
                                            <div class="entry"><input type="text" name="motorista[]"
                                                    value="Dobra: <?= $relatorio->dobra_presentes; ?>"></div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
    }
    ?>
                        <button class="btn" type="submit">Enviar e Visualizar</button>
                    </form>
                    <br></br>
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
        document.getElementById('plantao-form').addEventListener('submit', function (event) {
            event.preventDefault();
            alert('Formulário enviado com sucesso!');
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