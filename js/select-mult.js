$(".btn-info").click(function () {
  var n=$("#user").val(), s=$("#user option[value="+n+"]").html();
  if(n!=null){
    $("#users").append("<option value="+n+">"+s+"</optin>");
    $("#user option[value="+n+"]").remove();
  }
});
$(".btn-danger").click(function () {
  var n=$("#users").val(), s=$("#users option[value="+n+"]").html();
  $("#user").append("<option value="+n+">"+s+"</optin>");
  $("#users option[value="+n+"]").remove();
});
$("select").change(function () {
  $('select').css({border:"", background:""});
});
$("select").click(function () {
  $('select').css({border:"", background:""});
});
$("#submit-cadastro-usuario").click(function () {
  $("#users option").each(function () {
    $(this).attr("selected", "selected");
  });
});
