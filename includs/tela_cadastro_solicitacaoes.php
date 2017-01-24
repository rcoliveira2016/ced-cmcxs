<?php
  $pag="./php/cadastro_geral.php?type=x111x";
  $titulo="Cadastro de Solicitações";
  if(isset($_GET['id'])) {
    $titulo="Alterar Solicitação";
    $pag="./php/altera_geral.php?type=x111x";
    include_once './php/Solicitantes.php';
    include_once './php/Solicitacoes.php';
    include_once './php/Categoria.php';
    include_once './php/Recurso.php';
    include_once './php/Usuario.php';
    include_once './php/Recurso.php';
    include_once './php/Espaco.php';
    include_once './php/Banco.php';
    $b=new Banco();
    $id=$_GET['id'];
    $u=$b->getSolicitacoesId($_GET['id']);
    if (empty($u)) {
      echo "<h1 class='page-header'>Solicitação não encontrado <i class='fa fa-frown-o' aria-hidden='true'></i></h1></div><script src=\"./js/bootstrap.min.js\"></script><script src=\"./js/metisMenu.min.js\"></script><script src=\"./js/sb-admin-2.js\"></script><script src=\"./js/show_img.js\"></script></body></html>";
      die();
    }
    if(isset($_GET['excluir'])){
      if ($_GET['excluir']==$_GET['id'] and $b->ocultar_solicitacao($_GET['excluir'])) {
        $_GET['status']="ex_y";
      }else {
        $_GET['status']="dados";
      }
    }
  }
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $titulo; ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row on-margin-left">
                Formulario para <?php echo $titulo; if(isset($u)){?>
                  <a <?php echo 'href="./index.php?pag=11&id='.$id.'&excluir='.$id.'"'; ?> type="button" style="float:right" class="btn btn-danger" title="Excluir solitação">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>
                  <!-- <a <?php echo 'href="./php/criar-pdf.php?&id='.$id.'"'; ?> type="button" target="_back" style="float:right;margin-right:5px;" class="btn btn-primary" title="Termo de aceitação">
                    <i class="fa fa-print" aria-hidden="true"></i>
                  </a> -->
                <?php } ?>
              </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                      <div id="v_erro">
                        <?php
                          erros();
                        ?>
                      </div>
                        <form role="form" method="post" id="form" action=<?php echo "\"$pag\""; ?> >
                          <?php if(isset($_SESSION['id']) and !empty($_SESSION['id'])) echo '<input type="hidden" name="id" value="'.$_SESSION['id'].'">' ?>
                          <?php if(isset($id)) echo '<input type="hidden" name="id_s" value="'.$id.'">' ?>
                          <div class="form-group">
                              <div class="col-lg-3 off-margin-left">
                                <label>Solicitante:</label>
                              </div>
                              <div class="col-lg-8 off-margin-left">
                                <select class="form-control off-paddin" name="solicitantes">
                                  <option></option>
                                      <?php
                                        if (!isset($u) and empty($u)) {
                                          include_once './php/Solicitantes.php';
                                          include_once './php/Banco.php';
                                          $b=new Banco();
                                        }
                                        $s=$b->get_solicitantes();
                                        if (!empty($s)) {
                                          foreach ($s as $user) {
                                            $sec=(isset($u) and $user->id==$u->solicitante)? " selected" : "";
                                            echo "<option value='$user->id'$sec>".$user->nome."</option>";
                                          }
                                        }
                                      ?>
                                  </select>
                              </div>
                              <div class="col-lg-1 off-margin-left editar_table" >
                                <a href="./index.php?pag=10&add=ok" class="btn btn-danger"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a>
                              </div>
                          </div>

                          <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                              <div class="col-lg-3 off-margin-left">
                                <label>Categoria:</label>
                              </div>
                              <div class="col-lg-9 off-margin-left">
                                <select class="form-control off-paddin" name="categoria">
                                      <option value="null"></option>
                                      <?php
                                          if (!isset($u) and empty($u)) {
                                            include_once './php/Categoria.php';
                                            include_once './php/Banco.php';
                                            $b=new Banco();
                                          }
                                          $s=$b->get_categoria_select();
                                          if (!empty($s)) {
                                            foreach ($s as $user) {
                                              $sec=(isset($u) and $user->id==$u->categoria)? " selected" : "";
                                              echo "<option value='$user->id'$sec data='$user->espaco'>".$user->nome."</option>";
                                            }
                                          }
                                      ?>
                                  </select>
                              </div>
                          </div>

                          <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                            <div class="col-lg-3 off-margin-left">
                              <label>Assunto:</label>
                            </div>
                            <div class="col-lg-9 off-margin-left">
                                <input class="form-control on-margin-left" placeholder="Assunto" name="assunto" type="text" value=<?php echo ((isset($u) and !empty($u)) ? "\"$u->assunto\"" : ""); ?>>
                            </div>
                          </div>

                          <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                              <div class="col-lg-3 off-margin-left">
                                <label>Espaço:</label>
                              </div>
                              <div class="col-lg-9 off-margin-left">
                                <select class="form-control off-paddin" name="espaco">
                                      <option value="null"></option>
                                      <?php
                                          if (!isset($u) and empty($u)) {
                                            include_once './php/Espaco.php';
                                            include_once './php/Banco.php';
                                            $b=new Banco();
                                          }
                                          $s=$b->get_espaco();
                                          if (!empty($s)) {
                                            foreach ($s as $user) {
                                              $sec=(isset($u) and $user->id==$u->espaco)? " selected" : "";
                                              echo "<option value='$user->id'$sec>".$user->nome."</option>";
                                            }
                                          }
                                      ?>
                                  </select>
                              </div>
                          </div>

                          <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                            <div class="col-lg-3 off-margin-left">
                              <label>Interno:</label>
                            </div>
                            <div class="col-lg-5 off-margin-left">
                                <label class="checkbox-inline off-margin-lef">
                                  <input id="optionsRadiosInline1" name="interno" value="1" type="checkbox" <?php echo ((isset($u) and !empty($u) and $u->interno==1)? "checked": ""); ?>>(Não mostrar esta solicitação no site da câmara)
                                </label>
                            </div>
                          </div>

                          <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                            <div class="col-lg-3 off-margin-left">
                              <label>Data:</label>
                            </div>
                            <div class="col-lg-2 off-margin-left">
                              <input class="form-control on-margin-left" id="data" name="data" type="text" value=<?php echo ((isset($u) and !empty($u)) ? "\"$u->data\"" : ((isset($_GET['data']) and !empty($_GET['data']))? $_GET['data']: "")); ?>>
                            </div>
                          </div>

                          <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                            <div class="col-lg-3 off-margin-left">
                              <label>Hora inicial:</label>
                            </div>
                            <div class="col-lg-1 off-margin-left">
                              <input class="form-control on-margin-left" id="data" name="h_inicial" type="text" value=<?php echo ((isset($u) and !empty($u)) ? "\"$u->h_inicial\"" : ((isset($_GET['h_i']) and !empty($_GET['h_i']))? $_GET['h_i']: "")); ?>>
                            </div>
                          </div>

                          <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                            <div class="col-lg-3 off-margin-left">
                              <label>Hora final:</label>
                            </div>
                            <div class="col-lg-1 off-margin-left">
                              <input class="form-control on-margin-left" id="data" name="h_final" type="text" value=<?php echo ((isset($u) and !empty($u)) ? "\"$u->h_final\"" : ((isset($_GET['h_f']) and !empty($_GET['h_f']))? $_GET['h_f']: "")); ?>>
                            </div>
                          </div>

                          <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                            <div class="col-lg-3 off-margin-left">
                              <label>Recurso</label>
                            </div>
                            <div class="col-lg-4 off-margin-left">
                              <select class="form-control off-paddin" id="rec">
                                <?php
                                  include_once './php/Recurso.php';
                                  include_once './php/Banco.php';
                                  $b=new Banco();
                                  $s=(isset($u))? $b->get_recurso_espaco($u->espaco) : "NULL";
                                  if ($s!="NULL") {
                                    foreach ($s as $user) {
                                      echo "<option value=\"$user->id\">$user->nome</option>\n";
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                            <div class="col-lg-1 off-margin-left editar_table" >
                              <button type="button" class="btn btn-info">
                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                              </button>
                              <button type="button" class="btn btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                              </button>
                            </div>
                            <div class="col-lg-4 off-margin-left">
                              <select multiple class="form-control off-paddin" name="rec[]" id="recs">
                                <?php
                                  if (isset($id)) {

                                    $s=$b->get_rel_solicitacoes($id);
                                    if (!empty($b)) {
                                      foreach ($s as $user) {
                                        echo "<option value=\"$user->id\">$user->nome</option>\n";
                                      }
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                            <div class="col-lg-3 off-margin-left">
                              <label>Descrição:</label>
                            </div>
                            <div class="col-lg-9 off-margin-left">
                                <textarea name="desc" class="form-control on-margin-left textarea" rows="3"><?php echo ((isset($u) and !empty($u)) ? "$u->desc" : ""); ?></textarea>
                            </div>
                          </div>

                            <div class="col-lg-12 off-margin-left">
                              <button id="submit-cadastro-usuario" type="button" class="btn btn-primary">Enviar</button>
                            </div>



                        </form>
                    </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<script src="./js/jquery-ui.js"></script>
<script>

$("[name=categoria]").change(function() {
  $('[name=espaco]').val($( "[name=categoria] option:selected" ).attr('data'));
});

$("[name=espaco]").change(function () {
  var id=$("[name=espaco]").val();
  ajax={
    type:"post",
    data:{id:id},
    url:"./ajax_php/select_espaco.php",
    success:function (data) {
      $("#recs").html("");
      $("#rec").html(data);
    }
  }
  $.ajax(ajax);
});

$(".btn-info").click(function () {
  var n=$("#rec").val(), s=$("#rec option[value="+n+"]").html();
  if(n!=null){
    $("#recs").append("<option value="+n+">"+s+"</optin>");
    $("#rec option[value="+n+"]").remove();
  }
});
$(".btn-danger").click(function () {
  var n=$("#recs").val(), s=$("#recs option[value="+n+"]").html();
  $("#rec").append("<option value="+n+">"+s+"</optin>");
  $("#recs option[value="+n+"]").remove();
});
$("#submit-cadastro-usuario").click(function (evet) {
  $.ajax({
    type:"post",
    data:{data:$("[name=data]").val(), esp:$("[name=espaco]").val(), hora_i:$("[name=h_inicial]").val(), id:$("[name=id_s]").val(), hora_f:$("[name=h_final]").val()},
    url:"./ajax_php/validar.php",
    success:function (data) {
      console.log(data);
      if(data=="0"){
        $("#v_erro").html("<div class=\"alert alert-danger\"><strong>Atenção!</strong> Já existe um solicitação neste espaço, com o mesmo horário</div>");
        evet.preventDefault();
        return ;
      }else{
        $("#recs option").each(function () {
          $(this).attr("selected", "selected");
        });
        $("#form").submit();
      }
    },
    fail:function( data ){
      $("#v_erro").html("<div class=\"alert alert-warning\"><strong>Atenção!</strong> Erro no servidor, tente mais tarde ."+data+"</div>");
      evet.preventDefault();
      return ;
    }
  });
  if(validarHoras()){
    $("#v_erro").html("<div class=\"alert alert-danger\"><strong>Atenção!</strong> Erro na validação dos horarios</div>");
    evet.preventDefault();
    return ;
  }
});

function validarHoras() {
  var f=$("[name=h_final]").val();
  var i=$("[name=h_inicial]").val();
  f=f.split(":");
  i=i.split(":");
  if($.isNumeric(f[0]) && $.isNumeric(f[1]) &&  $.isNumeric(i[1]) && $.isNumeric(i[0])){
    if (f[0]<23 && f[1]<60 && i[0]<23 && i[1]<60) {
      if(f[0]>i[0]){
        return false;
      }
      else if (f[0]==i[0] && (f[1]>i[1])) {
        return false;
      }
    }
  }
  return true
}

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
          showMonthAfterYear: true,
          yearSuffix: ''};
  $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
  $("#data").datepicker();
  $("[name=h_final]").mask("99:99");
  $("[name=h_inicial]").mask("99:99");
});
</script>
<?php
function erros(){
  if (!empty($_GET['status'])) {
    if ($_GET['status']=="s") {
      echo "<div class=\"alert alert-success\">
              <strong><i class='fa fa-exclamation-circle fa-4' aria-hidden='true'></i></strong> Cadastro foi Concluído
            </div>";
    }
    elseif ($_GET['status']=="a") {
      echo "<div class=\"alert alert-success\">
            <strong><i class='fa fa-exclamation-circle fa-4' aria-hidden='true'></i></strong> Alteração concluída com sucesso
            </div>";
    }
    elseif ($_GET['status']=="advalidar") {
      echo "<div class=\"alert alert-warning\">
              <strong>Atenção!</strong> Já existe uma solicitação com essa data, no mesmo lugar
            </div>";
    }
    elseif ($_GET['status']=="erro") {
      echo "<div class=\"alert alert-danger\">
              <strong>Atenção!</strong> Falha na solicitação
            </div>";
    }
    elseif ($_GET['status']=="h") {
      echo "<div class=\"alert alert-danger\"><strong>Atenção!</strong> Erro na validação dos horarios</div>";
    }
    elseif ($_GET['status']=="hV") {
      echo "<div class=\"alert alert-danger\"><strong>Atenção!</strong> Já existe um solicitação neste espaço, com o mesmo horário</div>";
    }
    elseif ($_GET['status']=="cad") {
      echo "<div class=\"alert alert-danger\">
              <strong>Atenção!</strong> Erro na validação do formulário, verifique se não á nenhum campo vazio
            </div>";
    }
    elseif ($_GET['status']=="dados") {
      echo "<div class=\"alert alert-danger\">
              <strong>Atenção!</strong> Erro na exclusão
            </div>";
    }
    elseif ($_GET['status']=="ex_y") {
      echo "<div class=\"alert alert-success\">
              Exclusão foi Concluído
            </div>";
    }
  }
}
?>
