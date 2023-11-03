<?php

class Router {
    private $routes = [];

    public function addRoute($method, $path, $callback) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback
        ];
    }

    public function handleRequest() {
        $request_method = $_SERVER['REQUEST_METHOD'];
        $request_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            $pattern = $this->buildPattern($route['path']);

            if ($route['method'] === $request_method && preg_match($pattern, $request_path, $matches)) {
                array_shift($matches);
                $callback = $route['callback'];
                call_user_func_array($callback, $matches);
                return;
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }
    private function buildPattern($path) {
        return '~^' . preg_replace('/{([^\/]+)}/', '([^/]+)', $path) . '$~';
    }

    private function sendResponse($response) {
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
