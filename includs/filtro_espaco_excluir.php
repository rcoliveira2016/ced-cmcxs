<?php
$b=new Banco();
if (isset($_POST['ano'])) {
  $d=explode("/", $_POST['data'])[2];
  $usuarios=$b->getPesquisaEspaco(1, $d, $_POST['espaco'],1);
}
elseif (isset($_POST['mes'])) {
  $d=explode("/", $_POST['data']);
  $usuarios=$b->getPesquisaEspaco(2, $d[2]."-".$d[1], $_POST['espaco'] ,1);
}
elseif (isset($_POST['dia'])) {
  $d=explode("/", $_POST['data']);
  $data=$d[2]."-".$d[1]."-".$d[0];
  $usuarios=$b->getPesquisaEspaco(3, $data, $_POST['espaco'], 1);
}
elseif (isset($_POST['semana'])) {
  include_once "./php/functions.php";
  $data=getData($_POST['data']);
  $semana=povoarSemana($data)[0];
  $usuarios=$b->get_solicitacoes_data_where($semana[0],$semana[6], $data[1],$data[2],$data[0], $_POST['espaco'], 1);
}
else {
  $usuarios=$b->get_solicitacoes("true");
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Filtro Espaço</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row">
                <div class="col-lg-12 off_margin">
                  <div class="col-lg-2 off_margin" style="padding:6px;">
                    Filtro Espaço - Resgistros <a href="#"><?php echo count($usuarios); ?></a>
                  </div>
                  <form action="./index.php?pag=17&tipo=esp" method="post">
                    <div class="col-lg-2">
                      <select class="form-control off-paddin " name="espaco" id="espaco">
                        <?php
                          include_once './php/Espaco.php';
                          $s=$b->get_espaco();
                          if (!empty($s)) {
                            foreach ($s as $user) {
                              $selc=($user->id==$_POST['espaco'])? ' selected' : "";
                              echo "<option value=\"$user->id\"$selc>$user->nome</option>\n";
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-lg-3 off_margin off-paddin">
                      <button type="submit" name="dia" class="btn-danger btn btn-data" >Dia</button>
                      <button type="submit" name="semana" class="btn-danger btn" >Semana</button>
                      <button type="submit" name="mes"  class="btn-danger btn">Mes</button>
                      <button type="submit" name="ano"  class="btn-danger btn">Ano</button>
                      <input type="button" class="btn data btn-success" name="data_g" value=<?php echo (isset($_POST['data'])? "{$_POST['data']}" : "'".date("d/m/Y")."'" ); ?> id="data">
                      <button class="btn btn-info btn-circle" type="submit"><i class="fa fa-search"></i></button>
                      <input type="hidden" name="data" value=<?php echo (isset($_POST['data'])? "{$_POST['data']}" : "'".date("d/m/Y")."'" ); ?>>
                    </div>
                  </form>
                  </div>
              </div>
            </div>
            <div class="panel-body off-paddin">
                  <?php
                    include_once "./includs/table_soli.php";
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
  return false;
});
</script>
