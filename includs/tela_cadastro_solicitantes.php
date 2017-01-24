<?php
  $pag="./php/cadastro_geral.php?type=x15x";
  if (isset($_GET['add']) && $_GET['add']=="ok") {
    $pag="./php/cadastro_geral.php?type=x15x&red=true";
  }
  $titulo="Cadastro de Solicitante";
  if(isset($_GET['id'])) {
    $id=$_GET['id'];
    $titulo="Alterar Solicitante";
    $pag="./php/altera_geral.php?type=x15x";
    include_once './php/Solicitantes.php';
    include_once './php/Banco.php';
    $b=new Banco();
    $u=$b->getSolicitantesId($id);
    if (empty($u)) {
      echo "<h1 class='page-header'>Solicitacão não encontrado <i class='fa fa-frown-o' aria-hidden='true'></i></h1></div><script src=\"./js/bootstrap.min.js\"></script><script src=\"./js/metisMenu.min.js\"></script><script src=\"./js/sb-admin-2.js\"></script><script src=\"./js/show_img.js\"></script></body></html>";
      die();
    }
    $tipo=((isset($u) and !empty($u) and ($u->cpf=="0" or $u->cpf=="")) ? $u->cnpj : $u->cpf);
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
                Formulario para cadastro de Solicitante
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
                                <input class="form-control on-margin-left" placeholder="Nome do Solicitante" name="nome" type="text" value=<?php echo ((isset($u) and !empty($u)) ? "\"$u->nome\"" : ""); ?>>
                            </div>

                            <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                              <input type="hidden" name="id" value=<?php echo ((isset($id) and !empty($id)) ? "\"$id\"" : ""); ?>>
                              <div class="col-lg-3 off-margin-left">
                                <label>Email:</label>
                              </div>
                              <div class="col-lg-9 off-margin-left">
                                  <input class="form-control on-margin-left" placeholder="Email" name="mail" type="text" value=<?php echo ((isset($u) and !empty($u)) ? "\"$u->mail\"" : ""); ?>>
                              </div>
                            </div>

                            <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                              <div class="col-lg-3 off-margin-left">
                                <label>Descrição:</label>
                              </div>
                              <div class="col-lg-9 off-margin-left">
                                  <textarea name="desc" class="form-control on-margin-left textarea" rows="3"><?php echo ((isset($u) and !empty($u)) ? "$u->descricao" : ""); ?></textarea>
                              </div>
                            </div>

                            <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                              <div class="col-lg-3 off-margin-left">
                                <label>Endereço:</label>
                              </div>
                              <div class="col-lg-9 off-margin-left">
                                  <textarea name="endereco" class="form-control on-margin-left textarea" rows="3"><?php echo ((isset($u) and !empty($u)) ? "$u->endereco" : ""); ?></textarea>
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

                            <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                              <div class="col-lg-3 off-margin-left">
                                <label>Tipo:</label>
                              </div>
                              <div class="col-lg-9 off-margin-left">
                                <label class="radio-inline">
                                    <input type="radio" name="pessoa" id="pessoa" value="CNPJ" <?php echo ((isset($u) and !empty($u) and ($u->cpf=="0" or $u->cpf=="")) ? "checked" : "");?>>CNPJ
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="pessoa" id="pessoa1" value="CPF" <?php echo ((isset($u) and !empty($u) and ($u->cpf=="0" or $u->cpf=="")) ? "" : "checked");?>>CPF
                                </label>
                              </div>
                            </div>

                            <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                              <div class="col-lg-3 off-margin-left">
                                <label id="tipo">CPF:</label>
                              </div>
                              <div class="col-lg-5 off-margin-left">
                                  <input type="hidden" name="CPF" id="gab">
                                  <input class="form-control on-margin-left" id="pessoa2" placeholder="CPF" name="CPF" type="text" value=<?php echo (!empty($tipo)) ? $tipo : "" ; ?>>
                              </div>
                            </div>

                            <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                              <div class="col-lg-3 off-margin-left">
                                <label>Telefone:</label>
                              </div>
                              <div class="col-lg-5 off-margin-left">
                                  <input class="form-control on-margin-left" placeholder="Telefone" name="telefone" type="text" value=<?php echo ((isset($u) and !empty($u)) ? "\"$u->telefone\"" : ""); ?>>
                              </div>
                            </div>

                            <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                              <div class="col-lg-3 off-margin-left">
                                <label>Pessoa para contato:</label>
                              </div>
                              <div class="col-lg-5 off-margin-left">
                                  <input class="form-control on-margin-left" placeholder="Novo Contato" name="p_contato" type="text" value=<?php echo ((isset($u) and !empty($u)) ? "\"$u->contato\"" : ""); ?>>
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
<script type="text/javascript">

$(function () {
  $("#pessoa2").mask("999.999.999-99");
  $("[name=telefone]").mask("(99) 9999-99999");
});


$("input[name=pessoa]").click(function () {
    var tipo=$(this).val();
    $("#tipo").html(tipo);
    $("#pessoa2").attr("name", tipo);
    $("#pessoa2").attr("placeholder", tipo);
    var g=(tipo=="CPF")? "CNPJ" : "CPF" ;
    $("#gab").attr("name", g);
});


trocaPessoa();
function trocaPessoa() {
  $("input[name=pessoa]").each(function () {
    if ($(this).attr("checked")) {
      var tipo=$(this).val();
      $("#tipo").html(tipo);
      $("#pessoa2").attr("name", tipo);
      $("#pessoa2").attr("placeholder", tipo);
      var g=(tipo=="CPF")? "CNPJ" : "CPF" ;
      $("#gab").attr("name", g);
    }
  });

}
</script>
<?php
function erros(){
  if (isset($_GET['status'])) {
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
              <strong>Atenção!</strong> Já existe um solicitante com este nome
            </div>";
    }
    elseif ($_GET['status']=="erro") {
      echo "<div class=\"alert alert-danger\">
              <strong>Atenção!</strong> Falha no cadastro do solicitante
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
