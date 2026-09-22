<?php

class Router
{
    private array $routes = [];

    public function add(string $method, string $path, string $file): void
    {
        $this->routes[$method][$path] = $file;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

        $route = $this->routes[$method][$uri] ?? null;

        if (!$route) {
            http_response_code(404);

            echo json_encode([
                'erro' => 'Rota não encontrada.'
            ]);

            return;
        }

        if (!file_exists($route)) {
            http_response_code(500);

            echo json_encode([
                'erro' => 'Arquivo da rota não encontrado.'
            ]);

            return;
        }

        require $route;
    }
}
