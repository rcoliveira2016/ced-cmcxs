<?php
  include_once '../php/Banco.php';
  $b=new Banco();
  if(!isset($_POST['id'])){
    $ret=$b->validarHoraBanco($_POST['hora_f'], $_POST['hora_i'], $_POST['esp'], $_POST['data']);
  }else{
    $ret=$b->validarHoraBancoAlterar($_POST['hora_f'], $_POST['hora_i'], $_POST['esp'], $_POST['data'], $_POST['id']);
  }
  echo ($ret)? "1": "0";
?>
