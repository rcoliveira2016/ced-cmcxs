<?php
function getMes($dAtual, $d){
  include_once './php/Solicitacoes.php';
  include_once './php/Espaco.php';
  include_once './php/Banco.php';
  $b=new Banco();
  $povoar=povoarSemana($dAtual);
  $semana=$povoar[0];
  $s=$b->get_solicitacoes_data($semana[0],$semana[6],$dAtual[1],$dAtual[2],$dAtual[0]);
  $arr_data=$dAtual;
  $index_atual=$povoar[2];
  $meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
  $m=$arr_data[1]."/".$arr_data[2];
  $index=intval($arr_data[1])-1;
  echo '<div class="col-lg-12 off-margin-left padding-size" style="margin-bottom:10px"><blockquote>'
          .diaDaSemanaEstenco($arr_data[0] , $arr_data[1], $arr_data[2]).", {$arr_data[0]} de ".$meses[$index].",  {$arr_data[2]}
        </blockquote></div>";


  echo '<div class="col-lg-12 off-margin-left"><table class="col-lg-12 off-margin-left table-calender">
    <tr class="cab-calender tr-agenda">
      <td class="day-calender-h editar_table" style="background:#eee">
      </td>
        <td class="day-calender editar_table'.((c($semana[0])."/$m"==$d)? " select_agenda" : "").'">
          <a class="link-td link-off-hover">
            '.c($semana[0]).'
            <h4>Domingo</h4>
        </td>
      </a>
      <td class="day-calender editar_table'.((c($semana[1])."/$m"==$d)? " select_agenda" : "").'">
        <a class="link-td">
          '.c($semana[1]).'
          <h4>Segunda-feira</h4>
        </a>
      </td>
      <td class="day-calender editar_table'.((c($semana[2])."/$m"==$d)? " select_agenda" : "").'">
        <a class="link-td">
          '.c($semana[2]).'
          <h4>Terça-feira</h4>
        </a>
      </td>
      <td class="day-calender  editar_table'.((c($semana[3])."/$m"==$d)? " select_agenda" : "").'">
        <a class="link-td">
          '.c($semana[3]).'
          <h4>Quarta-feira</h4>
        </a>
      </td>
      <td class="day-calender editar_table'.((c($semana[4])."/$m"==$d)? " select_agenda" : "").'">
        <a class="link-td">
          '.c($semana[4]).'
          <h4>Quinta-feira</h4>
        </a>
      </td>
      <td class="day-calender editar_table'.((c($semana[5])."/$m"==$d)? " select_agenda" : "").'">
        <a class="link-td">
          '.c($semana[5]).'
          <h4>Sexta-feira</h4>
        </a>
      </td>
      <td class="day-calender editar_table'.((c($semana[6])."/$m"==$d)? " select_agenda" : "").'">
        <a class="link-td">
          '.c($semana[6]).'
          <h4>Sábado</h4>
        </a>
      </td>
    </tr>';
    //Horas
    for ($i=6; $i <23 ; $i++) {
      echo "<tr>
        <td class='day-calender-h editar_table'>
          $i:00
        </td>";
        //DIA semana
        for ($j=0; $j <7 ; $j++) {
            $div1=array();
            $div2=array();
            $divMeia="";
            $divMaior="";
            //verifica datas
            for ($k=0; $k < count($s); $k++) {
              $dax=explode("/", $s[$k]->data);
              $aux_dia=$dax[0]+0;
              if($semana[$j]==$aux_dia){
                $hNIT=explode(":", $s[$k]->h_inicial);
                $hEND=explode(":", $s[$k]->h_final);
                $aux_h=intval($hNIT[0]);
                $aux_m=intval($hNIT[1]);
                $fi_h=intval($hEND[0]);
                $fi_m=intval($hEND[1]);
                if($i>=$aux_h && $i<=$fi_h){
                  if(!($i==$fi_h && $fi_m==0) and !($i==$aux_h and $aux_m==30)){
                    if (!($aux_h==$i and $aux_m>30)) {
                      $div1[]=$s[$k];
                    }
                  }
                  if (!($i==$fi_h && $fi_m==0)) {
                    if (!($fi_h==$i and $fi_m<=30)) {
                      $div2[]=$s[$k];
                    }
                  }
                }
              }
            }

            foreach ($div1 as $div) {
              $hNIT=explode(":", $div->h_inicial);
              $hEND=explode(":", $div->h_final);
              $aux_h=intval($hNIT[0]);
              $aux_m=intval($hNIT[1]);
              $f_h=intval($hEND[0]);
              $f_m=intval($hEND[1]);
              $bor=($aux_h==$i and $aux_m<=30)? ";border-top:1px #000 solid;" : "";
              $bor2=($f_h==$i and $f_m<=30)? ";border-bottom:1px #000 solid;" : "";
              $e=$b->getEspacoId($div->espaco);
              $n=($aux_h==$i and $aux_m<=30)? $e->nome : "";
              $size=100/count($div1);
              $divMeia.="<div style='background:$e->cor;width:$size%;border-left: 1px #000 solid;border-right: 1px #000 solid$bor$bor2' value='$div->id' class='td-calender'>$n</div>";
            }
            foreach ($div2 as $div) {
              $hNIT=explode(":", $div->h_inicial);
              $hEND=explode(":", $div->h_final);
              $aux_h=intval($hNIT[0]);
              $aux_m=intval($hNIT[1]);
              $f_h=intval($hEND[0]);
              $f_m=intval($hEND[1]);
              $bor=($aux_h==$i and $aux_m>30 or ($i==$aux_h and $aux_m==30))? ";border-top:1px #000 solid" : "";
              $bor2=(($f_h==$i and $f_m>30) or ($i==$fi_h and $f_m==30) or (($f_h-1)==$i and $f_m==0))? ";border-bottom:1px #000 solid" : "";
              $e=$b->getEspacoId($div->espaco);
              $n=($aux_h==$i and $aux_m>30 or ($i==$aux_h and $aux_m==30))? $e->nome : "";
              $size=100/count($div2);
              $divMaior.="<div style='background:$e->cor;width:$size%;border-left: 1px #000 solid;border-right: 1px #000 solid$bor$bor2' value='$div->id' class='td-calender'>$n</div>";
            }
            $cla=($divMeia!="")? " style='border:none'" : "";
            $hr=($i<10)? "0".$i: $i;
            $hrf=(($i+1)<10)? "0".($i+1): ($i+1);
            $divMaior=($divMaior=="")? "<div class='td-off' data_h='$hr:30' data_f='$hrf:00' data_d='".c($semana[$j])."'></div>" : $divMaior;
            $divMeia=($divMeia=="")? "<div class='td-off' data_h='$hr:00' data_f='$hr:30' data_d='".c($semana[$j])."' style='border-bottom: 0.25px #ccc dotted'></div>" : $divMeia;
            echo "<td$cla>
                    $divMeia
                    $divMaior
                  </td>\n";

        }

      echo "</tr>";
    }
    echo "</table>";
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

function validarMes($m, $a){
  //mes 31=1
  //mes 30=2
  //mes 28=3
  //mes 29=4

  if($m==2 and ((($a%4)==0 and ($a%100)!=0) or ($ano%400)==0)){
    return 4;
  }
  elseif ($m==2){
    return 3;
  }
  elseif (checkdate($m, 31, $a)){
    return 1;
  }
  elseif (checkdate($m, 30, $a)){
    return 1;
  }
  return 0;
}




?>
