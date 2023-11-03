<?php

require_once(__DIR__ . '/../ApiClient.php');

class ProjectsApi extends ApiClient
{

    public function index()
    {
        $response = $this->get('projects');

        if (isset($response['error'])) {
            echo 'Error: ' . $response['error'];
        } else {
            echo json_encode($response);
        }
    }
    public function pagination($id) {
        $response = $this->get('projects?page[number]='.$id);
        if (isset($response['error'])) {
            echo 'Error: ' . $response['error'];
        } else {
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }

    public function view($id) {
        $response = $this->get('projects/'.$id);
        if (isset($response['error'])) {
            echo 'Error: ' . $response['error'];
        } else {
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }
}
