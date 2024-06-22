<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Senha</title>
    <script>
        function validarSenhas(event) {
            const senha = document.getElementById('senha').value;
            const confirmarSenha = document.getElementById('confirmar_senha').value;
            
            if (senha !== confirmarSenha) {
                alert('As senhas não coincidem.');
                event.preventDefault(); // Impede o envio do formulário
            }
        }
    </script>
</head>
<body>
    <form action="processar_senha.php" method="post" onsubmit="validarSenhas(event)">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>
        <label for="confirmar_senha">Confirmar Senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required><br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>