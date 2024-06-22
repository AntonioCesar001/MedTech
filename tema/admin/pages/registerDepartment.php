<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamentos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Departamentos</h1>
    <div class="section-content">
        <h2 class="section-title">Lista de Departamentos</h2>

        <!-- Filtro de Pesquisa -->
        <div class="form-group">
            <label for="search-departamento">Pesquisar</label>
            <input type="text" class="form-control" id="search-departamento" placeholder="Nome ou Unidade">
        </div>

        <table class="table table-bordered">
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
                <tr>
                    <td>Departamento A</td>
                    <td>Unidade A</td>
                    <td>20</td>
                    <td>10</td>
                    <td>5</td>
                    <td>1</td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="visualizarDepartamento('Departamento A')">Visualizar</button>
                        <button class="btn btn-warning btn-sm" onclick="editarDepartamento('Departamento A')">Editar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn" data-toggle="modal" data-target="#departamentoModal">Adicionar Departamento</button>
    </div>

    <!-- Modal para Cadastro de Departamento -->
    <div class="modal fade" id="departamentoModal" tabindex="-1" aria-labelledby="departamentoModalLabel" aria-hidden="true">
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
                            <input type="text" class="form-control" id="nome_departamento" name="nome_departamento" required>
                        </div>
                        <div class="form-group">
                            <label for="unidade_departamento">Unidade</label>
                            <input type="text" class="form-control" id="unidade_departamento" name="unidade_departamento" required>
                        </div>
                        <div class="form-group">
                            <label for="num_leitos">Número de Leitos</label>
                            <input type="number" class="form-control" id="num_leitos" name="num_leitos" required>
                        </div>
                        <div class="form-group">
                            <label for="alta_prevista">Alta Prevista</label>
                            <input type="number" class="form-control" id="alta_prevista" name="alta_prevista" required>
                        </div>
                        <div class="form-group">
                            <label for="leitos_ocupados">Leitos Ocupados</label>
                            <input type="number" class="form-control" id="leitos_ocupados" name="leitos_ocupados" required>
                        </div>
                        <div class="form-group">
                            <label for="num_obitos">Número de Óbitos</label>
                            <input type="number" class="form-control" id="num_obitos" name="num_obitos" required>
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
