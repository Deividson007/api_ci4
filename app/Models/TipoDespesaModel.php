<?php namespace App\Models;

use CodeIgniter\Model;

class TipoDespesaModel extends Model {
    protected $table = "controle.tipodespesa";
    protected $primaryKey = "idtipodespesa";
    protected $allowedFields = ["descricao"];
    protected $validationRules = [
        "descricao" => "required"
    ];

    public function get() {
        return $this->findAll();
    }

    public function getOne($id) {
        return $this->getWhere(["idtipodespesa" => $id])->getResult();
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