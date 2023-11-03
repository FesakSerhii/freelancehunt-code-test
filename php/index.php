<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
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
