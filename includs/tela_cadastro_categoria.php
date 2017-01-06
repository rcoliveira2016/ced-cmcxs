<?php
  $pag="./php/cadastro_geral.php?type=x48x";
  $titulo="Cadastro de Categoria";
  if(isset($_GET['id'])) {
    $id=$_GET['id'];
    $titulo="Alterar Categoria";
    $pag="./php/altera_geral.php?type=x48x";
    include_once './php/Usuario.php';
    include_once './php/Categoria.php';
    include_once './php/Espaco.php';
    include_once './php/Banco.php';
    $b=new Banco();
    $u=$b->getCategoriaId($id);
    if (empty($u)) {
      echo "<h1 class='page-header'>Categoria não encontrado <i class='fa fa-frown-o' aria-hidden='true'></i></h1></div><script src=\"./js/bootstrap.min.js\"></script><script src=\"./js/metisMenu.min.js\"></script><script src=\"./js/sb-admin-2.js\"></script><script src=\"./js/show_img.js\"></script></body></html>";
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
                Formulario para cadastro de categoria
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                      <?php
                        erros();
                      ?>
                        <form role="form" method="post" action=<?php echo "\"$pag\""; ?>>
                            <input type="hidden" name="id" value=<?php echo ((isset($id) and !empty($id)) ? "\"$id\"" : ""); ?>>
                            <div class="col-lg-3 off-margin-left">
                              <label>Nome:</label>
                            </div>
                            <div class="col-lg-9 off-margin-left">
                                <input class="form-control on-margin-left" placeholder="Nome da categoria" name="nome" type="text" value=<?php echo ((isset($u) and !empty($u)) ? "\"$u->nome\"" : ""); ?>>
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
                                <select class="form-control off-paddin" name="espaco" >
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
                                        $esp=$b->getEspacoId($u->espaco);
                                        $sec=($user->nome==$esp->nome)? " selected" : "";
                                        echo "<option value=\"$user->id\"$sec>$user->nome</option>\n";
                                      }
                                    }
                                  ?>
                                </select>
                              </div>

                            <div class="col-lg-12 off-margin-left">
                                <div class="col-lg-3 off-margin-left">
                                  <label></label>
                                </div>
                                <div class="col-lg-9 off-margin-left">
                                  <label class="checkbox-inline off-margin-lef">
                                      <input type="checkbox" name="validar" id="optionsRadiosInline1" value="1" <?php echo ((isset($u) and !empty($u) and $u->validar==1) ? "checked" : "");?>>Valido para Ano Letivo
                                  </label>
                                </div>
                            </div>

                            <div class="col-lg-12 off-margin-left">
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
                                      $s=$b->get_rel_cat($id);
                                      foreach ($s as $user) {
                                        echo "<option value=\"$user->id\">$user->login</option>\n";
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
$("#submit-cadastro-usuario").click(function () {
  $("#users option").each(function () {
    $(this).attr("selected", "selected");
  });
});

</script>
<?php
function erros(){
  if (isset($_GET['status'])) {
    if ($_GET['status']=="s") {
      echo "<div class=\"alert alert-success\">
              Cadastro foi Concluído
            </div>";
    }
    elseif ($_GET['status']=="advalidar") {
      echo "<div class=\"alert alert-warning\">
              <strong>Atenção!</strong> Já existe um categoria com este nome
            </div>";
    }
    elseif ($_GET['status']=="erro") {
      echo "<div class=\"alert alert-danger\">
              <strong>Atenção!</strong> Falha no cadastro do categoria
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
