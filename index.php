<?php
session_start();
if(isset($_SESSION['tipoUsr'])){
    header("location: ./adicionarQr.php");
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="./public/css/index.css">
</head>
<body>
    <button class="menu-btn" onclick="openMenu()">☰</button>
    
    <!-- Menu lateral direito -->
    <div id="sideMenu" class="side-menu">
        <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
        <a href="index.php">Principal</a>
        <a href="produtos.php">Produtos</a>
        <a href="sobre.php">Sobre</a>
    </div>

    <div class="principal">

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
            <div style="display: flex;justify-content: center;">
                <div id="message"></div> <!-- Exibe mensagens de erro ou sucesso -->
                <div class="loader" id="loader"></div> <!-- Animação de espera -->
            </div>
        </div>
    </div>
    <script src="./public/js/index.js" defer></script>
</body>
</html>
