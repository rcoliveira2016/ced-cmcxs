div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Espaço</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              Consulta de Espaço - <a <?php echo "href='./index.php?pag=4&id=$u->id'"?>>Editar Espaço</a>
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
                          <label>Descrição:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><?php echo $u->desc; ?></p>
                        </div>
                      </div>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Cor:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <div <?php echo "style='background:$u->cor;width:25px;height:25px'"; ?>>

                            </div>
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
                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                          <label>Usuários:</label>
                      </div>
                      <?php
                        include_once './php/Usuario.php';
                        $user=$b->get_rel_espaco($id);
                        if (!empty($user)) {
                          foreach ($user as $o) {
                            echo '<div class="col-lg-12 off-margin-left" style="margin-top:5px">
                                    <div class="col-lg-3 ">
                                      <label>Nome:</label>
                                    </div>
                                    <div class="col-lg-9 off-margin-left">
                                      <p><a href="./index.php?pag=16&tipo=1&id='.$o->id.'" class="link-off">'.$o->nome.'</a></p>
                                    </div>
                                  </div>';
                          }
                        }else {
                          echo '<div class="col-lg-9 off-margin-left">
                                  <p>Não existe usuários relacionados com essa categoria</p>
                                </div>';
                        }
                      ?>

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
