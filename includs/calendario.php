<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Calendário</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div id="contener-panel">
              <div class="panel-heading">
                   <form action="./index.php?pag=15" method="post">
                     Calendário -
                     <input type="button" class="btn btn-danger" name="data_g" value=<?php echo (isset($_POST['data'])? "{$_POST['data']}" : "'".date("d/m/Y")."'" ); ?> id="data">
                     <button class="btn btn-info btn-circle" type="submit"><i class="fa fa-search"></i></button>
                     <input type="hidden" name="data" value=<?php echo (isset($_POST['data'])? "{$_POST['data']}" : "'".date("d/m/Y")."'" ); ?>>
                   </form>
              </div>
              <div class="panel-body">
                <?php
                  include_once('./php/functions.php');
                  include_once("./php/calendarios_php.php");
                  $d=isset($_POST['data'])? $_POST['data'] : date("d/m/Y");
                  $arr_data=getData($d);
                  getMes($arr_data ,$d);
                ?>
              </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-green info">
  <div class="panel-heading">
    <span>Info</span> <span class="btn btn-danger exit"><i class="fa fa-times fa-fw"></i></span>
  </div>
  <div class="panel-body info-body">

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
          weekHeader: 'Sm',
          dateFormat: 'dd/mm/yy',
          firstDay: 0,
          isRTL: false,
          showMonthAfterYear: false,
          yearSuffix: ''};
  $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
  $("#data").datepicker();
  calendarioConstru();
});
$("[type=submit]").click(function (e) {
  $("[name=data]").val($("[name=data_g]").val());
  //return false;
});

$(".td-off").mouseover(function () {
    $(".info").hide();
});

$(".td-calender").mouseenter(function (e) {
  id=$(this).attr("value");
  $.ajax({
    url:'./ajax_php/solitacao.php',
    type:'post',
    data:{'id':id},
    success:function (data) {
      $(".info-body").html(data);
      $(".info").show();
    }
  });
});


function calendarioConstru() {
  $(".div").each(function (index) {
    var dia=$(this).attr("data_d");
    var h_f=$(this).attr("hora_f");
    var h_i=$(this).attr("hora_i");
    var top=$('[data_h="'+h_i+'"]');
    var div=$(this).attr("data_div");
    var width=parseFloat($('[data_h="'+h_i+'"]').css("width"))/parseFloat(div);
    var addLeft=getLeft($(this).attr("value"));
    var left=$('[dia='+dia+']');
    var css={
            top: top.offset().top+"px",
            left: left.offset().left+"px",
            width: width
    }
    $(this).css(css);
  });
}


function getLeft(value, h_i) {
  $("[data_h='"+h_i+"']").each(function (index) {
    if($(this).offset().top==top.offset().top){
      return $(this).attr("data_div");
    }
  });
}

$(".td-calender").click(function (e) {
    $(location).attr("href","?pag=16&tipo=6&id="+$(this).attr("value"));
});
$(".td-off").click(function () {
  var h_f=$(this).attr("data_f")
  var h=$(this).attr("data_h");
  var data=$(this).attr("data_d")+"/"+$("[name=data]").val().split("/")[1]+"/"+$("[name=data]").val().split("/")[2];
  $(location).attr("href","?pag=11&h_i="+h+"&data="+data+"&h_f="+h_f);
});
$(".exit").click(function () {
  $(".info").hide();
})
</script>
