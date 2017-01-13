<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Solicitante</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-red">
            <div class="panel-heading">
              Consulta de Solicitante - <a style="color:#FFD700" <?php echo "href='./index.php?pag=10&id=$u->id'"?>>Editar Solicitante</a>
            </div>
            <div class="panel-body">
              <input type="hidden" name="id" value=<?php echo ((isset($id) and !empty($id)) ? "\"$id\"" : ""); ?>>
              <div class="col-lg-3 off-margin-left">
                <label>Nome:</label>
              </div>
              <div class="col-lg-9 off-margin-left">
                  <p><?php echo ((isset($u) and !empty($u)) ? "$u->nome" : ""); ?></p>
              </div>

              <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                <div class="col-lg-3 off-margin-left">
                  <label>Email:</label>
                </div>
                <div class="col-lg-9 off-margin-left">
                    <p><?php echo ((isset($u) and !empty($u)) ? "$u->mail" : ""); ?></p>
                </div>
              </div>

              <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                <div class="col-lg-3 off-margin-left">
                  <label>Descrição:</label>
                </div>
                <div class="col-lg-9 off-margin-left">
                    <p><?php echo ((isset($u) and !empty($u)) ? "$u->descricao" : ""); ?></p>
                </div>
              </div>

              <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                <div class="col-lg-3 off-margin-left">
                  <label>Endereço:</label>
                </div>
                <div class="col-lg-9 off-margin-left">
                    <p><?php echo ((isset($u) and !empty($u)) ? "$u->endereco" : ""); ?></p>
                </div>
              </div>

              <div class="col-lg-12 off-margin-left">
                  <div class="col-lg-3 off-margin-left">
                    <label>Situação:</label>
                  </div>
                  <div class="col-lg-9 off-margin-left">
                    <p><?php  echo (($u->situacao==1) ? "Ativo" : "Inativo"); ?></p>
                  </div>
              </div>

              <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                <div class="col-lg-3 off-margin-left">
                  <label id="tipo"><?php echo ((isset($u) and !empty($u) and ($u->cpf=="0" or $u->cpf=="")) ? "CNPJ" : "CPF");?>:</label>
                </div>
                <div class="col-lg-5 off-margin-left">
                    <p>
                      <?php echo ((isset($u) and !empty($u) and ($u->cpf=="0" or $u->cpf=="")) ? $u->cnpj : $u->cpf);?>
                    </p>
                </div>
              </div>

              <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                <div class="col-lg-3 off-margin-left">
                  <label>Telefone:</label>
                </div>
                <div class="col-lg-5 off-margin-left">
                    <p><?php echo ((isset($u) and !empty($u)) ? "$u->telefone" : ""); ?></p>
                </div>
              </div>

              <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                <div class="col-lg-3 off-margin-left">
                  <label>Pessoa para contato:</label>
                </div>
                <div class="col-lg-5 off-margin-left">
                    <p><?php echo ((isset($u) and !empty($u)) ? "$u->contato" : ""); ?></p>
                </div>
              </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
