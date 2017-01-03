<?php

if (isset($_POST['nome']) and !empty($_POST['nome']) and
    isset($_POST['desc']) and !empty($_POST['desc']) and
    !empty($_POST['users']) and !empty($_POST['espaco'])
) {
  include_once './Banco.php';
  $b=new Banco();
  if ($b->alterarRecurso($_POST['id'], $_POST['nome'], $_POST['desc'], $_POST['situacao'], $_POST['users'], $_POST['espaco'],  moverArquivo())) {
    header("Location: ../index.php?pag=8&id={$_POST['id']}&status=s");
  }
  else {
    header("Location: ../index.php?pag=8&id={$_POST['id']}&status=erro");
  }
}
else {
  header("Location: ../index.php?pag=8&status=cad");
}
function moverArquivo(){
  if (isset($_FILES)) {
    if($_FILES['icone']['size']>0){
      $extencao=end(explode(".",$_FILES["icone"]["name"]));
      if ($extencao==="jpg" or $extencao==="png" or $extencao==="gif" or $extencao==="svg") {
        $pasta="../files/";
        $nome=aletorio();
        while (file_exists($pasta.$nome.".".$extencao)) {
          $nome=aletorio();
        }
        if (move_uploaded_file($_FILES['icone']['tmp_name'], $pasta.$nome.".".$extencao)) {
          echo $nome.".".$extencao;
          return $nome.".".$extencao;
        }
        else {
          die(header("Location: ../index.php?pag=8&id={$_POST['id']}&status=erroFile"));
        }
      }
      else {
        die(header("Location: ../index.php?pag=8&id={$_POST['id']}&status=notImg"));
      }
    }
  }
  else {
    return "";
  }
}

function aletorio(){
  $tamanho = mt_rand(5,9);
  $all_str = "abcdFefghijlkmGnopqrstuvxyzwABCDEFGHIJKLMNOPQReSTUVWXYZ1y234567890-";
  $nome = "";
  for ($i = 0;$i <= $tamanho;$i++){
     $nome .= $all_str[mt_rand(0,61)];
  }
  return $nome;
}
?>
