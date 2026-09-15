<?php
session_start();
require_once "./database/database.php";
require_once "./controllers/CEQr.php";

if ($_SESSION) {
    $loginSession = $_SESSION['login'];
    $cpfSession = $_SESSION['cpf'];
} else {
    header('location: ./index.php');
}
$selectIngressos = buscarCodigosQr($cpfSession);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./public/css/dashboard.css">
</head>

<body>
    <?php require_once "./templates/menu.php"; ?>
    <h1>Olá <?php echo $loginSession ?></h1>

    <table>
        <tr>
            <th>Nome</th>
            <th>Status</th>
            <th>Quantidade</th>
            <th>QrCode</th>
            <th>Ações</th>
        </tr>

        <?php if (isset($selectIngressos) && !empty($selectIngressos)) {
            foreach ($selectIngressos as $ingressos) {
                // Define a classe para o status 
        ?>
                <tr>
                    <td><?php echo htmlspecialchars($ingressos->getIdIngresso()); ?></td>
                    <td class="status"><?php echo htmlspecialchars($ingressos->getStatus()); ?></td>
                    <td><?php echo htmlspecialchars($ingressos->getQtde()); ?></td>
                    <td>
                        <div
                            class="qrcode"
                            data-codigo="<?= htmlspecialchars($ingressos->getIdIngresso()) ?>"></div>
                    </td>
                    <td></td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="4">Nenhum dado a ser mostrado</td>
            </tr>
        <?php } ?>
    </table>
    <div id="resultado"></div>
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    <script src="./public/js/dashboard.js"></script>
</body>

</html>