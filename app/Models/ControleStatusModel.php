<?php namespace App\Models;

use CodeIgniter\Model;

class ControleStatus extends Model {
    protected $table = "controle.status";
    protected $primaryKey = "idstatus";
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