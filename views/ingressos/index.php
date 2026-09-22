<?php

require_once __DIR__ . '/database/database.php';
require_once __DIR__ . '/database/eventos.php';
require_once __DIR__ . '/database/ingressos.php';
require_once __DIR__ . '/entidades/Ingresso.php';
require_once __DIR__ . '/controllers//ingressoSeeder.php';

function formatarDataHora(string $data): string
{
    return date('d/m/Y H:i', strtotime($data));
}

// Eventos disponíveis
$eventos = buscaEventos();

// Evento selecionado
$idEventoSelecionado = $_GET['evento'] ?? null;


// Ingressos do evento
$ingressos = [];

if (!empty($idEventoSelecionado)) {
    $ingressos = buscaIngressosPorEvento($idEventoSelecionado);
}


// Evento selecionado
$eventoSelecionado = null;

if (!empty($idEventoSelecionado)) {
    $eventoSelecionado = buscaEvento($idEventoSelecionado);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ingressos</title>

    <link rel="stylesheet" href="/public/css/ingressos.css">

</head>

<body>

    <main class="container">

        <div class="cabecalho">

            <div>
                <h1>Ingressos</h1>
                <p>Consulte os ingressos por evento.</p>
            </div>

        </div>


        <!-- Seleção do evento -->

        <section class="filtro">

            <label for="evento">
                Evento
            </label>

            <form method="GET">

                <select
    name="evento"
    id="evento"
    onchange="this.form.submit()"
>

    <option value="">
        Selecione um evento
    </option>

    <?php foreach ($eventos as $evento) { ?>

        <option
            value="<?= htmlspecialchars($evento->getId()) ?>"
            <?= $idEventoSelecionado === $evento->getId() ? 'selected' : '' ?>
        >

            <?= htmlspecialchars($evento->getNomeEvento()) ?>

        </option>

    <?php } ?>

</select>

            </form>

        </section>


        <?php if ($eventoSelecionado) { ?>

            <!-- Evento selecionado -->

            <section class="eventoSelecionado">

                <div>

                    <span class="label">
                        Evento selecionado
                    </span>

                    <h2>
                        <?= htmlspecialchars($eventoSelecionado->getNomeEvento()) ?>
                    </h2>

                </div>

                <div class="eventoData">

                    <span>
                        <?= htmlspecialchars(formatarDataHora($eventoSelecionado->getDataEvento())) . " ate " . htmlspecialchars(formatarDataHora($eventoSelecionado->getDataEventoFim()))?>
                    </span>

                </div>
    <button
        type="button"
        class="btnQrCode"
        onclick="abrirSeeder(
            '<?= htmlspecialchars($eventoSelecionado->getId(), ENT_QUOTES, 'UTF-8') ?>'
        )"
    >
        Criar Ingressos
    </button>
            </section>


            <!-- Tabela -->

            <section class="tabelaContainer">

                <?php if (!empty($ingressos)) { ?>

                    <table>

                        <thead>

                            <tr>

                                <th>CPF</th>

                                <th>Status</th>

                                <th>Quantidade</th>

                                <th>QR Code</th>

                                <th>Ações</th>

                            </tr>

                        </thead>

                        <tbody>

<?php foreach ($ingressos as $ingresso) { ?>

    <tr>

        <td>
            <?= htmlspecialchars($ingresso->getCpf()) ?>
        </td>

        <td>
            <?= htmlspecialchars((string) $ingresso->getStatus()) ?>
        </td>

        <td>
            <?= htmlspecialchars((string) $ingresso->getQtde()) ?>
        </td>

        <td>

            <button
                type="button"
                class="btnQrCode"
                onclick="mostrarQrCode(
                    '<?= htmlspecialchars($ingresso->getIdIngresso(), ENT_QUOTES) ?>'
                )"
            >
                Mostrar QR Code
            </button>

        </td>
<td>

</td>

    </tr>


    <tr
        id="qrcode-<?= htmlspecialchars($ingresso->getIdIngresso()) ?>"
        class="linhaQrCode"
    >

        <td colspan="5">

            <div class="qrCodeContainer">

                <div
                    class="qrcode"
                    data-codigo="<?= htmlspecialchars($ingresso->getIdIngresso()) ?>"
                ></div>

                <button
                    type="button"
                    onclick="fecharQrCode(
                        '<?= htmlspecialchars($ingresso->getIdIngresso(), ENT_QUOTES) ?>'
                    )"
                >
                    Fechar
                </button>

            </div>

        </td>

    </tr>

<?php } ?>

                        </tbody>

                    </table>

                <?php } else { ?>

                    <div class="semIngressos">

                        <p>
                            Nenhum ingresso cadastrado para este evento.
                        </p>

                    </div>

                <?php } ?>

            </section>

        <?php } else { ?>

            <div class="selecioneEvento">

                <h2>Selecione um evento</h2>

                <p>
                    Escolha um evento acima para visualizar seus ingressos.
                </p>

            </div>

        <?php } ?>

    </main>


    <!-- QR Code -->

    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>

    <script src="public/js/ingressos.js"></script>

</body>

</html>