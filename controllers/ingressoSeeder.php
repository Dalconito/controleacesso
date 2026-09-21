<?php
require_once __DIR__ . '/CEQr.php';
require_once __DIR__ . '/../entidades/Ingresso.php';


function ingressoSeeder(int $qtdeIngressos, string $idEvento){
    for ($a=1; $a <= $qtdeIngressos; $a++) {

    $novoIngresso = new Ingresso(
        $a,
        $idEvento,
        1,
    );

    createQrCode($novoIngresso);
    }
}