<?php namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model {
    protected $table = "controle.status";
    protected $primaryKey = "idstatus";
    protected $allowedFields = ["descricao"];
    protected $validationRules = [
        "descricao" => "required"
    ];

    public function get() {
        return $this->findAll();
    }

    public function getOne($id) {
        return $this->getWhere(["idstatus" => $id])->getResult();
    }

    public function updateOne($id, $data) {
        return $this->update($id, $data);
    }

    public function insertOne($dados) {
        return $this->save($dados);
    }

    public function deleteOne($id) {
        return $this->update($id, ["ativo" => false]);
    }
}