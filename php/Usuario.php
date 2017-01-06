<?php

class Usuario {

    private $nome, $id, $login, $mail, $situacao, $perfil;

    function __construct( $id, $login,$nome, $mail, $perfil, $situacao) {
        $this->nome = $nome;
        $this->id = $id;
        $this->login = $login;
        $this->mail = $mail;
        $this->situacao = $situacao;
        $this->perfil= $perfil;
    }
    public function __get($param) {
        return $this->$param;
    }

    public function __set($name, $value) {
        $this->$name=$value;
    }

    public function __toString() {
        return "<tr>
                  <td>$this->nome</td>
                  <td>$this->login</td>
                  <td>$this->mail</td>
                  <td>".(($this->perfil==1) ? "Administrador" : "Usuário")."</td>
                  <td>".(($this->situacao==1) ? "Ativo" : "Inativo")."</td>
                  <td class='editar_table'><a href=\"index.php?pag=2&id=$this->id\"><i class=\"fa fa-edit fa-fw\"></i></a></td>
                  <td class='editar_table'><a href=\"index.php?pag=16&tipo=1&id=$this->id\"><i class=\"fa fa-eye fa-fw\"></i></a></td>
                </tr>";

    }
}
?>
