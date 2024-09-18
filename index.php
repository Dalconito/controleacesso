<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="./public/css/index.css">
</head>
<body>
    <div class="login-container">
        <form id="loginForm" method="post">
            <h2>Login</h2>
            <div class="input-group">
                <input type="text" id="username" name="login" required>
                <label for="username">Username</label>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="senha" required>
                <label for="password">Password</label>
            </div>
            <div id="errorMessage" class="input-group"></div>
            <button type="submit">Login</button>
            <p class="error-message" id="errorMessage"></p>
            <div class="additional-links">
                <a href="./recuperasenha.php" id="forgotPassword">Esqueci minha senha</a>
                <a href="./cadastroUsuario.php" id="register">Cadastre-se</a>
            </div>
            
        </form>
    </div>
    <script src="./public/js/index.js" defer></script>
</body>
</html>
