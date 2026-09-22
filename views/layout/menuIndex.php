    <style>
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
    transition: background 0.3s;
    position: fixed; /* Fixa o botão na tela */
    top: 20px; /* Ajusta a posição superior */
    right: 20px; /* Ajusta a posição à direita */
    z-index: 999; /* Assegura que o botão fique sobre o menu */
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

/* Ajusta o botão de menu para garantir que ele não ocupe toda a largura da página */
.menu-btn {
    width: auto; /* Garante que o botão tenha apenas o tamanho necessário */
    height: auto;
    padding: 10px 20px; /* Ajuste o padding para o tamanho desejado do botão */
}

    </style>
    <button class="menu-btn" onclick="openMenu()">☰</button>
    
    <!-- Menu lateral direito -->
    <div id="sideMenu" class="side-menu">
        <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
        <a href="index.php">Principal</a>
        <a href="produtos.php">Produtos</a>
        <a href="sobre.php">Sobre</a>
        <a onclick="logout()">Sobre</a>
    </div>

    <script>
        function openMenu() {
    document.getElementById("sideMenu").style.width = "250px";
    document.body.classList.add("menu-open");
}

// Função para fechar o menu lateral
function closeMenu() {
    document.getElementById("sideMenu").style.width = "0";
    document.body.classList.remove("menu-open");
}
    </script>