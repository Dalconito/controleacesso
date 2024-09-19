    <style>
        li{list-style: none; text-decoration: none;}

.listaMenu{display: flex; padding: 20px; margin: 0 auto;
    text-align: center; font-size: 1.5rem;
    background-color: rgb(0, 0, 106);gap: 30px;}

.listaMenu > li> a {color: white; font-weight: bolder;}
.listaMenu > li {width: 25%;}

a:link, a:visited{ text-decoration: none;}

.divMenu{display: flex}

.divMenu>a {padding: 20px; background-color: blue;
    font-weight: bolder; text-align: center;}

.listaNav{width: 50%; margin: 0 auto;}

    </style>
<div class="divMenu">
    <a href="index.php">Logo</a>
    <nav class="listaNav">
        <ul class="listaMenu">
            <li><a href="index.php">Principal</a></li>
            <li><a href="produtos.php">Produtos</a></li>
            <li><a href="sobre.php">Sobre</a></li>
            <li><a onclick="logout()">logout</a></li>
        </ul>
    </nav>
</div>