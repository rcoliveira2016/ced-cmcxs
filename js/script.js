var intervalo = window.setInterval(lerolero, 800);
function lerolero() {
  if($(".alert-icon").css("color")=="rgb(51, 122, 183)"){
    $(".alert-icon").css("color", "rgb(249, 98, 40)");
    $("#alerta").css("background", "#eeeeee");
  }else {
    $(".alert-icon").css("color", "#337ab7");
    $("#alerta").css("background", "#f8f8f8");
  }
}

$("#alerta").click(function () {
  clearInterval(intervalo);
  $(".alert-icon").css("color", "#337ab7");
  $("#alerta").css("background", "#f8f8f8");
  $.post('./ajax_php/validar-alert.php', {select:true});
});
