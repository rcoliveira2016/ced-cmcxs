$("img").click(function () {
  var width = $("body").width();
  var height = $("body").height();

  var left = 0;
  var top = 0;

  window.open("./"+$(this).attr("src"),'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
});
