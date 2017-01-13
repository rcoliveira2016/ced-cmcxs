<?php
include_once '../php/Solicitantes.php';
include_once '../php/Solicitacoes.php';
include_once '../php/Recurso.php';
include_once '../php/Espaco.php';
include_once "../php/Banco.php";
$b=new Banco();
$s=$b->getSolicitacoesId($_POST['id']);
if (!empty($s)) {
  $recurso=$b->get_rel_solicitacoes($_POST['id']);
  $espaco=$b->getEspacoId($s->espaco)->nome;
  $solicitante=$b->getSolicitantesId($s->solicitante)->nome;
  $desc=($s->desc!=" ")? "<p><strong>Descrição</strong>: $s->desc</p>" : "";
  echo "<p><strong>Nº</strong>: $s->id</p>
        <p><strong>Data</strong>: $s->data</p>
        <p><strong>Hora Inicial</strong>: $s->h_inicial</p>
        <p><strong>Hora Final</strong>: $s->h_final</p>
        <p><strong>Solicitante</strong>: $solicitante</p>
        <p><strong>Espaço</strong>: $espaco</p>
        $desc
        ";
  if (!empty($recurso)) {
    echo "<p><strong>Recursos :</strong></p>";
    foreach ($recurso as $value) {
      if ($value->situacao==1) {
        echo "<p><img src='./files/$value->icone' /> - $value->nome</p>";
      }
    }
  }

}
?>
