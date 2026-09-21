<?php

$eventosAgenda = [];

foreach ($eventosDisponiveis as $evento) {

    $eventosAgenda[] = [
        'title' => $evento->getNomeEvento(),
        'start' => $evento->getDataEvento(),
        'end' => $evento->getDataEventoFim(),

        'extendedProps' => [
            'responsavel' => $evento->getNomeResponsavel(),
            'endereco' => $evento->getEndereco()
        ]
    ];
}

?>

<section class="agenda-container">

    <h2>Agenda</h2>

    <div id="agenda"></div>

</section>


<div id="modalEvento" class="modal-evento">

    <div class="modal-evento-conteudo">

        <button
            type="button"
            id="fecharModalEvento"
            class="modal-evento-fechar">
            &times;
        </button>

        <h2 id="modalEventoNome"></h2>

        <div class="modal-evento-info">

            <div class="modal-evento-item">
                <strong>Início</strong>
                <span id="modalEventoInicio"></span>
            </div>

            <div class="modal-evento-item">
                <strong>Término</strong>
                <span id="modalEventoFim"></span>
            </div>

            <div class="modal-evento-item">
                <strong>Responsável</strong>
                <span id="modalEventoResponsavel"></span>
            </div>

            <div class="modal-evento-item">
                <strong>Endereço</strong>
                <span id="modalEventoEndereco"></span>
            </div>

        </div>

    </div>

</div>


<script>
    window.eventosAgenda = <?= json_encode(
        $eventosAgenda,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    ) ?>;
</script>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js"></script>

<script src="./public/js/agenda.js"></script>