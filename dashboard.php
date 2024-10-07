<?php
session_start();
require_once "./controllers/dashboardController.php";
require_once "./controllers/verificaAPI.php";
$loginSession = $_SESSION['login'];
$cpfSession = $_SESSION['cpf'];
if (isset($_POST)) {
    $selectIngressos = selectPorCpf($cpfSession);
}
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

    <form method="post">
        <label for="idIngresso" id="idIngresso">Digite o número do Pedido sem a Hashtag</label>
        <input type="text" name="idIngresso" >
        <input type="submit" value="Gerar QrCode">
    </form>
    <form id="gerarQrCode">
        <label>Confira os QrCode existentes</label>
        <input type="submit" value="Exibir QrCode">
    </form>

    <table>
        <tr>
            <th>Nome</th>
            <th>Status</th>
            <th>Quantidade</th>
            <th>ID</th>
            <th>Ações</th>
        </tr>

        <?php if (isset($selectIngressos) && !empty($selectIngressos)) {
            foreach ($selectIngressos as $ingressos) {
                // Define a classe para o status
                $statusClass = ($ingressos['status'] == 9) ? 'status-9' : 'status-other'; ?>
                <tr>
                    <td><?php echo htmlspecialchars($ingressos['nome']); ?></td>
                    <td class="<?php echo $statusClass; ?>"><?php echo htmlspecialchars($ingressos['status']); ?></td>
                    <td><?php echo htmlspecialchars($ingressos['qtde']); ?></td>
                    <td><?php echo htmlspecialchars($ingressos['ingresso']); ?></td>
                    <td>
                        <button onclick="selecionar(this, '<?php echo $cpfSession;?>')">Exibir QrCode</button>
                        <a href="./adicionarAutQr.php?<?php echo "cpf=" . $cpfSession . "&idIngresso=" . $ingressos['ingresso']?>" >ADICIONAR QRCODE</a>
                        <button onclick="exibindo('<?php echo $cpfSession; ?>', '<?php $ingressos['ingresso']; ?>')">Exibir Teste</button>
                    </td>
                </tr>
        <?php } } else { ?>
            <tr>
                <td colspan="4">Nenhum dado a ser mostrado</td>
            </tr>
        <?php } ?>
    </table>
    <div id="resultado"></div>
    <script src="./public/js/dashboard.js" defer></script>
</body>
</html>
