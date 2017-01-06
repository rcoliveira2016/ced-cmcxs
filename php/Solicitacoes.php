<?php

class Solicitacoes {

    private $id, $user, $espaco, $categoria, $solicitante, $data, $h_inicial, $h_final, $assunto, $desc, $cor,$size, $div, $interno, $mostrar;

    function __construct($id, $user, $espaco, $categoria, $solicitante, $data, $h_inicial, $h_final, $assunto, $desc, $interno) {
        $this->user = $user;
        $this->id = $id;
        $this->espaco = $espaco;
        $this->categoria = $categoria;
        $this->solicitante = $solicitante;
        $this->data =$data ;
        $this->h_inicial = $h_inicial;
        $this->h_final = $h_final;
        $this->assunto = $assunto;
        $this->desc = $desc;
        $this->interno = $interno;
    }

    public function __get($param) {
        return $this->$param;
    }

    public function __set($name, $value) {
        $this->$name=$value;
    }

    public function __toString() {
        return "<td>id:$this->id-</td>
        <td>data:$this->data-</td>
        <td>h:$this->h_inicial-</td>
        <td>h:$this->h_final-</td>
        <td>Div:$this->div-</td>
        <td>SIZE:$this->size-</td>
        <td>$this->assunto-</td>";

    }
}
?>
