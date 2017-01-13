<?php
include_once './php/Categoria.php';
include_once './php/Solicitacoes.php';
include_once './php/Solicitantes.php';
include_once './php/Espaco.php';
include_once './php/Banco.php';
$b=new Banco();
$count=0;
$meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
$povoarArr=povoarSemana($arr_data);
$semana=$povoarArr[0];
$dia_atual=$povoarArr[1];
$index_atual=$povoarArr[2];
$m=$arr_data[1]."/".$arr_data[2];
echo '<div class="col-lg-12 off-margin-left"><table class="col-lg-12 off-margin-left table-calender">
  <tr class="cab-calender tr-agenda">
    <td class="day-calender contr-agenda">
      <a href="?pag=18&data='.dataLeft(dataLink($semana[0]."/$m" ,$d ,$semana) ,$d ,$semana).'" class="link-off-f" ><i class="fa fa-angle-left fa-2x"></i></a>
    </td>
      <td class="day-calender editar_table'.((c($semana[0])."/$m"==$d)? " select_agenda" : "").'">
        <a href="?pag=18&data='.dataLink(c($semana[0])."/$m" ,$semana).'" class="link-td">
          '.c($semana[0]).'
          <h4>Domingo</h4>
        </a>
      </td>
    </a>
    <td class="day-calender editar_table'.((c($semana[1])."/$m"==$d)? " select_agenda" : "").'">
      <a href="?pag=18&data='.dataLink(c($semana[1])."/$m" ,$semana).'" class="link-td">
        '.c($semana[1]).'
        <h4>Segunda-feira</h4>
      </a>
    </td>
    <td class="day-calender editar_table'.((c($semana[2])."/$m"==$d)? " select_agenda" : "").'">
      <a href="?pag=18&data='.dataLink(c($semana[2])."/$m" ,$semana).'" class="link-td">
        '.c($semana[2]).'
        <h4>Terça-feira</h4>
      </a>
    </td>
    <td class="day-calender  editar_table'.((c($semana[3])."/$m"==$d)? " select_agenda" : "").'">
      <a href="?pag=18&data='.dataLink(c($semana[3])."/$m" ,$semana).'" class="link-td">
        '.c($semana[3]).'
        <h4>Quarta-feira</h4>
      </a>
    </td>
    <td class="day-calender editar_table'.((c($semana[4])."/$m"==$d)? " select_agenda" : "").'">
      <a href="?pag=18&data='.dataLink(c($semana[4])."/$m" ,$semana).'" class="link-td">
        '.c($semana[4]).'
        <h4>Quinta-feira</h4>
      </a>
    </td>
    <td class="day-calender editar_table'.((c($semana[5])."/$m"==$d)? " select_agenda" : "").'">
      <a href="?pag=18&data='.dataLink(c($semana[5])."/$m" ,$semana).'" class="link-td">
        '.c($semana[5]).'
        <h4>Sexta-feira</h4>
      </a>
    </td>
    <td class="day-calender editar_table'.((c($semana[6])."/$m"==$d)? " select_agenda" : "").'">
      <a href="?pag=18&data='.dataLink(c($semana[6])."/$m" ,$semana).'" class="link-td">
        '.c($semana[6]).'
        <h4>Sábado</h4>
      </a>
    </td>
    <td class="day-calender contr-agenda" style="text-align:left">
      <a href="?pag=18&data='.dataRight(dataLink($semana[6]."/$m" ,$d ,$semana) ,$d ,$semana).'" class="link-off-f"><i class="fa fa-angle-right fa-2x"></i></a>
    </td>
  </tr></table></div>';

  $indexMes=intval($arr_data[1])-1;
  echo '<div class="col-lg-12 off-margin-left padding-size" style="margin-top:10px"><blockquote>'
          .diaDaSemanaEstenco($arr_data[0] , $arr_data[1], $arr_data[2]).", {$arr_data[0]} de ".$meses[$indexMes]." de {$arr_data[2]}
        </blockquote></div>";
  $cate=$b->get_categoria();
  if (!empty($cate)) {
    foreach ($cate as $c) {
      $soc=$b->getRelCatSocData($c->id, $d, !strripos($_SERVER['REQUEST_URI'], "/index.php"));    
      if (!empty($soc)) {
        echo '<div class="col-lg-2 off-margin-left padding-size"><div class="panel panel-red col-lg-12 off-margin-left" style="margin-top:10px;">
                <div class="panel-heading">
                  <span>'.$c->nome.'</span>
                </div>';
        foreach ($soc as $key => $s) {
          $espaco=$b->getEspacoId($s->espaco)->nome;
          $solicitante=$b->getSolicitantesId($s->solicitante)->nome;
          echo "<div class='col-lg-12 off-margin-left' style='padding:5px!important'>
                  <p><strong>Data</strong>: $s->data</p>
                  <p><strong>Horário</strong>: $s->h_inicial às $s->h_final</p>
                  <p><strong>Espaço</strong>: $espaco</p>
                  <p><strong>Solicitante</strong>: $solicitante</p>
                  <p><strong>Assunto</strong>: $s->assunto</p>"
                  .((!empty($s->desc))? "<p><strong>Descrição</strong>: $s->desc</p>": "")
                  ."<hr>
                </div>";

        }
        echo '</div></div>';
      }else{$count++;}
    }
  }
  if($count==count($cate)){
    echo "<div class=\"alert alert-danger col-lg-12\" style=\"margin-top:10px;\">
            <strong>Atenção!</strong> não existem solicitações nesta data
          </div>";
  }


/**********************************************************************************************************************************************************************

                                                                              FUNCTIONS

***********************************************************************************************************************************************************************/



  function dataRight($data ,$d ,$semana){
    $datas=getData($data);
    if(!checkdate($datas[1], ($datas[0]+1), $datas[2])){
      return "01"."/".c($datas[1]+1)."/".$datas[2];
    }
    return c($datas[0]+1)."/".c($datas[1])."/".$datas[2];
  }

  function dataLeft($data ,$d ,$semana){
    $datas=getData($data);
    if(($datas[0]-1)==0){
      $v=validarMesDia(($datas[1]-1), $datas[2]);
      return (($v==0)? $d: c($v)."/".c($datas[1]-1)."/".$datas[2]);
    }
    return c($datas[0]-1)."/".c($datas[1])."/".$datas[2];
  }


?>
