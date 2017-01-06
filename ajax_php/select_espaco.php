<?php
include_once '../php/Recurso.php';
include_once "../php/Banco.php";
$b=new Banco();
$s=$b->get_recurso_espaco($_POST['id']);
if (!empty($s)) {
  foreach ($s as $value) {
    echo "<option value=".$value->id.">$value->nome</option>";
  }
}else {
  echo "<option>Não existe nenhum recurso atrelado com este espaço</option>";
}
?>
