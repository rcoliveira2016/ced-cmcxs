<?php
  if (!empty($_GET)) {
    if (isset($_GET['type']) and $_GET['type']=='x12x') {
      if (isset($_POST['id']) and isset($_POST['perfil'])  and isset($_POST['situacao'])) {
        cadastraAlterar();
      }else {
        header("Location: ../index.php?pag=2&id={$_POST['id']}&status=cad");
      }
    }
    elseif (isset($_GET['type']) and $_GET['type']=='x22x') {
      if (isset($_POST['nome']) and !empty($_POST['nome']) and isset($_POST['cor']) and !empty($_POST['cor']) and isset($_POST['desc']) and !empty($_POST['desc']) and !empty($_POST['users']) and isset($_POST['users'])) {
        alteraEspaco();
      }else {
          header("Location: ../index.php?pag=4&status=cad&rrr&id={$_POST['id']}");
      }
    }
    elseif (isset($_GET['type']) and $_GET['type']=='x48x') {
      if (isset($_POST['nome']) and isset($_POST['espaco']) and isset($_POST['situacao']) and isset($_POST['users'])) {
        alterarCategoria();
      }else {
          header("Location: ../index.php?pag=6&status=cad&id={$_POST['id']}");
      }
    }


    elseif (isset($_GET['type']) and $_GET['type']=='x111x') {
      if (true) {
        if (isset($_POST['solicitantes']) and !empty($_POST['solicitantes']) and
            isset($_POST['categoria']) and !empty($_POST['categoria']) and
            isset($_POST['assunto']) and !empty($_POST['assunto']) and
            isset($_POST['espaco']) and !empty($_POST['espaco']) and
            isset($_POST['data']) and !empty($_POST['data']) and
            isset($_POST['h_inicial']) and !empty($_POST['h_inicial']) and
            isset($_POST['h_final']) and !empty($_POST['h_final'])
        ) {
          alterarSolicitacoaes();
        }else {
            header("Location: ../index.php?pag=11&status=cad&id={$_POST['id']}");
        }
      }
    }

    elseif (isset($_GET['type']) and $_GET['type']=="x15x") {
      if (isset($_POST['nome']) and !empty($_POST['nome']) and
          isset($_POST['telefone']) and !empty($_POST['telefone'])
      ) {
        alterarSolicitantes();
      }else {
        header("Location: ../index.php?pag=10&status=cad&id={$_POST['id']}");
      }
    }
  }




function alteraEspaco(){
  include_once './Banco.php';
  $nome=$_POST['nome'];
  $cor=$_POST['cor'];
  $u=$_POST['users'];
  $b=new Banco();
  if(true) {
    if ($b->alteraEspaco($nome, $_POST['desc'], $cor, $_POST['situacao'], $u, $_POST['id'])) {
      header("Location: ../index.php?pag=4&id={$_POST['id']}&status=a");
      return true;
    }else {
        header("Location: ../index.php?pag=4&id={$_POST['id']}&status=erro&banco");
    }
  }else {
    header("Location: ../index.php?pag=4&id={$_POST['id']}&status=advalidar");
  }
}

function cadastraAlterar(){
  include_once './Banco.php';
  $b=new Banco();
    if ($b->alterarUsuario( $_POST['id'], $_POST['perfil'], $_POST['situacao'])) {
      header("Location: ../index.php?pag=2&id={$_POST['id']}&status=a");
      return true;
    }else {
      header("Location: ../index.php?pag=2&id={$_POST['id']}&status=erro");
    }
}

function alterarCategoria(){
  include_once './Banco.php';
  $nome=$_POST['nome'];
  $u=$_POST['users'];
  $id=$_POST['id'];
  $va=((isset($_POST['validar']) and $_POST['validar']==1) ? 1 : 0);
  $b=new Banco();
    if ($b->alteraCategoria($nome, $_POST['espaco'], $_POST['situacao'], $va, $u, $id)) {
      header("Location: ../index.php?pag=6&id=$id&status=a");
      return true;
    }else {
        header("Location: ../index.php?pag=6&id=$id&status=erro");
    }
  header("Location: ../index.php?pag=6&id=$id&status=erro");
}

function alterarSolicitantes(){
  include_once './Banco.php';
  $b=new Banco();
  var_dump($_POST);
  if ($b->alterarSolicitantes($_POST['nome'], $_POST['mail'], $_POST['desc'], $_POST['CNPJ'],  $_POST['CPF'], $_POST['telefone'], $_POST['situacao'],  $_POST['p_contato'], $_POST['endereco'] , $_POST['id'])) {
    header("Location: ../index.php?pag=10&status=a&id={$_POST['id']}");
  } else {
    header("Location: ../index.php?pag=10&status=erro&id={$_POST['id']}");
  }
}

function validarHora(){
  $f=$_POST['h_final'];
  $i=$_POST['h_inicial'];
  $f=explode(":", $f);
  $i=explode(":", $i);
  if(is_numeric($f[0]) && is_numeric($f[1]) &&  is_numeric($i[1]) && is_numeric($i[0])){
    if ($f[0]<24 && $f[1]<60 && $i[0]<24 && $i[1]<60) {
      return true;
    }
  }
  return true;
}

function alterarSolicitacoaes(){
  include_once "./Banco.php";
  $b=new Banco();
  if(validarHora()){
    if ($b->validarHoraBancoAlterar($_POST['h_final'] ,$_POST['h_inicial'], $_POST['espaco'], $_POST['data'], $_POST['id_s'])) {
      if ($b->alterarSolicitacoes($_POST)) {
        header("Location: ../index.php?pag=11&status=a&id={$_POST['id_s']}");
      }
    }
    else {
      header("Location: ../index.php?pag=11&status=hV&id={$_POST['id_s']}");
    }
  }
}

?>
