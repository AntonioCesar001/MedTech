<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escalas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Escalas</h1>
    <div class="section-content">
        <h2 class="section-title">Lista de Escalas</h2>

        <!-- Filtro de Pesquisa -->
        <div class="form-group">
            <label for="search-escala">Pesquisar</label>
            <input type="text" class="form-control" id="search-escala" placeholder="Departamento ou Unidade">
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
                <tr>
                    <td>Departamento A</td>
                    <td>Unidade A</td>
                    <td>Manhã</td>
                    <td>2024-06-06</td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="visualizarEscala('Departamento A')">Visualizar</button>
                        <button class="btn btn-warning btn-sm" onclick="editarEscala('Departamento A')">Editar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn" data-toggle="modal" data-target="#escalaModal">Adicionar Escala</button>
    </div>

    <!-- Modal para Cadastro de Escala -->
    <div class="modal fade" id="escalaModal" tabindex="-1" aria-labelledby="escalaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="escalaModalLabel">Cadastrar Escala</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-escala">
                        <div class="form-group">
                            <label for="departamento_escala">Departamento</label>
                            <input type="text" class="form-control" id="departamento_escala" name="departamento_escala" required>
                        </div>
                        <div class="form-group">
                            <label for="unidade_escala">Unidade</label>
                            <input type="text" class="form-control" id="unidade_escala" name="unidade_escala" required>
                        </div>
                        <div class="form-group">
                            <label for="turno">Turno</label>
                            <input type="text" class="form-control" id="turno" name="turno" required>
                        </div>
                        <div class="form-group">
                            <label for="data_escala">Data da Escala</label>
                            <input type="date" class="form-control" id="data_escala" name="data_escala" required>
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
