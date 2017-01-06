<?php
  $pag="./php/cadastro_geral.php?type=x22x";
  $titulo="Cadastro de Espaço";
  if(isset($_GET['id'])) {
    $id=$_GET['id'];
    $titulo="Alterar Espaço";
    $pag="./php/altera_geral.php?type=x22x";
    include_once './php/Usuario.php';
    include_once './php/Espaco.php';
    include_once './php/Banco.php';
    $b=new Banco();
    $u=$b->getEspacoId($id);
    if (empty($u)) {
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
                Formulario para cadastro de espaço
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
                                <input class="form-control on-margin-left" placeholder="Nome do espaço" name="nome" type="text" value=<?php echo ((isset($u) and !empty($u)) ? "\"$u->nome\"" : ""); ?>>
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
                                <label>Cor</label>
                              </div>
                              <div class="col-lg-9 off-margin-left" style="margin-top:5px">
                                <input type="hidden" name="cor" value=<?php echo ((isset($u) and !empty($u)) ? "\"$u->cor\"" : ""); ?>>
                              </div>
                            </div>

                            <div class="col-lg-12 off-margin-left">
                                <div class="col-lg-3 off-margin-left">
                                  <label>Situação:</label>
                                </div>
                                <div class="col-lg-9 off-margin-left">
                                  <label class="radio-inline">
                                      <input type="radio" name="situacao" id="optionsRadiosInline1" value="0" <?php echo ((isset($u) and !empty($u) and $u->situacao!=1) ? "checked" : "");?>>Inativo
                                  </label>
                                  <label class="radio-inline">
                                      <input type="radio" name="situacao" id="optionsRadiosInline2" value="1" <?php echo ((isset($u) and !empty($u) and $u->situacao==1) ? "checked" : "");?> >Ativo
                                  </label>
                                </div>
                            </div>

                            <div class="col-lg-12 off-margin-left">
                              <div class="col-lg-3 off-margin-left">
                                <label>Usuários</label>
                              </div>
                              <div class="col-lg-4 off-margin-left">
                                <select class="form-control off-paddin" id="user">
                                  <?php
                                    include_once './php/Usuario.php';
                                    include_once './php/Banco.php';
                                    $b=new Banco();
                                    $s=$b->get_users();
                                    foreach ($s as $user) {
                                      echo "<option value=\"$user->id\">$user->login</option>\n";
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
                                      $s=$b->get_rel_espaco($id);
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
<script src="./js/palette-color-picker.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('[name="cor"]').paletteColorPicker({
    colors: [
      {"#C2185B": "#C2185B"},
      {"#F8BBD0": "#F8BBD0"},
      {"#CDDC39": "#CDDC39"},
      {"#212121": "#212121"},
      {"#727272": "#727272"},
      {"#B6B6B6": "#B6B6B6"},
      {"#4B0082":"#4B0082"},
      {"#6A5ACD":"#6A5ACD"},
      {"#800000":"#800000"},
      {"#FF4500":"#FF4500"},
      {"#FFA500":"#FFA500"},
      {"#2E8B57":"#2E8B57"},
      {"#BC8F8F":"#BC8F8F"},
      {"#8B4513":"#8B4513"},
      {"#FF0000":"#FF0000"},
      {"#4682B4":"#4682B4"},
      {"#C71585":"#C71585"},
      {"#191970":"#191970"}
    ],
    custom_class: 'double',
    position: 'upside',
    insert: 'before',
    clear_btn: 'first',
    timeout: 10000
  });
});
</script>
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
  $("#users option, #espacos option").each(function () {
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
              <strong>Atenção!</strong> Já existe um espaço com este nome, ou com a mesma cor
            </div>";
    }
    elseif ($_GET['status']=="erro") {
      echo "<div class=\"alert alert-danger\">
              <strong>Atenção!</strong> Falha no cadastro do espaço
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
