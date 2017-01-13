<?php

class Espaco {

    private $nome, $id, $cor, $desc, $users, $situacao;

    function __construct( $id,$nome, $desc, $cor, $situacao) {
        $this->nome = $nome;
        $this->id = $id;
        $this->desc = $desc;
        $this->cor = $cor;
        $this->situacao = $situacao;
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
        return "<tr value='$this->id'>
                  <td style='background:$this->cor'></td>
                  <td>$this->nome</td>
                  <td>".(($this->situacao==1) ? "Ativo" : "Inativo")."</td>
                  <td class='editar_table'><a href=\"index.php?pag=4&id=$this->id\"><i class=\"fa fa-edit fa-fw\"></i></a></td>
                  <td class='editar_table'><a href=\"index.php?pag=16&tipo=2&id=$this->id\"><i class=\"fa fa-eye fa-fw\"></i></a></td>
                </tr>";

    }
}
?>
