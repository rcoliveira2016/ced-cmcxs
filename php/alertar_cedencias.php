<?php
  include_once './php/Solicitacoes.php';
  include_once './php/Banco.php';
  include_once './php/Espaco.php';
  $b=new Banco();
  $soli=$b->getPesquisaEspaco(3, date("Y-m-d"), "all", "all", "all", 3);
  $js=(!empty($soli) and $_SESSION['alert'])? true: false;
  if (!empty($soli)) {
    foreach ($soli as $var) {
      $espaco=$b->getEspacoId($var->espaco);
      echo '<li class="alert-container">
                <a href="./index.php?pag=11&id='.$var->id.'" >Solicitação
                  <ul class="off-paddin">
                    <li><span class="label label-primary">Hora: '.$var->h_inicial.'</span></li>
                    <li><span class="label label-danger">Espaço: '.$espaco->nome.'</span></li>
                  </ul>
                </a>
            </li>';
    }
  }
?>
