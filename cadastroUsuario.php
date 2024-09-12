<?php require_once "./controllers/cadastroUsuarioController.php"; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./public/cadastroUsuario.css">
</head>
<body>
    <div class="form-container">
        <form id="registerForm" method="post">
            <h2>Cadastro</h2>
            <div class="input-group">
                <input type="text" id="login" name="login" required>
                <label for="login">Login</label>
            </div>
            <div class="input-group">
                <input type="text" id="cpf" name="cpf" required>
                <label for="cpf">CPF</label>
            </div>
            <div class="input-group">
                <input type="email" id="email" name="email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <select name="tipo_grupo" id="tipo_grupo">
                    <option value="1">Cliente</option>
                    <option value="0">Lojista</option>
                </select>
                <label for="tipo_grupo">Tipo de Conta</label>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" required>
                <label for="password">Senha</label>
            </div>
            <button type="submit">Cadastrar</button>
            <a href="./index.php" class="back-button">Voltar</a>
            
            <p class="error-message" id="errorMessage"></p>
        </form>
    </div>

    <script src="./public/js/index.js"></script>
</body>
</html>

