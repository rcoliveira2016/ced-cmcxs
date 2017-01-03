?php
  if (isset($_GET['tipo']) and !empty($_GET['tipo']) and isset($_GET['id']) and !empty($_GET['id'])) {
    $id=$_GET['id'];
    $tipo=$_GET['tipo'];
    include_once './php/Banco.php';
    $b=new Banco();
  }else {
    header("Location: index.php");
  }
  if($tipo==1){
    include_once './php/Usuario.php';
    $u=$b->getUserId($id);
    if (!empty($u)) {
      include 'includs/show_view/show_user.php';
    }else {
      echo '<div class="row"><div class="col-lg-12"><h1 class="page-header">Usuário não encontrado</h1></div></div>';
    }
  }
  elseif ($tipo==2) {
    include_once "./php/Espaco.php";
    $u=$b->getEspacoId($id);
    if (!empty($u)) {
      include 'includs/show_view/show_espaco.php';
    }else {
      echo '<div class="row"><div class="col-lg-12"><h1 class="page-header">Espaço não encontrado</h1></div></div>';
    }
  }
  elseif ($tipo==3) {
    include_once "./php/Categoria.php";
    include_once "./php/Espaco.php";
    include_once './php/Usuario.php';
    $u=$b->getCategoriaId($id);
    if (!empty($u)) {
      include 'includs/show_view/show_categoria.php';
    }else {
      echo '<div class="row"><div class="col-lg-12"><h1 class="page-header">Categoria não encontrada</h1></div></div>';
    }
  }
  elseif ($tipo==4) {
    include_once "./php/Recurso.php";
    include_once "./php/Espaco.php";
    include_once './php/Usuario.php';
    include_once './php/Solicitantes.php';
    $u=$b->getRecursoId($id);
    if (!empty($u)) {
      include 'includs/show_view/show_recurso.php';
    }else {
      echo '<div class="row"><div class="col-lg-12"><h1 class="page-header">Recursos não encontrado</h1></div></div>';
    }

  }
  elseif ($tipo==5) {
    include_once './php/Solicitantes.php';
    $u=$b->getSolicitantesId($id);
    if (!empty($u)) {
      include 'includs/show_view/show_solicitante.php';
    }else {
      echo '<div class="row"><div class="col-lg-12"><h1 class="page-header">Solicitante não encontrado</h1></div></div>';
    }
  }
  elseif ($tipo==6) {
    include_once "./php/Recurso.php";
    include_once "./php/Espaco.php";
    include_once './php/Usuario.php';
    include_once "./php/Categoria.php";
    include_once './php/Solicitantes.php';
    include_once './php/Solicitacoes.php';
    $u=$b->getSolicitacoesId($id);
    if (!empty($u)) {
      include 'includs/show_view/show_solicitacoes.php';
    }else {
      echo '<div class="row"><div class="col-lg-12"><h1 class="page-header">Solicitações não encontrado</h1></div></div>';
    }
  }
?>
