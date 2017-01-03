<?php
$espaco=$b->getEspacoId($u->espaco)->nome;
$categoria=$b->getCategoriaId($u->categoria)->nome;
$solicitantes=$b->getSolicitantesId($u->solicitante)->nome;
$usu=$b->getUserId($u->user)->nome;
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Solicitações</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              Consulta de Solicitações - <a <?php echo "href='./index.php?pag=11&id=$u->id'"?>>Editar Solicitações</a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Solicitante:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><a class="link-off" <?php echo "href='./index.php?pag=16&tipo=5&id=$u->solicitante'"; ?>><?php echo $solicitantes; ?></a></p>
                        </div>
                      </div>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Categoria:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><a class="link-off" <?php echo "href='./index.php?pag=16&tipo=3&id=$u->categoria'";?>><?php echo $categoria; ?></a></p>
                        </div>
                      </div>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Assunto:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><?php  echo $u->assunto; ?></p>
                        </div>
                      </div>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Espaço:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><a class="link-off" <?php echo "href='./index.php?pag=16&tipo=2&id=$u->espaco'"; ?>><?php echo $espaco; ?></a></p>
                        </div>
                      </div>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Data:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><?php  echo $u->data; ?></p>
                        </div>
                      </div>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Hora inicial:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><?php  echo $u->h_inicial; ?></p>
                        </div>
                      </div>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Hora Final:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><?php  echo $u->h_final; ?></p>
                        </div>
                      </div>


                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                          <label>Recursos:</label>
                      </div>
                      <?php
                        $user=$b->get_rel_solicitacoes($id);
                        if (!empty($user)) {
                          foreach ($user as $o) {
                            echo '<div class="col-lg-12" style="margin-top:5px">
                                    <div class="col-lg-3 ">
                                      <label>Nome:</label>
                                    </div>
                                    <div class="col-lg-9 off-margin-left">
                                      <p><img src="./files/'.$o->icone.'"; ?><a href="./index.php?pag=16&tipo=4&id='.$o->id.'" class="link-off"> '.$o->nome.'</a></p>
                                    </div>
                                  </div>';
                          }
                        }else {
                          echo '<div class="col-lg-9 off-margin-left">
                                  <p>Não existe recursos relacionados com essa categoria</p>
                                </div>';
                        }
                      ?>

                      <div class="col-lg-12 off-margin-left" style="margin-top:5px">
                        <div class="col-lg-3 off-margin-left">
                          <label>Descricão:</label>
                        </div>
                        <div class="col-lg-9 off-margin-left">
                            <p><?php  echo $u->desc; ?></p>
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
