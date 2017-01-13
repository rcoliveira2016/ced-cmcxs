<?php
  $pag="./php/cadastro_categoria.php";
  $titulo="Cadastro de Recurso";
  if(isset($_GET['id'])) {
    $id=$_GET['id'];
    $titulo="Alterar Recurso";
    $pag="./php/alterar_recurso.php";
    include_once './php/Usuario.php';
    include_once './php/Recurso.php';
    include_once './php/Espaco.php';
    include_once './php/Banco.php';
    $b=new Banco();
    $u=$b->getRecursoId($id);
    if (empty($u)) {
      echo "<h1 class='page-header'>Recurso não encontrado <i class='fa fa-frown-o' aria-hidden='true'></i></h1></div><script src=\"./js/bootstrap.min.js\"></script><script src=\"./js/metisMenu.min.js\"></script><script src=\"./js/sb-admin-2.js\"></script><script src=\"./js/show_img.js\"></script></body></html>";
      die();
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
                Formulario para cadastro de Recurso
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                      <?php
                        erros();
                      ?>
                        <form role="form" method="post" enctype="multipart/form-data" action=<?php echo "\"$pag\""; ?> >
                            <input type="hidden" name="id" value=<?php echo ((isset($id) and !empty($id)) ? "\"$id\"" : ""); ?>>
                            <div class="col-lg-3 off-margin-left">
                              <label>Nome:</label>
                            </div>
                            <div class="col-lg-9 off-margin-left">
                                <input class="form-control on-margin-left" placeholder="Nome da recurso" name="nome" type="text" value=<?php echo ((isset($u) and !empty($u)) ? "\"$u->nome\"" : ""); ?>>
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
                                <div class="col-lg-3 off-margin-left">
                                  <label>Situação:</label>
                                </div>
                                <div class="col-lg-9 off-margin-left">
                                  <label class="radio-inline">
                                      <input type="radio" name="situacao" id="optionsRadiosInline1" value="0" <?php echo ((isset($u) and !empty($u) and $u->situacao==1) ? "" : "checked");?>>Inativo
                                  </label>
                                  <label class="radio-inline">
                                      <input type="radio" name="situacao" id="optionsRadiosInline2" value="1" <?php echo ((isset($u) and !empty($u) and $u->situacao==1) ? "checked" : "");?> >Ativo
                                  </label>
                                </div>
                            </div>


                            <div class="col-lg-12 off-margin-left">
                              <div class="col-lg-3 off-margin-left">
                                <label>Espaço:</label>
                              </div>
                              <div class="col-lg-4 off-margin-left">
                                <select class="form-control off-paddin" id="espaco">
                                  <?php
                                    if (isset($u)) {
                                      $s=$b->get_espaco();
                                    }else {
                                      include_once './php/Espaco.php';
                                      include_once './php/Banco.php';
                                      $b=new Banco();
                                      $s=$b->get_espaco();
                                    }
                                    if (!empty($s)) {
                                      foreach ($s as $user) {
                                        echo "<option value=\"$user->id\">$user->nome</option>\n";
                                      }
                                    }
                                  ?>
                                </select>
                              </div>
                              <div class="col-lg-1 off-margin-left" >
                                <button type="button" class="btn btn-info" id="add">
                                  <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-danger" id="remove">
                                  <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                              </div>
                              <div class="col-lg-4 off-margin-left">
                                <select multiple class="form-control off-paddin" name="espaco[]" id="espacos">
                                  <?php
                                    if (isset($id)) {
                                      $s=$b->get_rel_rec_esp($id);
                                      foreach ($s as $user) {
                                        echo "<option value=\"$user->id\">$user->nome</option>\n";
                                      }
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-12 off-margin-left">
                              <div class="col-lg-3 off-margin-left">
                                <label>Icone:</label>
                              </div>
                              <div class="col-lg-9 off-margin-left">
                                <input type="file" name="icone">
                              </div>
                            </div>

                            <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                              <div class="col-lg-3 off-margin-left">
                                <label>Usuários:</label>
                              </div>
                              <div class="col-lg-4 off-margin-left">
                                <select class="form-control off-paddin" id="user">
                                  <?php
                                    if (isset($u)) {
                                      $s=$b->get_users();
                                    }else {
                                      include_once './php/Usuario.php';
                                      include_once './php/Banco.php';
                                      $b=new Banco();
                                      $s=$b->get_users();
                                    }
                                    if (!empty($s)) {
                                      foreach ($s as $user) {
                                        echo "<option value=\"$user->id\">$user->login</option>\n";
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
                                <select multiple class="form-control off-paddin" name="users[]" id="users">
                                  <?php
                                    if (isset($id)) {
                                      $s=$b->get_rel_rec_user($id);
                                      foreach ($s as $user) {
                                        echo "<option value=\"$user->id\">$user->nome</option>\n";
                                      }
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>


                            <div class="col-lg-12 off-margin-left">
                              <button id="submit-cadastro-usuario" class="btn btn-primary">Enviar</button>
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

<script>
$(".btn-info").click(function () {
  if ($(this).attr("id")!="add") {
    var n=$("#user").val(), s=$("#user option[value="+n+"]").html();
    if(n!=null){
      $("#users").append("<option value="+n+">"+s+"</optin>");
      $("#user option[value="+n+"]").remove();
    }
  } else {
    console.log($(this).attr("id"));
    var n=$("#espaco").val(), s=$("#espaco option[value="+n+"]").html();
    if(n!=null){
      $("#espacos").append("<option value="+n+">"+s+"</optin>");
      $("#espaco option[value="+n+"]").remove();
    }
  }
});
$(".btn-danger").click(function () {
  if ($(this).attr("id")!="remove") {
    var n=$("#users").val(), s=$("#users option[value="+n+"]").html();
    $("#user").append("<option value="+n+">"+s+"</optin>");
    $("#users option[value="+n+"]").remove();
  } else {
    var n=$("#espacos").val(), s=$("#espacos option[value="+n+"]").html();
    $("#espaco").append("<option value="+n+">"+s+"</optin>");
    $("#espacos option[value="+n+"]").remove();
  }

});

$("select").change(function () {
  $('select').css({border:"", background:""});
});
$("select").click(function () {
  $('select').css({border:"", background:""});
});
$("#submit-cadastro-usuario").click(function () {
  $("#users option, #espacos option").each(function () {
    $(this).attr("selected", "selected");
  });
});

</script>
<?php
function erros(){
  if (!empty($_GET['status'])) {
    if ($_GET['status']=="s") {
      echo "<div class=\"alert alert-success\">
              Cadastro foi Concluído
            </div>";
    }
    elseif ($_GET['status']=="advalidar") {
      echo "<div class=\"alert alert-warning\">
              <strong>Atenção!</strong> Já existe um recurso com este nome
            </div>";
    }
    elseif ($_GET['status']=="erro") {
      echo "<div class=\"alert alert-danger\">
              <strong>Atenção!</strong> Falha no cadastro do Recurso
            </div>";
    }
    elseif ($_GET['status']=="erroFile") {
      echo "<div class=\"alert alert-danger\">
              <strong>ERRO!</strong> Falha no upload do arquivo
            </div>";
    }
    elseif ($_GET['status']=="notImg") {
      echo "<div class=\"alert alert-danger\">
              <strong>Atenção!</strong> O arquivo não é uma imagem(jpg, gif, png, svg)
            </div>";
    }
    elseif ($_GET['status']=="cad") {
      echo "<div class=\"alert alert-danger\">
              <strong>Atenção!</strong> Erro na validação do formulário, verifique se não á nenhum campo vazio
            </div>";
    }
  }
}
?>
