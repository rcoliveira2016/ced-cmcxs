<?php

function getMes($dAtual){
  include_once './php/Solicitacoes.php';
  include_once './php/Espaco.php';
  include_once './php/Banco.php';
  $b=new Banco();
  $semana=povoarSemana($dAtual)[0];
  $s=$b->get_solicitacoes_data($semana[0],$semana[6],$dAtual[1],$dAtual[2],$dAtual[0]);
  $dia_atual=povoarSemana($dAtual)[1];
  $index_atual=povoarSemana($dAtual)[2];
  for ($i=0; $i < count($s); $i++) {
    $c=0;
    $h=intval(explode(":", $s[$i]->h_inicial)[0]);
    $m=intval(explode(":", $s[$i]->h_inicial)[1]);
    $fi_h=intval(explode(":", $s[$i]->h_final)[0]);
    $fi_m=intval(explode(":", $s[$i]->h_final)[1]);
    $h_min_i=($h*60)+$m;
    $h_min_f=($fi_h*60)+$fi_m;
    for ($j=0; $j < count($s) ; $j++) {
      $h=intval(explode(":", $s[$j]->h_inicial)[0]);
      $m=intval(explode(":", $s[$j]->h_inicial)[1]);
      $fi_h=intval(explode(":", $s[$j]->h_final)[0]);
      $fi_m=intval(explode(":", $s[$j]->h_final)[1]);
      $h_min_i_J=($h*60)+$m;
      $h_min_f_J=($fi_h*60)+$fi_m;
      if ($s[$i]->data==$s[$j]->data) {
        $c++;
      }
    }
    if ($c>0) {
      $s[$i]->div=$c;
    }
  }
  echo '<table class="col-lg-12 off-margin-left table-calender">
    <tr class="cab-calender">
      <td class="day-calender-h editar_table">
      </td>
      <td class="day-calender editar_table">
        Domingo
        <h4>dia:'.$semana[0].'</h4>
      </td>
      <td class="day-calender editar_table">
        Segunda
        <h4>dia:'.$semana[1].'</h4>
      </td>
      <td class="day-calender editar_table">
        Terça
        <h4>dia:'.$semana[2].'</h4>
      </td>
      <td class="day-calender  editar_table">
        Quarta
        <h4>dia:'.$semana[3].'</h4>
      </td>
      <td class="day-calender editar_table">
        Quinta
        <h4>dia:'.$semana[4].'</h4>
      </td>
      <td class="day-calender editar_table">
        Sexta
        <h4>dia:'.$semana[5].'</h4>
      </td>
      <td class="day-calender editar_table">
        Sábado
        <h4>dia:'.$semana[6].'</h4>
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
            $div1="";
            $div2="";
            $divMeia="";
            $divMaior="";
            $duplas=0;
            //verifica datas
            for ($k=0; $k < count($s); $k++) {
              $aux_dia=explode("/", $s[$k]->data)[0]+0;
              if($semana[$j]==$aux_dia){
                $aux_h=intval(explode(":", $s[$k]->h_inicial)[0]);
                $aux_m=intval(explode(":", $s[$k]->h_inicial)[1]);
                $fi_h=intval(explode(":", $s[$k]->h_final)[0]);
                $fi_m=intval(explode(":", $s[$k]->h_final)[1]);
                if($i>=$aux_h && $i<=$fi_h){
                  if(!($i==$fi_h && $fi_m==0) and !($i==$aux_h and $aux_m==30)){
                    if (!($aux_h==$i and $aux_m>30)) {
                      $s[$k]->size+=1;
                    }
                  }
                  if (!($i==$fi_h && $fi_m==0)) {
                    if (!($fi_h==$i and $fi_m<=30)) {
                      $s[$k]->size+=1;
                    }
                  }
                }
              }
            }
            $cla=($divMeia!="")? " style='border:none'" : "";
            $hr=($i<10)? "0".$i: $i;
            $hrf=(($i+1)<10)? "0".($i+1): $i;
            $divMaior=($divMaior=="")? "<div class='td-off' data_h='$hr:30' data_f='$hrf:00' dia='{$semana[$j]}'></div>" : $divMaior;
            $divMeia=($divMeia=="")? "<div class='td-off' data_h='$hr:00' data_f='$hr:30' dia='{$semana[$j]}' style='border-bottom: 0.25px #ccc dotted'></div>" : $divMeia;
            echo "<td$cla>
                    $divMeia
                    $divMaior
                  </td>\n";

        }

      echo "</tr>";
    }
    echo "</table>";
    $c=0;
    foreach ($s as $key => $value) {
      $aux_h=(explode(":", $value->h_inicial)[0]);
      $aux_m=(explode(":", $value->h_inicial)[1]);
      $par1=(($aux_m>=30)? $aux_h.":30" : $aux_h.":00");
      $f_h=(explode(":", $value->h_final)[0]);
      $f_m=(explode(":", $value->h_final)[1]);
      $par2=(($f_m>=30)? $f_h.":30" : $f_h.":00");
      $data="hora_f='$par2' hora_i='$par1' data_d='".getData($value->data)[0]."' data_div='$value->div'";
      echo "<div $data class='div td-calender' value='$value->id' style='height:".($value->size*25.5)."px;left:".($c*100)."px'>$value->id</div>";
      $c++;
    }
}

/*
*    Funcoaes
*/

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

function povoarGambi($div, $divs){
  if (count($divs)>0 and $div->div>1) {
    echo count($divs)." $div->div";
  }
}


?>
