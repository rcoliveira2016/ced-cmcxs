<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Categoria</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              Consulta de Categoria - <a <?php echo "href='./index.php?pag=6&id=$u->id'"?>>Editar Categoria</a>
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
                          <label>Situacão:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><?php  echo (($u->situacao==1) ? "Ativo" : "Inativo"); ?></p>
                        </div>
                      </div>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Valido para Ano Letivo:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><?php  echo (($u->situacao==1) ? "Sim" : "Não"); ?></p>
                        </div>
                      </div>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Espaco:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><a class="link-off"<?php echo "href='./index.php?pag=16&tipo=2&id=".$b->getEspacoId($u->espaco)->id ."'"?>><?php echo $b->getEspacoId($u->espaco)->nome; ?></p>
                        </div>
                      </div>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                          <label>Usuários:</label>
                      </div>
                      <?php
                        include_once './php/Usuario.php';
                        $user=$b->get_rel_cat($id);
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
