?php
  if (isset($_POST['consulta'])) {
    include_once "./php/Recurso.php";
    include_once "./php/Espaco.php";
    include_once './php/Usuario.php';
    include_once "./php/Categoria.php";
    include_once './php/Solicitantes.php';
    include_once './php/Solicitacoes.php';
    include_once './php/Banco.php';
    $b=new Banco();
    $a=$b->buscar($_POST['consulta']);
  }
 ?>
 <div class="row">
     <div class="col-lg-12">
         <h1 class="page-header">CONSULTA GERAL</h1>
     </div>
     <!-- /.col-lg-12 -->
 </div>
 <!-- /.row -->
 <div class="row">
     <div class="col-lg-12">
         <div class="panel panel-default">
             <div class="panel-heading">
               Consulta
             </div>
             <div class="panel-body">
               <?php
                if (!empty($a)) {
                  foreach ($a as $k => $obj) {

                    if ($k=='categoria' and !empty($obj)) {
                      include_once './includs/categoria_tab.php';
                      echo '<div class="panel panel-primary">
                              <div class="panel-heading">
                                <span>Categoria - '.count($obj).' registros</span>
                              </div>
                              <div class="panel-body conteiner-pesquisa">';
                      show_table($obj, $b);
                      echo    '</div>
                              </div>';
                    }
                    elseif ($k=='usuario' and !empty($obj)) {
                      include_once './includs/user_table.php';
                      echo '<div class="panel panel-primary">
                              <div class="panel-heading">
                                <span>Usuário - '.count($obj).' registros</span>
                              </div>
                              <div class="panel-body conteiner conteiner-pesquisa">';
                      show_table_usu($obj);
                      echo    '</div>
                        </div>';
                    }

                    elseif ($k=='espaco' and !empty($obj)) {
                      include_once './includs/espaco_tab.php';
                      echo '<div class="panel panel-primary">
                              <div class="panel-heading">
                                <span>Espaço - '.count($obj).' registros</span>
                              </div>
                              <div class="panel-body conteiner conteiner-pesquisa">';
                      show_table_esp($obj);
                      echo    '</div>
                        </div>';
                    }

                    elseif ($k=='recurso' and !empty($obj)) {
                      include_once './includs/recurso_tab.php';
                      echo '<div class="panel panel-primary">
                              <div class="panel-heading">
                                <span>Recurso - '.count($obj).' registros</span>
                              </div>
                              <div class="panel-body conteiner conteiner-pesquisa">';
                      show_table_rec($obj);
                      echo    '</div>
                        </div>';
                    }

                    elseif ($k=='solicitante' and !empty($obj)) {
                      include_once './includs/solitantes_tab.php';
                      echo '<div class="panel panel-primary">
                              <div class="panel-heading">
                                <span>Solicitantes - '.count($obj).' registros</span>
                              </div>
                              <div class="panel-body conteiner conteiner-pesquisa">';
                      show_table_sol($obj);
                      echo    '</div>
                        </div>';
                    }

                    elseif ($k=='solicitacoes' and !empty($obj)) {
                      include_once './includs/table_soli.php';
                      echo '<div class="panel panel-primary">
                              <div class="panel-heading">
                                <span>Solicitantes - '.count($obj).' registros</span>
                              </div>
                              <div class="panel-body conteiner conteiner-pesquisa">';
                      show_table_soc($obj, $b);
                      echo    '</div>
                        </div>';
                    }

                  }
                }else {
                  echo "<div class=\"alert alert-danger\">
                          <strong>Atenção!</strong> Não foi encontrado nenhum resgistro.
                        </div>";
                }
               ?>
               </div>
             </div>
             <!-- /.panel-body -->
         </div>
         <!-- /.panel -->
     </div>
     <!-- /.col-lg-12 -->
 </div>
<?php /*if (get_class($obj)=="Usuario") {

}
elseif (get_class($obj)=="Solicitante") {

}
elseif (get_class($obj)=="Solicitacoes") {

}
elseif (get_class($obj)=="Recurso") {

}
elseif (get_class($obj)=="Categoria") {
  include_once './includs/categoria_tab.php';
  show_table($b->get_categoria(), $b);
}
elseif (get_class($obj)=="Espaco") {

}*/ ?>
