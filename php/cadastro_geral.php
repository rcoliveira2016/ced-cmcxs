<?php
  if (!empty($_GET)) {
    if (isset($_GET['type']) and $_GET['type']=='x12x') {
      if (isset($_POST['login']) and !empty($_POST['login']) and isset($_POST['perfil']) and !empty($_POST['perfil']) and ( isset($_POST['situacao']) and !empty($_POST['situacao']) or $_POST['situacao']=="0")) {
        cadastraUsuario();
      }else {
          header("Location: ../index.php?pag=2&status=cad");
      }
    }
    if (isset($_GET['type']) and $_GET['type']=='x22x') {
      if (isset($_POST['nome']) and !empty($_POST['nome']) and isset($_POST['cor']) and !empty($_POST['cor']) and isset($_POST['desc']) and !empty($_POST['desc']) and !empty($_POST['users']) and isset($_POST['users'])) {
        cadastraEspaco();
      }else {
          header("Location: ../index.php?pag=4&status=cad");
      }
    }
    if (isset($_GET['type']) and $_GET['type']=='x48x') {
      if (isset($_POST['nome']) and isset($_POST['espaco']) and isset($_POST['situacao']) and isset($_POST['users'])) {
        cadastraCategoria();
      }else {
          header("Location: ../index.php?pag=6&status=cad");
      }
    }

    elseif (isset($_GET['type']) and $_GET['type']=='x111x') {
      if (isset($_POST['solicitantes']) and !empty($_POST['solicitantes']) and
          isset($_POST['categoria']) and !empty($_POST['categoria']) and
          isset($_POST['assunto']) and !empty($_POST['assunto']) and
          isset($_POST['espaco']) and !empty($_POST['espaco']) and
          isset($_POST['data']) and !empty($_POST['data']) and
          isset($_POST['h_inicial']) and !empty($_POST['h_inicial']) and
          isset($_POST['h_final']) and !empty($_POST['h_final'])
      ) {
        cadsatraSolicitacoaes();
      }else {
          header("Location: ../index.php?pag=11&status=cad");
      }
    }

    if (isset($_GET['type']) and $_GET['type']=="x15x") {
      if (isset($_POST['nome']) and !empty($_POST['nome']) and
          isset($_POST['telefone']) and !empty($_POST['telefone'])
      ) {
        cadastrarSolicitantes();
      }else {
        header("Location: ../index.php?pag=10&status=cad");
      }
    }
  }else {header("Location: ../index.php");}

function cadastraUsuario(){
  include_once './Banco.php';
  include_once "./config_ad.php";
  $b=new Banco();
  if ($bind) {
      $filtro="(&(objectClass=User)(|(samaccountname={$_POST['login']})))";
      $pesquisa = ldap_search($ds, $grupo, $filtro) or die("Erro na pesquisa...");
      $info = ldap_get_entries($ds, $pesquisa);
      $nome=$info[0]['displayname'][0];
      ldap_close($ds);
      if($b->validarUser($_POST['login'])){
        header("Location: ../index.php?pag=2&status=advalidar");
      }else {
        if ($b->cadastraUsuario($nome, $_POST['perfil'], $_POST['login'], $_POST['situacao'])) {
          header("Location: ../index.php?pag=2&status=s");
          return true;
        }else {
            header("Location: ../index.php?pag=2&status=erro");
        }
      }
  }else { header("Location: ../index.php?pag=2&status=erroad");}

}


function cadastraEspaco(){
  include_once './Banco.php';
  $nome=$_POST['nome'];
  $cor=$_POST['cor'];
  $u=$_POST['users'];
  $b=new Banco();
  if($b->validarEspaco($cor, $nome)) {
    if ($b->cadastraEspaco($nome, $_POST['desc'], $cor, $_POST['situacao'], $u)) {
      header("Location: ../index.php?pag=4&status=s");
      return true;
    }else {
        header("Location: ../index.php?pag=4&status=erro");
    }
  }else {
    header("Location: ../index.php?pag=4&status=advalidar");
  }
  header("Location: ../index.php?pag=4&status=erro");
}

function cadastraCategoria(){
  include_once './Banco.php';
  $nome=$_POST['nome'];
  $u=$_POST['users'];
  $v=( isset($_POST['validar']) and $_POST['validar']==1) ? 1 : 0 ;
  $b=new Banco();
  if($b->validarCategoria($nome)) {
    if ($b->cadastraCategoria($nome, $_POST['espaco'], $_POST['situacao'], $v, $u)) {
      header("Location: ../index.php?pag=6&status=s");
      return true;
    }else {
        header("Location: ../index.php?pag=6&status=erro");
    }
  }else {
    header("Location: ../index.php?pag=6&status=advalidar");
  }
  header("Location: ../index.php?pag=6&status=erro");
}

function cadastrarSolicitantes(){
  include_once './Banco.php';
  $b=new Banco();
  if ($b->validarSolicitantes($_POST['nome'])) {
    if (count($_POST)==11 and $b->cadastrarSolicitantes($_POST['nome'], $_POST['mail'], $_POST['desc'], $_POST['CNPJ'],  $_POST['CPF'], $_POST['telefone'], $_POST['situacao'],  $_POST['p_contato'], $_POST['endereco'])) {
        if (isset($_GET['red']) && $_GET['red']=="true") {
          header("Location: ../index.php?pag=11");
        }
        else {
          header("Location: ../index.php?pag=10&status=s");
        }
    } else {
      header("Location: ../index.php?pag=10&status=erro");
    }
  }else {
    header("Location: ../index.php?pag=10&status=advalidar");
  }
}

function cadsatraSolicitacoaes(){
  include_once "./Banco.php";
  include_once "./functions.php";
  $b=new Banco();
  if(validarHora()){
    if ($b->validarHoraBanco($_POST['h_final'] ,$_POST['h_inicial'], $_POST['espaco'], $_POST['data'])) {
      if ($b->addSolicitantes($_POST)) {
        header("Location: ../index.php?pag=11&status=s");
      }
    }
    else {
      header("Location: ../index.php?pag=11&status=hV");
    }
  }
}
function validarHora(){
  $f=$_POST['h_final'];
  $i=$_POST['h_inicial'];
  $f=explode(":", $f);
  $i=explode(":", $i);
  if(is_numeric($f[0]) && is_numeric($f[1]) &&  is_numeric($i[1]) && is_numeric($i[0])){
    $arr1=getData($_POST['data']);
    if ($f[0]<24 && $f[1]<60 && $i[0]<24 && $i[1]<60 and validarMesDia($arr1[1], $arr1[2])!=0) {
      return true;
    }
  }
  return false;
}
?>
