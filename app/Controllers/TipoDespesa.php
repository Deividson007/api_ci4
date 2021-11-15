<?php namespace App\Controllers;

use App\Models\TipoDespesaModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class TipoDespesa extends BaseController {
    use ResponseTrait;

    public function get() {
        $tipoDespesaModel = new TipoDespesaModel();

        try {
            $data = $tipoDespesaModel->get();
    
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
        $tipoDespesaModel = new TipoDespesaModel();

        $input = $this->getRequestInput($this->request);

        try {
            $res = $tipoDespesaModel->insertOne($input);

            $data = $tipoDespesaModel->get();

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
        $tipoDespesaModel = new TipoDespesaModel();

        $input = $this->getRequestInput($this->request);

        try {
            $res = $tipoDespesaModel->updateOne($input["id"], ["descricao" => $input["descricao"]]);

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
        $tipoDespesaModel = new TipoDespesaModel();

        $input = $this->getRequestInput($this->request);

        try {
            $res = $tipoDespesaModel->deleteOne($input);

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