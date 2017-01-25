<?php

class Solicitantes {

    private $nome, $id, $mail, $cpf, $cnpj, $situacao, $telefone, $contato, $endereco, $descricao;

    function __construct($id, $nome, $mail, $cpf, $cnpj, $situacao, $telefone, $contato, $descricao, $endereco) {
        $this->nome = $nome;
        $this->id = $id;
        $this->mail = $mail;
        $this->situacao = $situacao;
        $this->cpf = $cpf;
        $this->cnpj = $cnpj;
        $this->telefone = $telefone;
        $this->contato = $contato;
        $this->descricao = $descricao;
        $this->endereco = $endereco;
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
                  <td>$this->mail</td>
                  <td>".(($this->cpf==0) ? "" : $this->cpf)."</td>
                  <td>$this->cnpj</td>
                  <td>".(($this->situacao==1) ? "Ativo" : "Inativo")."</td>
                  <td>$this->telefone</td>
                  <td>$this->contato</td>
                  <td class='editar_table'><a href=\"index.php?pag=10&id=$this->id\"><i class=\"fa fa-edit fa-fw\"></i></a></td>
                  <td class='editar_table'><a href=\"index.php?pag=16&tipo=5&id=$this->id\"><i class=\"fa fa-eye fa-fw\"></i></a></td>
                </tr>";

    }
}
?>
