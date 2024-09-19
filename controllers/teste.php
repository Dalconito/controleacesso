<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Lateral Direito</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Menu lateral (inicialmente oculto à direita) */
        .side-menu {
            height: 100%; /* Altura do menu igual à altura da página */
            width: 0; /* Inicialmente escondido */
            position: fixed; /* Fixa o menu na lateral direita */
            top: 0;
            right: 0; /* Alinhado à direita */
            background-color: rgb(0, 0, 106); /* Cor de fundo */
            overflow-x: hidden; /* Não mostra rolagem horizontal */
            transition: 0.5s; /* Transição suave ao abrir/fechar */
            padding-top: 60px; /* Espaço superior */
            z-index: 1000; /* Assegura que o menu fique sobre outros elementos */
        }

        /* Links do menu */
        .side-menu a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 1.5rem;
            color: white;
            display: block;
            transition: 0.3s;
        }

        /* Efeito ao passar o mouse */
        .side-menu a:hover {
            background-color: #5757d1;
        }

        /* Botão para abrir o menu */
        .menu-btn {
            font-size: 1.5rem;
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            position: fixed; /* Fixa o botão na tela */
            top: 20px; /* Ajusta a posição superior */
            right: 20px; /* Ajusta a posição à direita */
        }

        .menu-btn:hover {
            background-color: #5757d1;
        }

        /* Botão para fechar o menu */
        .close-btn {
            position: absolute;
            top: 10px;
            left: 25px; /* Dentro do menu */
            font-size: 2rem;
            color: white;
            cursor: pointer;
        }

        /* Ajustes para o layout principal quando o menu está fechado */
        .main-content {
            transition: margin-right 0.5s;
        }

        /* Ajustes para o layout principal quando o menu está aberto */
        .menu-open .main-content {
            margin-right: 250px; /* Move o conteúdo principal para dar espaço ao menu */
        }
    </style>
</head>
<body>

    <!-- Botão para abrir o menu lateral -->
    <button class="menu-btn" onclick="openMenu()">☰ Abrir Menu</button>

    <!-- Menu lateral direito -->
    <div id="sideMenu" class="side-menu">
        <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
        <a href="index.php">Principal</a>
        <a href="produtos.php">Produtos</a>
        <a href="sobre.php">Sobre</a>
        <a onclick="logout()">Logout</a>
    </div>


    <script>
        // Função para abrir o menu lateral
        function openMenu() {
            document.getElementById("sideMenu").style.width = "250px";
            document.body.classList.add("menu-open");
        }

        // Função para fechar o menu lateral
        function closeMenu() {
            document.getElementById("sideMenu").style.width = "0";
            document.body.classList.remove("menu-open");
        }

        // Função de logout (simples exemplo)
        function logout() {
            alert("Você saiu com sucesso!");
            // Adicione a lógica de logout aqui
        }
    </script>

</body>
</html>
