<?php namespace App\Models;

use CodeIgniter\Model;
use Exception;

class UsuarioModel extends Model {
    protected $table = "usuario.usuario";
    protected $primaryKey = "idusuario";
    protected $allowedFields = ["username", "pass", "email"];
    protected $validationRules = [
        "username" => "required",
        "pass" => "required",
        "email" => "required"
    ];
    protected $beforeInsert = ["beforeInsert"];

    protected function beforeInsert(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    private function getUpdatedDataWithHashedPassword(array $data): array
    {
        if (isset($data["data"]["pass"])) {
            $plaintextPassword = $data["data"]["pass"];
            $data["data"]["pass"] = $this->hashPassword($plaintextPassword);
        }
        return $data;
    }

    private function hashPassword(string $plaintextPassword): string
    {
        return hash("sha512", $plaintextPassword);
    }

    public function getAll() {
        return $this->findAll();
    }

    public function getOne($id) {
        return $this->getWhere(["idusuario" => $id])->getResult();
    }

    public function getUserByEmail($email) {
        $usuario = $this
                ->asArray()
                ->Where(["email" => $email])
                ->first();
        if (!$usuario) 
            throw new Exception("Não existe usuário para o endereço de e-mail especificado");
    
        return $usuario;
    }

    public function updateOne($id, $data) {
        return $this->update($id, $data);
    }

    public function checkExists($email) {
        return (bool) count($this->getWhere(["email" => $email])->getResult());
    }

    public function findUserByEmailPass($email, $pass) {
        return $this
                ->asArray()
                ->Where(["email" => $email, "pass" => $this->hashPassword($pass)])
                ->first();
    }
}