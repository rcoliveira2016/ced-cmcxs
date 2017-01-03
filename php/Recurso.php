<?php

class Recurso{

    private $nome, $id, $icone, $desc, $situacao;

    function __construct( $id,$nome, $desc, $icone, $situacao) {
        $this->nome = $nome;
        $this->id = $id;
        $this->desc = $desc;
        $this->icone = $icone;
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
        return "<tr>
                  <td>$this->nome</td>
                  <td>".(($this->situacao==1) ? "Ativo" : "Inativo")."</td>
                  <td><img src='./files/$this->icone'/></td>
                  <td class='editar_table'><a href=\"index.php?pag=8&id=$this->id\"><i class=\"fa fa-edit fa-fw\"></i></a></td>
                  <td class='editar_table'><a href=\"index.php?pag=16&tipo=4&id=$this->id\"><i class=\"fa fa-eye fa-fw\"></i></a></td>
                </tr>";

    }
}
?>
