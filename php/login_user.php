<?php
    if (!empty($_POST) and isset($_POST['user']) and isset($_POST['senha']) and isset($_POST['submit'])) {
      include_once './Usuario.php';
      include_once './config_ad.php';
      include_once './Banco.php';
      $user=$_POST['user'];
      $senha=$_POST['senha'];
      $b=new Banco();
      $usuario=$b->logar($user);
      if ($usuario!=null) {
        var_dump($usuario);
        if($usuario->situacao==1){
          $bind=@ldap_bind($ds, $user. '@' . $domain, $senha);
          if ($bind) {
              session_start();
              $_SESSION['nivel']=$usuario->perfil;
              $_SESSION["id"]=$usuario->id;
              $_SESSION['nome']=$usuario->nome;
              header("Location: ../index.php");
          }else {
              header("Location: ../login.php?erro=op");
          }
        }else {
          header("Location: ../login.php?erro=de");
        }
      }
      else {
        header("Location: ../login.php?erro=op");
      }
    }else {
      header("Location: ../login.php?erro=op");
    }

?>
