<?php

return [
    'POST /api/v1/auth/login' =>
    __DIR__ . '/../api/v1/auth/login/index.php',

    'POST /api/v1/auth/logout' =>
    __DIR__ . '/../api/v1/auth/logout/index.php',

    'POST /api/v1/auth/signup' =>
    __DIR__ . '/../api/v1/auth/signup/index.php',

    'POST /api/v1/eventos' =>
    __DIR__ . '/../api/v1/eventos/create/index.php',

    'POST /api/v1/ingressos' =>
    __DIR__ . '/../api/v1/ingressos/create/index.php',

    'POST /api/v1/ingressos/seeder' =>
    __DIR__ . '/../api/v1/ingressos/seeder.php',
];
