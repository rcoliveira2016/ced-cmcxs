$("#submit-cadastro-usuario").click(function(evt){
    if (!selectValidar()) {
      return false;
    }
});

$("select").change(function () {
    if(selectValidar()){
        $('select').css({border:"", background:""});
    }
});

$("input[type=text], input[type=password], .textarea").focusout(function (){
    if ($(this).val()==""){
        $(this).css({border:"2px solid #f00"});
    }else{
        $(this).css({border:"", background:""});
    }
});

$("button[type=submit]").click(function (){
    return validarCampos();
})
var g=true;
function validarCampos(){
    $("input[type=text], input[type=password], input[type=hidden], .textarea").each(function (){
      if($(this).val()=="" || ($(this).val()=="" && $(this).prop("tagName")=="TEXTAREA")){
         $(this).css({border:"2px solid #f00"});
         g=false;
      }
    });
    return g;
}
function selectValidar() {
  var select=$('select').val();
  if($('select').val()=="null"){
    $('select').css({border:"2px solid #f00"});
    return false;
  }
  return true;
}
