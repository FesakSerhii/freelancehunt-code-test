<?php

header("Access-Control-Allow-Origin: http://localhost:5173"); // Замініть на фактичний домен вашого клієнта

header("Access-Control-Allow-Credentials: true");

header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}


require_once './routes/Router.php';
require_once './app/Controllers/Api/Projects/ProjectsApi.php';


$router = new Router();
$apiProjects = new ProjectsApi();

$router->addRoute('GET', '/api/projects', function () use ($apiProjects) {
    return $apiProjects->index();
});
$router->addRoute('GET', '/api/projects/page-{id}', function ($id) use ($apiProjects) {
    return $apiProjects->pagination($id);
});

$router->addRoute('GET', '/api/projects/{id}', function ($id) use ($apiProjects) {
    return $apiProjects->view($id);
});


$router->handleRequest();
