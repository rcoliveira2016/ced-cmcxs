<?php
  if (isset($_GET['id'])) {
    require_once('./mpdf/mpdf.php');
    require_once('./Espaco.php');
    require_once('./Recurso.php');
    require_once('./Solicitantes.php');
    require_once('./Solicitacoes.php');
    require_once('./Banco.php');
    $b=new Banco();

    if ($soli=$b->getSolicitacoesId($_GET['id'])) {
      $pdf=new mPDF("c", "A4");
      $html=file_get_contents("./mpdf/layout/layout.html");
      $css=file_get_contents("./mpdf/layout/css.css");
      $paremetros = array('$nomePesso', '$solicitante', '$telefone', '$mail', '$espaco', '$data', '$hora', '$assunto', '$recurso');
      $strings=criarString($soli, $b);
      $html = str_replace($paremetros, $strings, $html);

      $pdf->WriteHTML($css, 1);
      $pdf->WriteHTML($html);
      $pdf->Output('tsete.pdf', 'I');
    }else {
      var_dump($soli);
      echo "Erro No Banco";
    }

  }else {
    echo "Dados insuficientes";
  }

  function criarString($solicitacao, $b){
    $solicitante=$b->getSolicitantesId($solicitacao->solicitante);
    $espacoNome=$b->getEspacoId($solicitacao->espaco);
    $nomePesso=$solicitante->contato;
    $nomeSolicitante=$solicitante->nome;
    $telefone=$solicitante->telefone;
    $mail=$solicitante->mail;
    $espaco=$espacoNome->nome;
    $data=$solicitacao->data;
    $hora=$solicitacao->h_inicial." as ".$solicitacao->h_final;
    $assunto=$solicitacao->assunto;
    $recursos=$b->get_rel_solicitacoes($solicitacao->id);
    $recurso="";
    if (!empty($recursos)) {
      foreach ($recursos as $user) {
        $recurso.= $user->nome.";";
      }
    }
    return array($nomePesso, $nomeSolicitante, $telefone, $mail, $espaco, $data, $hora, $assunto, $recurso);
  }
 ?>
