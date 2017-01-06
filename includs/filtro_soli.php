<?php
include_once './php/Solicitantes.php';
include_once './php/Categoria.php';
include_once './php/Espaco.php';
$b=new Banco();
$a="";$m="";$dia="";$se="";$reg="";
$meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
if(isset($_POST['data']) and !empty($_POST['data'])){$data=$_POST['data'];}
else {$data=date("d/m/Y");}
$x=explode("/", $data);
if (isset($_POST['tipo']) and $_POST['tipo']=="ano") {
  $d=$x[2];
  $usuarios=$b->getPesquisaEspaco(1, $d, $_POST['soli'], $_POST['espaco'], $_POST['categoria'], 1);
  $a=" checked";
  $reg=" no ano de $d.";
}
elseif (isset($_POST['tipo']) and $_POST['tipo']=="mes") {
  $d=$x;
  $usuarios=$b->getPesquisaEspaco(2, $d[2]."-".$d[1], $_POST['soli'], $_POST['espaco'], $_POST['categoria'], 2);
  $m=" checked";
  $i=intval($d[1]);
  $reg=" no mês de {$meses[$i]} do ano de {$d[2]}.";
}
elseif (isset($_POST['tipo']) and $_POST['tipo']=="dia") {
  $d=$x;
  $data=$d[2]."-".$d[1]."-".$d[0];
  $usuarios=$b->getPesquisaEspaco(3, $data, $_POST['soli'], $_POST['espaco'], $_POST['categoria'], 3);
  $dia=" checked";
  $i=intval($d[1]);
  $reg=" no dia {$d[0]} de {$meses[$i]} do ano de {$d[2]}.";
}
elseif (isset($_POST['tipo']) and $_POST['tipo']=="semana") {
  include_once "./php/functions.php";
  $data=$x;
  $semana=povoarSemana($data);
  $semana=$semana[0];
  $usuarios=$b->get_solicitacoes_data_where($semana[0],$semana[6], $data[1],$data[2],$data[0], $_POST['soli'], $_POST['espaco'], $_POST['categoria']);
  $se=" checked";
  $i=intval($data[1]);
  $reg=" na semana do dia {$data[0]} de {$meses[$i]} do ano de {$data[2]}.";
}
else {
  $usuarios=$b->get_solicitacoes("");
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Filtro Solicitantes</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row">
                <div class="col-lg-12 off_margin">
                  <form action="./index.php?pag=17&tipo=geral" method="post">
                    <div class="col-lg-7">
                      <div class="col-lg-1 off_margin" style="padding:6px;">
                        Solicitante:
                      </div>
                      <div class="col-lg-3 off_margin">
                        <select class="form-control off-paddin" name="soli" id="espaco">
                          <option value="all">Todos</option>
                          <?php
                            $ss=$b->get_solicitantes();
                            if (!empty($ss)) {
                              foreach ($ss as $user) {
                                $ids=((isset($_POST['soli']))? $_POST['soli'] : "" );
                                $selc=($user->id==$ids)? ' selected' : "";
                                echo "<option value=\"$user->id\"$selc>$user->nome</option>\n";
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="col-lg-1 " style="padding:6px;">
                        Espaço:
                      </div>
                      <div class="col-lg-3 off_margin">
                        <select class="form-control off-paddin " name="espaco" id="espaco">
                          <option value="all">Todos</option>
                          <?php
                            $s=$b->get_espaco();
                            if (!empty($s)) {
                              foreach ($s as $user) {
                                $ids=((isset($_POST['espaco']))? $_POST['espaco'] : "" );
                                $selc=($user->id==$ids)? ' selected' : "";
                                echo "<option value=\"$user->id\"$selc>$user->nome</option>\n";
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="col-lg-1 " style="padding:6px;">
                        Categoria:
                      </div>
                      <div class="col-lg-3 off_margin">
                        <select class="form-control off-paddin " name="categoria" id="espaco">
                          <option value="all">Todos</option>
                          <?php
                            $s=$b->get_categoria();
                            if (!empty($s)) {
                              foreach ($s as $user) {
                                $ids=((isset($_POST['categoria']))? $_POST['categoria'] : "" );
                                $selc=($user->id==$ids)? ' selected' : "";
                                echo "<option value=\"$user->id\"$selc>$user->nome</option>\n";
                              }
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4 off_margin off-paddin">
                      <label class="radio-inline">
                          <input type="radio" name="tipo" id="optionsRadiosInline1" value="dia" <?php echo $dia;?>>Dia
                      </label>
                      <label class="radio-inline">
                          <input type="radio" name="tipo" id="optionsRadiosInline1" value="semana" <?php echo $se;?>>Semana
                      </label>
                      <label class="radio-inline">
                          <input type="radio" name="tipo" id="optionsRadiosInline1" value="mes" <?php echo $m;?>>Mês
                      </label>
                      <label class="radio-inline">
                          <input type="radio" name="tipo" id="optionsRadiosInline1" value="ano" <?php echo $a;?>>Ano
                      </label>
                      <input type="button" class="btn data btn-success" name="data_g" value=<?php echo (isset($_POST['data'])? "{$_POST['data']}" : "'".date("d/m/Y")."'" ); ?> id="data">
                      <button class="btn btn-info btn-circle" type="submit"><i class="fa fa-search"></i></button>
                      <input type="hidden" name="data" value=<?php echo (isset($_POST['data'])? "{$_POST['data']}" : "'".date("d/m/Y")."'" ); ?>>
                    </div>
                  </form>
                  </div>
              </div>
            </div>
            <div class="panel-body off-paddin">
              <div class="col-lg-12  alert alert-info" style="margin-bottom:0">
                Foram encontrados <?php echo count($usuarios); ?> registro(s)<?php echo /*$sol.$esp.$ca.*/$reg; ?>
              </div>
                  <?php
                    include_once "./includs/table_solicita_order_by.php";
                    show_table_soc($usuarios, $b);
                   ?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<script src="./js/jquery-ui.js"></script>
<script type="text/javascript">
$(function () {
  $.datepicker.regional['pt-BR'] = {
          closeText: 'Fechar',
          prevText: '&#x3c;Anterior',
          nextText: 'Pr&oacute;ximo&#x3e;',
          currentText: 'Hoje',
          monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
          'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
          monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
          'Jul','Ago','Set','Out','Nov','Dez'],
          dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
          dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
          dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
          weekHeader: 'Sm',
          dateFormat: 'dd/mm/yy',
          firstDay: 0,
          isRTL: false,
          showMonthAfterYear: false,
          yearSuffix: ''};
  $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
  console.log("hhh");
  $(".data").datepicker();
});
$("[type=submit]").click(function (e) {
  $("[name=data]").val($("[name=data_g]").val());
  //return false;
});
</script>
