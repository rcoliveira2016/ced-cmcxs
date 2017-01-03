��<?php
  function getConteudo($c, $nivel){
    if($c==1 and $nivel==1){
      include 'includs/show_user_cadastro.php';
    }
    elseif ($c==0) {
      $titulo="Cedências Câmara Caxias";
      include_once 'includs/agenda.php';
    }
    elseif ($c==2) {
      if($nivel==1){
        include 'includs/cadastro_teste.php';
      }else {
        header("Location: ./login.php");
      }
    }
    elseif ($c==3) {
      if($nivel==1){
        include 'includs/show_espaco_cadastro.php';
      }else {
        header("Location: ./login.php");
      }
    }
    elseif ($c==4) {
      if($nivel==1){
        include 'includs/tela_cadastro_espaco.php';
      }else {
        header("Location: ./login.php");
      }
    }
    elseif ($c==6) {
      if($nivel==1){
        include 'includs/tela_cadastro_categoria.php';

      }else {
        header("Location: ./login.php");
      }
    }
    elseif ($c==5 ) {
      if($nivel==1){
        include 'includs/show_categoria_cadastro.php';

      }else {
        header("Location: ./login.php");
      }
    }
    elseif ($c==7 ) {
      if($nivel==1){
        include 'includs/show_recurso_cadastro.php';
      }else {
        header("Location: ./login.php");
      }
    }
    elseif ($c==8 ) {
      if($nivel==1){
        include 'includs/tela_cadastro_recurso.php';
      }else {
        header("Location: ./login.php");
      }
    }
    elseif ($c==9 ) {
      if($nivel==1){
        include_once 'includs/show_solicitantes.php';

      }else {
        header("Location: ./login.php");
      }
    }
    elseif ($c==10 ) {
      if($nivel==1 or $nivel==2){
        include_once 'includs/tela_cadastro_solicitantes.php';

      }else {
        header("Location: ./login.php");
      }
    }
    elseif ($c==12 ) {
      $titulo="Solicitações";
      include_once 'includs/show_solicitacoes.php';
    }
    elseif ($c==11) {
      if($nivel==1 or $nivel==2){
        include_once 'includs/tela_cadastro_solicitacaoes.php';
      }else {
        header("Location: ./login.php");
      }
    }
    elseif ($c==14) {
      if ($nivel==1 or $nivel==2) {
        include_once './includs/procurar.php';
      } else {
        header("Location: ./login.php");
      }

    }
    elseif ($c==15 ) {
      include_once 'includs/calendario.php';
    }

    elseif ($c==16 ) {
      include_once 'includs/show_view.php';
    }
    elseif ($c==17) {
      if ($nivel==1 or $nivel==2) {
        include './includs/relatorio.php';
      } else {
        header("Location: ./login.php");
      }
    }
    elseif ($c==18) {
      $titulo="Agenda";
      include_once 'includs/agenda.php';
    }
    else {
      echo '<div class="row"><div class="col-lg-12"><h1 class="page-header">Página não encontrada *-*</h1></div><!-- /.col-lg-12 --></div>';
    }
  }
 ?>
