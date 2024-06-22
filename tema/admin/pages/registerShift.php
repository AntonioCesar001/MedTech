<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantões</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Plantões</h1>
    <div class="section-content">
        <h2 class="section-title">Lista de Plantões</h2>

        <!-- Filtro de Pesquisa -->
        <div class="form-group">
            <label for="search-plantao">Pesquisar</label>
            <input type="text" class="form-control" id="search-plantao" placeholder="Escala ou Departamento">
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Escala</th>
                    <th>Departamento</th>
                    <th>Unidade</th>
                    <th>Funcionário Escalado</th>
                    <th>Falta</th>
                    <th>Funcionário Remanejado</th>
                    <th>Dobra</th>
                    <th>Prescritor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="lista-plantoes">
                <!-- Dados dos plantões serão carregados aqui -->
                <!-- Exemplo de um plantão -->
                <tr>
                    <td>Escala A</td>
                    <td>Departamento A</td>
                    <td>Unidade A</td>
                    <td>Funcionário A</td>
                    <td>Não</td>
                    <td>Não</td>
                    <td>Sim</td>
                    <td>Sim</td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="visualizarPlantao('Escala A')">Visualizar</button>
                        <button class="btn btn-warning btn-sm" onclick="editarPlantao('Escala A')">Editar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn" data-toggle="modal" data-target="#plantaoModal">Adicionar Plantão</button>
    </div>

    <!-- Modal para Cadastro de Plantão -->
    <div class="modal fade" id="plantaoModal" tabindex="-1" aria-labelledby="plantaoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="plantaoModalLabel">Cadastrar Plantão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-plantao">
                        <div class="form-group">
                            <label for="escala_plantao">Escala</label>
                            <input type="text" class="form-control" id="escala_plantao" name="escala_plantao" required>
                        </div>
                        <div class="form-group">
                            <label for="departamento_plantao">Departamento</label>
                            <input type="text" class="form-control" id="departamento_plantao" name="departamento_plantao" required>
                        </div>
                        <div class="form-group">
                            <label for="unidade_plantao">Unidade</label>
                            <input type="text" class="form-control" id="unidade_plantao" name="unidade_plantao" required>
                        </div>
                        <div class="form-group">
                            <label for="funcionario_escalado">Funcionário Escalado</label>
                            <input type="text" class="form-control" id="funcionario_escalado" name="funcionario_escalado" required>
                        </div>
                        <div class="form-group">
                            <label for="falta">Falta</label>
                            <select class="form-control" id="falta" name="falta" required>
                                <option value="Sim">Sim</option>
                                <option value="Não">Não</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="funcionario_remanejado">Funcionário Remanejado</label>
                            <select class="form-control" id="funcionario_remanejado" name="funcionario_remanejado" required>
                                <option value="Sim">Sim</option>
                                <option value="Não">Não</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dobra">Dobra</label>
                            <select class="form-control" id="dobra" name="dobra" required>
                                <option value="Sim">Sim</option>
                                <option value="Não">Não</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="prescritor">Prescritor</label>
                            <select class="form-control" id="prescritor" name="prescritor" required>
                                <option value="Sim">Sim</option>
                                <option value="Não">Não</option>
                            </select>
                        </div>
                        <button type="submit" class="btn">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
