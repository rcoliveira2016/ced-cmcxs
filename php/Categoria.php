<?php

class Categoria{

    private $nome, $id, $situacao, $espaco, $validar;

    function __construct( $id,$nome, $espaco, $situacao, $validar) {
        $this->nome = $nome;
        $this->id = $id;
        $this->validar = $validar;
        $this->situacao = $situacao;
        $this->espaco = $espaco;
    }

    public function __get($param) {
        return $this->$param;
    }

    public function __set($name, $value) {
        $this->$name=$value;
    }

    public function add_users($u){
      $this->users=$u;
    }

    public function __toString() {
        return "<tr>
                  <td>$this->nome</td>
                  <td>$this->espaco</td>
                  <td>".(($this->situacao==1) ? "Ativo" : "Inativo")."</td>
                  <td>".(($this->validar==1) ? "Sim" : "Não")."</td>
                  <td class='editar_table'><a href=\"index.php?pag=6&id=$this->id\"><i class=\"fa fa-edit fa-fw\"></i></a></td>
                </tr>";

    }
}
?>
