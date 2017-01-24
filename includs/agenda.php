<?php
include_once './php/functions.php';
$d=(isset($_GET['data'])? $_GET['data'] : date("d/m/Y"));
$arr_data=getData($d);
if(!checkdate($arr_data[1], $arr_data[0], $arr_data[2])){
  $d=date("d/m/Y");
}
$arr_data=getData($d);
$arr_data[0]=c($arr_data[0]);
$arr_data[1]=c($arr_data[1]);
$d=$arr_data[0]."/".$arr_data[1]."/".$arr_data[2];
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $titulo; ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div id="contener-panel">
              <div class="panel-heading">
                   <form action="?pag=18" method="get">
                     Agenda -
                     <input type="button" class="btn btn-danger" name="data_g" value=<?php echo "'$d'"; ?> id="data">
                     <button class="btn btn-info btn-circle" type="submit"><i class="fa fa-search"></i></button>
                     <input type="hidden" name="data" value=<?php echo "'$d'"; ?>>
                     <input type="hidden" name="pag" value='18'>
                   </form>
              </div>
              <div class="panel-body">
                <?php include_once './php/show_agenda.php'; ?>
              </div>
            </div>
        </div>
    </div>
</div>
<script src="./js/jquery-ui.js"></script>
<script type="text/javascript">
var id="ii";
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
  weekHeader: 'Sm',dateFormat: 'dd/mm/yy',firstDay: 0,isRTL: false,
  showMonthAfterYear: false,yearSuffix: ''};
  $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
  $("#data").datepicker();
});
$("[type=submit]").click(function (e) {
  $("[name=data]").val($("[name=data_g]").val());
});
$(".day-calender").hover(function () {
  $(this).css("background", "#3a97e7");
  $(this).find("a").css("color", "rgb(23, 19, 87)");
  $(this).find("h4").css("color", "rgb(23, 19, 87)");
}).mouseleave(function () {
  $(this).css("background", "#337ab7");
  $(this).find("a").css("color", "#fff");
  $(this).find("h4").css("color", "#ccc");
});
</script>
