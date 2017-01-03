<?php
  $pag="./php/cadastro_geral.php?type=x12x";
  $titulo="Cadastro de Usuário";
  if(isset($_GET['id'])) {
    $id=$_GET['id'];
    $titulo="Alterar Usuário";
    $pag="./php/altera_geral.php?type=x12x";
    include_once './php/Usuario.php';
    include_once './php/Banco.php';
    $b=new Banco();
    $u=$b->getUserId($id);
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
                Formulario para cadastro de usuário
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                      <?php
                        erros();
                      ?>
                        <form role="form" method="post" action=<?php echo "\"$pag\""; ?>>
                          <?php if(!isset($id)){ ?>

                            <div class="form-group">
                                <div class="col-lg-4 off-margin-left">
                                  <label>Login:</label>
                                </div>
                                <div class="col-lg-8 off-margin-left">
                                    <p><select class="form-control off-paddin" name="login">
                                            <option value="null"></option>
                                        <?php
                                            include_once './php/functions.php';
                                            getUserAd();
                                        ?>
                                    </select></p>
                                </div>
                            </div>
                          <?php }else {
                                    echo "<div class=\"form-group\">
                                    <input type=\"hidden\" name=\"id\" value=\"$id\">
                                        <div class=\"col-lg-4 off-margin-left\">
                                          <label>Login:</label>
                                        </div>
                                        <div class=\"col-lg-8 off-margin-left\">
                                            <p>$u->login</p>
                                        </div>
                                    </div>";
                                }
                          ?>
                            <div class="form-group">
                                <div class="col-lg-4 off-margin-left">
                                  <label>Nome:</label>
                                </div>
                                <div class="col-lg-8 off-margin-left">
                                    <p id="name_ad"><?php echo ((isset($u) and !empty($u)) ? $u->nome : "&nbsp;") ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-4 off-margin-left">
                                  <label>Mail:</label>
                                </div>
                                <div class="col-lg-8 off-margin-left">
                                    <p id="mail_ad"> <?php echo ((isset($u) and !empty($u)) ? $u->mail : "&nbsp;") ?> </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-4 off-margin-left">
                                  <label>Situação:</label>
                                </div>
                                <div class="col-lg-8 off-margin-left">
                                  <label class="radio-inline">
                                      <input type="radio" name="situacao" id="optionsRadiosInline1" value="0" <?php echo ((isset($u) and !empty($u) and $u->situacao!=1) ? "checked" : "") ?>>Inativo
                                  </label>
                                  <label class="radio-inline">
                                      <input type="radio" name="situacao" id="optionsRadiosInline2" value="1"  <?php echo ((isset($u) and !empty($u) and $u->situacao==1) ? "checked" : "") ?>>Ativo
                                  </label>
                                </div>
                            </div>
                            <div class="col-lg-12 off-margin-left">
                                <div class="col-lg-4 off-margin-left">
                                  <label>Perfil:</label>
                                </div>
                                <div class="col-lg-8 off-margin-left">
                                  <p><label class="radio-inline">
                                      <input type="radio" name="perfil" id="optionsRadiosInline1" value="1" <?php echo ((isset($u) and !empty($u) and $u->perfil==1) ? "checked" : "") ?>>Administrador
                                  </label>
                                  <label class="radio-inline">
                                      <input type="radio" name="perfil" id="optionsRadiosInline2" value="2" <?php echo ((isset($u) and !empty($u) and $u->perfil==2) ? "checked" : "") ?>>Usuário
                                  </label></p>
                                </div>

                            </div>
                            <div class="col-lg-12 off-margin-left">
                              <button type="submit" id="submit-cadastro-usuario" class="btn btn-primary">Enviar</button>
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
    $("select").change(function () {
    if($(this).val()!="null"){
        $('select').css({border:"", background:""});
        var nome=$(this).val();
        console.log(nome)
        $("#name_ad").html(nome);
        $("#mail_ad").html(nome+"@camaracaxias.rs.gov.br");
    }
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
    elseif ($_GET['status']=="erroad") {
      echo "<div class=\"alert alert-danger\">
            <strong>Atenção!</strong>  Falha na conexão do servidor Activity Directory
            </div>";
    }
    elseif ($_GET['status']=="advalidar") {
      echo "<div class=\"alert alert-warning\">
              <strong>Atenção!</strong> Já existe um usário com este nome
            </div>";
    }
    elseif ($_GET['status']=="erro") {
      echo "<div class=\"alert alert-danger\">
              <strong>Atenção!</strong> Falha no cadastro do usuário
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
