<?php namespace App\Controllers;

use App\Models\StatusModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Status extends BaseController 
{
    use ResponseTrait;
    
    public function get() {
        $statusModel = new StatusModel();

        try {
            $data = $statusModel->get();
    
            return $this->getResponse(
                [
                    "status" => ResponseInterface::HTTP_OK,
                    "error" => null,
                    "data" => $data,
                    "messages" => [
                        "success" => count($data) > 1 ? "ok" : "Nenhum registro encontrado."
                    ]
                ]
            );
        } 
        catch (Exception $exception) {
            return $this->getResponse(
                [
                    "error" => $exception->getMessage(),
                ],
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
    }

    public function insert() {
        $statusModel = new StatusModel();

        $input = $this->getRequestInput($this->request);

        try {
            $res = $statusModel->insertOne($input);

            $data = $statusModel->get();

            return $this->getResponse(
                [
                    "status" => $res ? ResponseInterface::HTTP_OK : ResponseInterface::HTTP_BAD_REQUEST,
                    "error" => null,
                    "data" => $data,
                    "messages" => [
                        "success" => $res ? "ok" : "Não foi possível realizar a solicitação."
                    ]
                ]
            );
        }
        catch (Exception $exception) {
            return $this->getResponse(
                [
                    "error" => $exception->getMessage(),
                ],
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
    }

    public function update() {
        $statusModel = new StatusModel();

        $input = $this->getRequestInput($this->request);

        try {
            $res = $statusModel->updateOne($input["id"], ["descricao" => $input["descricao"]]);

            return $this->getResponse(
                [
                    "status" => $res ? ResponseInterface::HTTP_OK : ResponseInterface::HTTP_BAD_REQUEST,
                    "error" => null,
                    "data" => null,
                    "messages" => [
                        "success" => $res ? "ok" : "Não foi possível realizar a solicitação."
                    ]
                ]
            );
        }
        catch (Exception $exception) {
            return $this->getResponse(
                [
                    "error" => $exception->getMessage(),
                ],
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
    }

    public function delete() {
        $statusModel = new StatusModel();

        $input = $this->getRequestInput($this->request);

        try {
            $res = $statusModel->deleteOne($input);

            return $this->getResponse(
                [
                    "status" => $res ? ResponseInterface::HTTP_OK : ResponseInterface::HTTP_BAD_REQUEST,
                    "error" => null,
                    "data" => null,
                    "messages" => [
                        "success" => $res ? "ok" : "Não foi possível realizar a solicitação."
                    ]
                ]
            );
        }
        catch (Exception $exception) {
            return $this->getResponse(
                [
                    "error" => $exception->getMessage(),
                ],
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
    }
}