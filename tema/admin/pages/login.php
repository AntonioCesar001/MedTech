<!DOCTYPE html>
<!-- Declara o tipo de documento como HTML5 -->

<html lang="en">
<!-- Inicia o elemento raiz do documento HTML e define o idioma como inglês -->

<head>
    <!-- Inicia a seção do cabeçalho do documento -->
    <meta charset="UTF-8">
    <!-- Define a codificação de caracteres do documento como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Define a configuração da viewport para garantir que o site seja responsivo em dispositivos móveis -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Inclui a biblioteca de ícones do Font Awesome -->
    <link rel="stylesheet" href="tema/admin/css/style1.css">
    <!-- Inclui o arquivo CSS externo para estilização da página -->
    <title>MedTech | Login</title>
    <!-- Define o título da página que aparece na aba do navegador -->
</head>
<body>
          <?php 
          if (isset($_GET['message'])) {
            switch ($_GET['typeMessage']) {
              case 'sucess':
              ?>
                <div class="alert alert-sucess" id="alert-sucess">
                    <strong>Sucesso!</strong> <?= $_GET['message'] ?>
                </div>
                <?php
                break;
            case 'warning':
                ?>
                <div class="alert alert-warning" id="alert-warning">
                    <strong>Aviso!</strong> <?= $_GET['message'] ?>
                </div>
                <?php
                break;
            case 'error':
                ?>
                <div class="alert alert-danger" id="alert-danger">
                    <strong>Error!</strong> <?= $_GET['message'] ?>
                </div>
                <?php
                break;
            default:
                ?>
                <div class="alert alert-danger" id="alert-danger">
                    <strong>Aviso!</strong> <?= $_GET['message'] ?>
                </div>
                <?php
            break;
        }
    }
    ?>

    <!-- Inicia o corpo do documento -->
    <div class="container" id="container">
        <!-- Cria um contêiner principal para os formulários de login e registro -->
        <div class="form-container sign-up">
            <!-- Cria um contêiner para o formulário de registro -->
            <form action="index.php?c=usuario&a=cadastro" method="post">
                <!-- Inicia o formulário de registro -->
                <h1>Crie sua Conta</h1>
                <!-- Título do formulário de registro -->
                <div class="social-icons">
                    <!-- Div para ícones de redes sociais -->
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <!-- Link para registro com Google Plus (ícone) -->
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <!-- Link para registro com Facebook (ícone) -->
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <!-- Link para registro com GitHub (ícone) -->
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    <!-- Link para registro com LinkedIn (ícone) -->
                </div>
                <span>ou use seu e-mail para cadastro</span>
                <!-- Texto indicando outra opção de registro -->
                <input type="text" placeholder="Nome" name="nome">
                <!-- Campo de entrada para o nome -->
                <input type="email" placeholder="Email" name="email">
                <!-- Campo de entrada para o telefone -->
                <input type="telefone" placeholder="Telefone" name="telefone">
                <!-- Campo de entrada para o email -->
                <input type="password" placeholder="Senha" name="senha">
                <!-- Campo de entrada para a senha -->
                <button>Registrar-se</button>
                <!-- Botão para enviar o formulário de registro -->
            </form>
        </div>

        <div class="form-container sign-in">
            <!-- Cria um contêiner para o formulário de login -->
            <form action="index.php?c=usuario&a=logar" method="post">
                <!-- Inicia o formulário de login -->
                <h1>Entrar</h1>
                <!-- Título do formulário de login -->
                <div class="social-icons">
                    <!-- Div para ícones de redes sociais -->
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <!-- Link para login com Google Plus (ícone) -->
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <!-- Link para login com Facebook (ícone) -->
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <!-- Link para login com GitHub (ícone) -->
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    <!-- Link para login com LinkedIn (ícone) -->
                </div>
                <span>ou use sua e-mail e senha</span>
                <!-- Texto indicando outra opção de login -->
                <input type="email" placeholder="Email" name="email">
                <!-- Campo de entrada para o email -->
                <input type="password" placeholder="Senha" name="senha">
                <!-- Campo de entrada para a senha -->
                <a href="forget-password.html">Esqueceu sua senha?</a>
                <!-- Link para recuperação de senha -->
                <button>Entrar</button>
                <!-- Botão para enviar o formulário de login -->
            </form>
        </div>

        <div class="toggle-container">
            <!-- Cria um contêiner para os painéis de alternância -->
            <div class="toggle">
                <!-- Div para os painéis de alternância -->
                <div class="toggle-panel toggle-left">
                    <!-- Painel esquerdo de alternância -->
                    <h1>Bem vindo de volta!</h1>
                    <!-- Título do painel esquerdo -->
                    <p>Insira seus dados pessoais para usar todos os recursos do site</p>
                    <!-- Texto informativo do painel esquerdo -->
                    <button class="hidden" id="login">Entrar</button>
                    <!-- Botão de login (escondido) -->
                </div>
                <div class="toggle-panel toggle-right">
                    <!-- Painel direito de alternância -->
                    <h1>Olá, Amigo!</h1>
                    <!-- Título do painel direito -->
                    <p>Registre-se com seus dados pessoais para usar todos os recursos do site</p>
                    <!-- Texto informativo do painel direito -->
                    <button class="hidden" id="register">Registrar-se</button>
                    <!-- Botão de registro (escondido) -->
                </div>
            </div>
        </div>
    </div>

    <script src="tema/admin/dist/js/script1.js"></script>
    <!-- Inclui o arquivo JavaScript externo para adicionar funcionalidades à página -->
</body>
</html>