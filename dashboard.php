<?php
session_start();
require_once "./database/database.php";
require_once "./controllers/CEQr.php";
require_once "./database/eventos.php";

if ($_SESSION) {
    $loginSession = $_SESSION['login'];
    $cpfSession = $_SESSION['cpf'];
} else {
    header('location: ./index.php');
    exit;
}

$selectIngressos = buscarCodigosQr($cpfSession);
$eventosDisponiveis = buscaEventos();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./public/css/dashboard.css">
    <link rel="stylesheet" href="./public/css/agenda.css">

</head>

<body>

    <?php require_once "./templates/menu.php"; ?>

    <h1>Olá <?= htmlspecialchars($loginSession) ?></h1>

    <?php require "./templates/agenda.php"; ?>

    
    <h2>Eventos Disponíveis</h2>

    <table>
    <thead>
        <tr>
            <th>Nome do Evento</th>
            <th>Responsável</th>
            <th>Data de Início</th>
            <th>Data de Término</th>
            <th>Endereço</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>

        <?php if (!empty($eventosDisponiveis)): ?>

            <?php foreach ($eventosDisponiveis as $e): ?>

                <tr>
                    <td>
                        <?= htmlspecialchars($e->getNomeEvento()) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($e->getNomeResponsavel()) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($e->getDataEvento()) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($e->getDataEventoFim()) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($e->getEndereco()) ?>
                    </td>

                    <td>
                        <button type="button">
                            Participar
                        </button>
                    </td>
                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="6">
                    Nenhum evento disponível.
                </td>
            </tr>

        <?php endif; ?>

    </tbody>
</table>


    <div id="resultado"></div>

    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    <script src="./public/js/dashboard.js"></script>

</body>

</html>