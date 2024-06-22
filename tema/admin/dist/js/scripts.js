// Função para filtrar as unidades
document.getElementById('search-unidade').addEventListener('keyup', function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#lista-unidades tr');

    rows.forEach(row => {
        const unitName = row.cells[0].textContent.toLowerCase();
        const unitAddress = row.cells[1].textContent.toLowerCase();
        if (unitName.includes(searchValue) || unitAddress.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Função para visualizar uma unidade
function visualizarUnidade(nome) {
    alert('Visualizar informações da ' + nome);
}

// Função para editar uma unidade
function editarUnidade(nome) {
    alert('Editar informações da ' + nome);
}

// Função para filtrar os departamentos
document.getElementById('search-departamento').addEventListener('keyup', function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#lista-departamentos tr');

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

// Função para visualizar um departamento
function visualizarDepartamento(nome) {
    alert('Visualizar informações do ' + nome);
}

// Função para editar um departamento
function editarDepartamento(nome) {
    alert('Editar informações do ' + nome);
}

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

// Função para visualizar uma escala
function visualizarEscala(nome) {
    alert('Visualizar informações da escala do ' + nome);
}

// Função para editar uma escala
function editarEscala(nome) {
    alert('Editar informações da escala do ' + nome);
}

// Função para filtrar os plantões
document.getElementById('search-plantao').addEventListener('keyup', function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#lista-plantoes tr');

    rows.forEach(row => {
        const scale = row.cells[0].textContent.toLowerCase();
        const deptName = row.cells[1].textContent.toLowerCase();
        if (scale.includes(searchValue) || deptName.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Função para visualizar um plantão
function visualizarPlantao(nome) {
    alert('Visualizar informações do plantão da ' + nome);
}

// Função para editar um plantão
function editarPlantao(nome) {
    alert('Editar informações do plantão da ' + nome);
}

// Função para filtrar os expedientes
document.getElementById('search-expediente').addEventListener('keyup', function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#lista-expedientes tr');

    rows.forEach(row => {
        const employeeName = row.cells[0].textContent.toLowerCase();
        const shiftName = row.cells[1].textContent.toLowerCase();
        if (employeeName.includes(searchValue) || shiftName.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Função para visualizar um expediente
function visualizarExpediente(nome) {
    alert('Visualizar informações do expediente do ' + nome);
}

// Função para filtrar os funcionários
document.getElementById('search-funcionario').addEventListener('keyup', function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#lista-funcionarios tr');

    rows.forEach(row => {
        const nomeCompleto = row.cells[0].textContent.toLowerCase();
        const especialidade = row.cells[1].textContent.toLowerCase();
        if (nomeCompleto.includes(searchValue) || especialidade.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Função para visualizar um funcionário
function visualizarFuncionario(nome) {
    alert('Visualizar informações do ' + nome);
}

// Função para editar um funcionário
function editarFuncionario(nome) {
    alert('Editar informações do ' + nome);
}
