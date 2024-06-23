<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantão ADM MRC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
            margin: 0;
        }

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

<body>
    <?php
    if (isset($_SESSION['relatorio'])) {
        $c = $_SESSION['relatorio'];
        ?>
        <h1>Plantão ADM MRC</h1>
        <form action "index.php?c=relatorio&a=cadastro" method "post" id="plantao-form">
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
                    //exit(var_dump($relatorio));
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
            }

                        if (
                            $relatorio->nome === 'Centro Cirúrgico'
                            && $relatorio->idDepartamento === 3
                            && $relatorio->idUnidade === 1
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
                        if (
                            $relatorio->nome === 'Centro Obstétrico'
                            && $relatorio->idDepartamento === 2
                            && $relatorio->idUnidade === 1
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
                                    value="Procedimentos Realizados: <?= $relatorio->procedimentos_realizados; ?>"></div>
                            <div class="entry"><input type="text" name="centro_obstetrico[]"
                                    value="Leitos Bloqueados: <?= $relatorio->leito_ocupado; ?>"></div>
                        </div>
                        <?php
                        }
                        ?>
                    <div class="section-content">
                        <?php
                        if (
                            $relatorio->nome === 'Escala p/o Plantão Seguinte'
                            && $relatorio->idDepartamento === 6
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="section-title"><?= $relatorio->nome; ?>:</div>
                            <div class="entry"><input type="text" name="escala_plantao[]"
                                    value="Enfª: <?= $relatorio->enfermeiro; ?>">"></div>
                            <div class="entry"><input type="text" name="escala_plantao[]" value="Tecª: <?= $relatorio->tecnico; ?>">">
                            </div>
                            <?php
                        }

                        if (
                            $relatorio->nome === 'UTI Neo'
                            && $relatorio->idDepartamento === 5
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="sub-section-title"><?= $relatorio->nome; ?></div>
                            <div class="entry"><input type="text" name="uti_neo[]"
                                    value="Enfermeiro(a): <?= $relatorio->enfermeiro; ?>"></div>
                            <div class="entry"><input type="text" name="uti_neo[]" value="Falta: <?= $relatorio->falta_enfermeiro; ?>">
                            </div>
                            <div class="entry"><input type="text" name="uti_neo[]" value="Dobra: <?= $relatorio->dobra_enfermeiro; ?>">
                            </div>
                            <div class="entry"><input type="text" name="uti_neo[]" value="Técnico(a): <?= $relatorio->tecnico; ?>">
                            </div>
                            <div class="entry"><input type="text" name="uti_neo[]" value="Falta: <?= $relatorio->falta_tecnico; ?>">
                            </div>
                            <div class="entry"><input type="text" name="uti_neo[]" value="Dobra: <?= $relatorio->dobra_tecnico; ?>">
                            </div>
                            <div class="entry"><input type="text" name="uti_neo[]"
                                    value="Func. Remanejada(o): <?= $relatorio->func_remanejado; ?>"></div>
                            <div class="entry"><input type="text" name="uti_neo[]"
                                    value="Médico(a) Plantonista e Prescritor(a): <?= $relatorio->medico_plantonista; ?>"></div>
                            <div class="entry"><input type="text" name="uti_neo[]"
                                    value="Ocupação de Leitos/Altas Previstas: <?= $relatorio->alta_prevista; ?>"></div>
                            <?php
                        }
                        if (
                            $relatorio->nome === 'UCIN Co'
                            && $relatorio->idDepartamento === 7
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="sub-section-title"><?= $relatorio->nome; ?></div>
                            <div class="entry"><input type="text" name="ucin_co[]"
                                    value="Enfermeiro(a): <?= $relatorio->enfermeiro; ?>"></div>
                            <div class="entry"><input type="text" name="ucin_co[]" value="Falta: <?= $relatorio->falta_enfermeiro; ?>">
                            </div>
                            <div class="entry"><input type="text" name="ucin_co[]" value="Dobra: <?= $relatorio->dobra_enfermeiro; ?>">
                            </div>
                            <div class="entry"><input type="text" name="ucin_co[]" value="Técnico(a): <?= $relatorio->tecnico; ?>">
                            </div>
                            <div class="entry"><input type="text" name="ucin_co[]" value="Falta: <?= $relatorio->falta_tecnico; ?>">
                            </div>
                            <div class="entry"><input type="text" name="ucin_co[]" value="Dobra: <?= $relatorio->dobra_tecnico; ?>">
                            </div>
                            <div class="entry"><input type="text" name="ucin_co[]"
                                    value="Func. Remanejada(o): <?= $relatorio->func_remanejado; ?>"></div>
                            <div class="entry"><input type="text" name="ucin_co[]"
                                    value="Médico(a) Plantonista e Prescritor(a): <?= $relatorio->medico_plantonista; ?>"></div>
                            <div class="entry"><input type="text" name="ucin_co[]"
                                    value="Ocupação de Leitos/Altas Previstas: <?= $relatorio->alta_prevista; ?>"></div>/
                            <?php
                        }
                        if (
                            $relatorio->nome === 'UCIN Ca'
                            && $relatorio->idDepartamento === 8
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="sub-section-title"><?= $relatorio->nome; ?></div>
                            <div class="entry"><input type="text" name="ucin_ca[]"
                                    value="Enfermeiro(a): <?= $relatorio->enfermeiro; ?>"></div>
                            <div class="entry"><input type="text" name="ucin_ca[]" value="Falta: <?= $relatorio->falta_enfermeiro; ?>">
                            </div>
                            <div class="entry"><input type="text" name="ucin_ca[]" value="Dobra: <?= $relatorio->dobra_enfermeiro; ?>">
                            </div>
                            <div class="entry"><input type="text" name="ucin_ca[]" value="Técnico(a): <?= $relatorio->tecnico; ?>">
                            </div>
                            <div class="entry"><input type="text" name="ucin_ca[]" value="Falta: <?= $relatorio->falta_tecnico; ?>">
                            </div>
                            <div class="entry"><input type="text" name="ucin_ca[]" value="Dobra: <?= $relatorio->dobra_tecnico; ?>">
                            </div>
                            <div class="entry"><input type="text" name="ucin_ca[]"
                                    value="Func. Remanejada(o): <?= $relatorio->func_remanejado; ?>"></div>
                            <div class="entry"><input type="text" name="ucin_ca[]"
                                    value="Médico(a) Plantonista e Prescritor(a): <?= $relatorio->medico_plantonista; ?>"></div>
                            <div class="entry"><input type="text" name="ucin_ca[]"
                                    value="Ocupação de Leitos/Altas Previstas: <?= $relatorio->alta_prevista; ?>"></div>
                            <?php
                        }
                        if (
                            $relatorio->nome === 'Alojamento Conjunto'
                            && $relatorio->idDepartamento === 9
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="sub-section-title"><?= $relatorio->nome; ?></div>
                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                    value="Enfermeiro(a): <?= $relatorio->enfermeiro; ?>"></div>
                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                    value="Falta: <?= $relatorio->falta_enfermeiro; ?>"></div>
                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                    value="Dobra: <?= $relatorio->falta_enfermeiro; ?>"></div>
                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                    value="Técnico(a): <?= $relatorio->tecnico; ?>"></div>
                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                    value="Falta: <?= $relatorio->falta_tecnico; ?>"></div>
                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                    value="Dobra: <?= $relatorio->dobra_tecnico; ?>"></div>
                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                    value="Func. Remanejada(o): <?= $relatorio->func_remanejado; ?>"></div>
                            <div class="entry"><input type="text" name="alojamento_conjunto[]"
                                    value="Médico(a) Plantonista e Prescritor(a): <?= $relatorio->medico_plantonista; ?>"></div>
                            <?php
                        }
                        ?>
                    </div>



                    <div class="section-content">
                        <?php
                        if (
                            $relatorio->nome === 'Berçário'
                            && $relatorio->idDepartamento === 5
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="section-title">Berçário</div>
                            <div class="entry"><input type="text" name="bercario[]" value="Enfermeiro(a): 01"></div>
                            <div class="entry"><input type="text" name="bercario[]" value="Falta: "></div>
                            <div class="entry"><input type="text" name="bercario[]" value="Dobra: "></div>
                            <div class="entry"><input type="text" name="bercario[]" value="Técnico(a): 02"></div>
                            <div class="entry"><input type="text" name="bercario[]" value="Falta: "></div>
                            <div class="entry"><input type="text" name="bercario[]" value="Dobra: "></div>
                            <div class="entry"><input type="text" name="bercario[]" value="Func. Remanejada(o): "></div>
                            <div class="entry"><input type="text" name="bercario[]" value="Médico(a) Plantonista e Prescritor(a): 01">
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="section-content">
                        <?php
                        if (
                            $relatorio->nome === 'Alojamento Conjunto'
                            && $relatorio->idDepartamento === 5
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="section-title">Banco de Leite</div>
                            <div class="entry"><input type="text" name="banco_de_leite[]" value="Falta: "></div>
                            <div class="entry"><input type="text" name="banco_de_leite[]" value="Dobra: "></div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="section-content">
                        <?php
                        if (
                            $relatorio->nome === 'Alojamento Conjunto'
                            && $relatorio->idDepartamento === 5
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="section-title">Recepção ADM</div>
                            <div class="entry"><input type="text" name="recepcao_adm[]" value="Falta: "></div>
                            <div class="entry"><input type="text" name="recepcao_adm[]" value="Dobra: "></div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="section-content">
                        <?php
                        if (
                            $relatorio->nome === 'Alojamento Conjunto'
                            && $relatorio->idDepartamento === 5
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="section-title">USG</div>
                            <div class="entry"><input type="text" name="usg[]" value="Médico: 01"></div>
                            <div class="entry"><input type="text" name="usg[]" value="Téc de Enfermagem: 01"></div>
                            <div class="entry"><input type="text" name="usg[]" value="Falta: "></div>
                            <div class="entry"><input type="text" name="usg[]" value="Dobra: "></div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="section-content">
                        <?php
                        if (
                            $relatorio->nome === 'Alojamento Conjunto'
                            && $relatorio->idDepartamento === 5
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="section-title">Técnico em Nutrição</div>
                            <div class="entry"><input type="text" name="tecnico_em_nutricao[]" value="Falta: "></div>
                            <div class="entry"><input type="text" name="tecnico_em_nutricao[]" value="Dobra: "></div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="section-content">
                        <?php
                        if (
                            $relatorio->nome === 'Alojamento Conjunto'
                            && $relatorio->idDepartamento === 5
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="section-title">Óbitos</div>
                            <div class="entry"><input type="text" name="obitos[]" value="Falta: "></div>
                            <div class="entry"><input type="text" name="obitos[]" value="Dobra: "></div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="section-content">
                        <?php
                        if (
                            $relatorio->nome === 'Alojamento Conjunto'
                            && $relatorio->idDepartamento === 5
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="section-title">Rouparia</div>
                            <div class="entry"><input type="text" name="rouparia[]" value="Rouparia: 01"></div>
                            <div class="entry"><input type="text" name="rouparia[]" value="Falta: "></div>
                            <div class="entry"><input type="text" name="rouparia[]" value="Dobra: "></div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="section-content">
                        <?php
                        if (
                            $relatorio->nome === 'Alojamento Conjunto'
                            && $relatorio->idDepartamento === 5
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="section-title">Psicologia</div>
                            <div class="entry"><input type="text" name="psicologia[]" value="Psicologia: 01"></div>
                            <div class="entry"><input type="text" name="psicologia[]" value="Falta: "></div>
                            <div class="entry"><input type="text" name="psicologia[]" value="Dobra: "></div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="section-content">
                        <?php
                        if (
                            $relatorio->nome === 'Alojamento Conjunto'
                            && $relatorio->idDepartamento === 5
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="section-title">Terapeuta Ocupacional</div>
                            <div class="entry"><input type="text" name="terapeuta_ocupacional[]" value="Falta: "></div>
                            <div class="entry"><input type="text" name="terapeuta_ocupacional[]" value="Dobra: "></div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="section-content">
                        <?php
                        if (
                            $relatorio->nome === 'Alojamento Conjunto'
                            && $relatorio->idDepartamento === 5
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="section-title">Higienização</div>
                            <div class="entry"><input type="text" name="higienizacao[]" value="Higienização: 03"></div>
                            <div class="entry"><input type="text" name="higienizacao[]" value="Falta: "></div>
                            <div class="entry"><input type="text" name="higienizacao[]" value="Dobra: "></div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="section-content">
                        <?php
                        if (
                            $relatorio->nome === 'Motorista'
                            && $relatorio->idDepartamento === 5
                            && $relatorio->idUnidade === 1
                        ) {
                            ?>
                            <div class="section-title"><?= $relatorio->nome; ?></div>
                            <div class="entry"><input type="text" name="motorista[]" value="Motorista: <?= $relatorio->presentes; ?>"></div>
                            <div class="entry"><input type="text" name="motorista[]" value="Falta: "></div>
                            <div class="entry"><input type="text" name="motorista[]" value="Dobra: "></div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php

    ?>
        <button class="btn" type="submit">Enviar e Visualizar</button>
    </form>

    <script>
        document.getElementById('plantao-form').addEventListener('submit', function (event) {
            event.preventDefault();
            alert('Formulário enviado com sucesso!');
        });
    </script>
</body>

</html>