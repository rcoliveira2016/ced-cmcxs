?php
    function dataLink($data, $s){
      $x=getData($data);
      $dia1=$x[0];
      $dia2=$s[0];
      if($dia1<$dia2){
        if (($x[1]+1)>12) {
          return c($x[0]).'/01/'.($x[2]+1);
        }
        return c($x[0])."/".c($x[1]+1)."/".$x[2];
      }
      return $data;
    }

    function diaDaSemanaEstenco($d, $m, $a) {
        $jd = gregoriantojd($m, $d, $a);
        if (jddayofweek($jd, 2) == 'Mon')
            $s = 'Segunda-feira';
        else if (jddayofweek($jd, 2) == 'Tue')
            $s = 'Terça-feira';
        else if (jddayofweek($jd, 2) == 'Wed')
            $s = 'Quarta-feira';
        else if (jddayofweek($jd, 2) == 'Thu')
            $s = 'Quinta-feira';
        else if (jddayofweek($jd, 2) == 'Fri')
            $s = 'Sexta-feira';
        else if (jddayofweek($jd, 2) == 'Sat')
            $s = 'Sabado';
        else if (jddayofweek($jd, 2) == 'Sun')
            $s = 'Domingo';
        return $s;
    }

    function c($v){
      $c=intval($v);
      if ($c<10) {
        return "0".$c;
      }
      return $v;
    }

    function validarMesDia($m, $a){
      //mes 31=1
      //mes 30=2
      //mes 28=3
      //mes 29=4

      if($m==2 and ((($a%4)==0 and ($a%100)!=0) or ($ano%400)==0)){
        return 29;
      }
      elseif ($m==2){
        return 28;
      }
      elseif (checkdate($m, 31, $a)){
        return 31;
      }
      elseif (checkdate($m, 30, $a)){
        return 30;
      }
      return 0;
    }
    function getData($data){
      return explode("/", $data);
    }
    function getUserAd() {
        include './php/config_ad.php';
        if ($bind) {
            $nome;
            $pesquisa = ldap_search($ds, $grupo, $filtro) or die("Erro na pesquisa...");
            $info = ldap_get_entries($ds, $pesquisa);
            $retorno = ldap_count_entries($ds, $pesquisa);
            for ($i = 0; $i < $retorno; $i++) {
                if (isset($info[$i]['displayname']) AND $info[$i]['samaccountname'][0]) {
                    $name=$info[$i]['samaccountname'][0];
                    echo "<option value='$name'>$name</option>" ;
                }
            }
            ldap_close($ds);
        }
    }
    function diaDaSemana($d, $m, $a) {
        $jd = gregoriantojd($m, $d, $a);
        if (jddayofweek($jd, 2) == 'Mon')
            $s = 'SEG';
        else if (jddayofweek($jd, 2) == 'Tue')
            $s = 'TER';
        else if (jddayofweek($jd, 2) == 'Wed')
            $s = 'QUA';
        else if (jddayofweek($jd, 2) == 'Thu')
            $s = 'QUI';
        else if (jddayofweek($jd, 2) == 'Fri')
            $s = 'SEX';
        else if (jddayofweek($jd, 2) == 'Sat')
            $s = 'SAB';
        else if (jddayofweek($jd, 2) == 'Sun')
            $s = 'DOM';
        return $s;
    }


    function povoarSemana($arr){
      $dia=diaDaSemana($arr[0], $arr[1], $arr[2]);
      $s=array(0 => "DOM", 1 => "SEG", 2 => "TER", 3 => "QUA", 4 => "QUI", 5 => "SEX", 6 => "SAB");
      $dias=array(0 => null, 1 => null, 2 => null, 3 => null, 4 => null, 5 => null, 6 => null);
      $limiteMes=validarMesDia($arr[1], $arr[2]);
      $index=array_search($dia, $s);
      for ($i=0; $i < count($s) ; $i++) {
        if (($arr[0]+($i-$index)) >= 1) {
          if (($arr[0]+($i-$index)) <= $limiteMes) {
            if ($index>$i) {
              $dias[$i]=$arr[0]+($i-$index);

            }
            elseif ( $index<$i) {
              $dias[$i]=$arr[0]+($i-$index);
            }
            elseif ( $index=$i) {
              $dias[$i]=$arr[0]+0;
            }
          }else {
            $dias[$i]=($arr[0]+($i-$index))- $limiteMes;
          }
        } else {
          $m=validarMesDia(($arr[1]-1), $arr[2]);
          if($m==31){
            $dias[$i]=$m+($i-$index)+1;
          }
          else{
            $dias[$i]=validarMesDia(($arr[1]-1), $arr[2])+($i-$index)+1;
          }
        }
      }
      if ($index==0) {
        $dias[0]=$arr[0]+0;
      }
      return array(0 => $dias, 1 => $dia, 2 => $index);
    }
?>
