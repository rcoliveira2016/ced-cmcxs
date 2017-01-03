?php
  if (isset($_POST['nome']) and !empty($_POST['nome']) and
      isset($_POST['desc']) and !empty($_POST['desc']) and
      !empty($_POST['users']) and !empty($_POST['espaco'])
  ) {
    include_once './Banco.php';
    $b=new Banco();
    if ($b->validaRecurso($_POST['nome'])) {
      $nomeArquivo=moverArquivo();
      if ($b->cadastraRecurso($_POST['nome'], $_POST['desc'], $_POST['situacao'], $_POST['users'], $_POST['espaco'],$nomeArquivo)) {
        header("Location: ../index.php?pag=8&status=s");
      } else {
        header("Location: ../index.php?pag=8&status=erro");
      }
    }
    else {
      header("Location: ../index.php?pag=8&status=advalidar");
    }
  }

  function moverArquivo(){
    if (isset($_FILES) and $_FILES['icone']['size']>0) {
      $extencao=end(explode(".",$_FILES["icone"]["name"]));
      if ($extencao==="jpg" or $extencao==="png" or $extencao==="gif" or $extencao==="svg") {
        $pasta="../files/";
        $nome=aletorio();
        while (file_exists($pasta.$nome.".".$extencao)) {
          $nome=aletorio();
        }
        echo  $pasta.$nome;
        if (move_uploaded_file($_FILES['icone']['tmp_name'], $pasta.$nome.".".$extencao)) {
          return $nome.".".$extencao;
        }else {
          die(header("Location: ../index.php?pag=8&status=erroFile"));
        }
      }
      else {
        die(header("Location: ../index.php?pag=8&status=notImg"));
      }
    }
    else {
      die(header("Location: ../index.php?pag=8&status=erroFile"));
    }
  }

  function aletorio(){
    $tamanho = mt_rand(5,9);
    $all_str = "abcdefghijlkmnopqrstuvxyzwABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $nome = "";
    for ($i = 0;$i <= $tamanho;$i++){
       $nome .= $all_str[mt_rand(0,61)];
    }
    return $nome;
  }
 ?>
