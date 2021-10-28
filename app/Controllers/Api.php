<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsuarioModel;

class Api extends ResourceController {
    use ResponseTrait;

    public function index() {
        $model = new UsuarioModel();

        $data = $model->get();

        return $this->respond($data);
    }
}