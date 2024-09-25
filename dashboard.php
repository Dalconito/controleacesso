<?php
session_start();
require_once "./controllers/dashboardController.php";
require_once "./controllers/verificaAPI.php";
$loginSession = $_SESSION['login'];
$cpfSession = $_SESSION['cpf'];
if(isset($_POST)){
    $selectIngressos = selectPorCpf($cpfSession);

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php require_once "./templates/menu.php"; ?>
    <h1>Olá <?php echo $loginSession ?></h1>
    <button id="botaoEnvia">Enviar Dados</button>

    <form method="post">
        <label for="idIngresso" id="idIngresso">Digite o numero do Pedido sem a Hashtag</label>
        <input type="text" name="idIngresso" >

        <input type="submit" value="Gerar QrCode">
    </form>
    <form id="gerarQrCode">
        <label>Confira os QrCode existentes</label>
        <input type="submit" value="Exibir QrCode">
    </form>

    <?php
        foreach($selectIngressos as $key){ ?>
        <tr>
            <td>Ingresso n°: <?php var_dump($key) ?></td>
        </tr>
    <?php }?>
    <script src="./public/js/dashboard.js" defer></script>
</body>
</html>
<?php
    //captura os dados via post
    /*$postData = isset($_POST) ? $_POST : null;  
    if(isset($_POST['idIngresso'])){
        $stringHash = $loginSession . $cpfSession . $postData['idIngresso'];
        $idIngresso = $postData['idIngresso'];
        $secretKey = "fabricad";
        $criptografado = hash_hmac("sha256", $stringHash, $secretKey);
        if($criptografado != null) {verificarIntegridade($cpfSession, $criptografado, $idIngresso);}
    }*/

?>