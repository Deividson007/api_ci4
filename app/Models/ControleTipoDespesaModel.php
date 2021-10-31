<?php namespace App\Models;

use CodeIgniter\Model;

class TipoDespesa extends Model {
    protected $table = "controle.tipodespesa";
    protected $primaryKey = "idtipodespesa";
    protected $allowedFields = ["descricao"];
    protected $validationRules = [
        "descricao" => "required"
    ];

    public function get() {
        $this->findAll();
    }

    public function remove($id) {
        $this->update($id, ["ativo" => false]);
    }
}