<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Usuário</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-red">
            <div class="panel-heading">
              Consulta de Usuário - <a style="color:#FFD700" <?php echo "href='./index.php?pag=2&id=$u->id'"?>>Editar Usuário</a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Nome:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><?php echo $u->nome; ?></p>
                        </div>
                      </div>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Login:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><?php echo $u->login; ?></p>
                        </div>
                      </div>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Mail:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><?php echo $u->mail; ?></p>
                        </div>
                      </div>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Perfil:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><?php  echo (($u->situacao==1) ? "Ativo" : "Inativo"); ?></p>
                        </div>
                      </div>

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
