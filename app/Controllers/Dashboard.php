<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController {
    use ResponseTrait;

    public function index() {
        return $this->getResponse(["mensagem" => "OK"], ResponseInterface::HTTP_OK);
    }
}