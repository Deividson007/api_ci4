<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Auth extends BaseController
{
    use ResponseTrait;

    public function register()
    {
        $rules = [
            "username" => "required",
            "email" => "required",
            "pass" => "required"
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $usuarioModel = new UsuarioModel();

        if ($usuarioModel->checkExists($input["email"])) {
            return $this->failResourceExists("Usuário já existe.", "409", "Usuário já existe.");
        }

        $usuarioModel->save($input);

        return $this->getJWTForUser($input["email"], ResponseInterface::HTTP_CREATED);
    }

    public function login()
    {
        $rules = [
            "email" => "required",
            "pass" => "required"
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $usuarioModel = new UsuarioModel();

        $usuario = $usuarioModel->findUserByEmailPass($input["email"], $input["pass"]);

        if ($usuario == null) {
            return $this->getResponse(
                [
                    "status" => 401,
                    "error" => null,
                    "messages" => [
                        "text" => "Email ou senha incorretos."
                    ]
                ], ResponseInterface::HTTP_UNAUTHORIZED);
        }

        return $this->getJWTForUser($input['email']);
    }

    private function getJWTForUser(string $emailAddress, int $responseCode = ResponseInterface::HTTP_OK)
    {
        try {
            $model = new UsuarioModel();
            $user = $model->getUserByEmail($emailAddress);
            unset($user["pass"]);

            helper("jwt");

            return $this
                ->getResponse(
                    [
                        "status" => $responseCode,
                        "error" => null,
                        "messages" => [
                            "success" => $responseCode === 201 ? "Usuário incluído." : "Usuário logado"
                        ],
                        "user" => $user,
                        "access_token" => getSignedJWTForUser($emailAddress)
                    ]
                );
        } catch (Exception $exception) {
            return $this
                ->getResponse(
                    [
                        "error" => $exception->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
}
