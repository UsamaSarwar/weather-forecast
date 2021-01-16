<?php

namespace Fir\Controllers;

class Requests extends Controller {

    /**
     * @var object
     */
    protected $model;

    public function index() {
        redirect();
    }

    public function search() {
        $model = $this->model('Requests');

        // Get the available locations
        $data['results'] = $model->getLocations($_POST);
        $data['query'] = $_POST['location'];

        return ['search-results' => $this->view->render($data, 'requests/search')];
    }
}