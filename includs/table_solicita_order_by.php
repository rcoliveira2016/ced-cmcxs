?php function show_table_soc($a, $b){ ?>
    <div class="table-responsive col-lg-12 off_margin" >
        <table class="table table-striped table-bordered table-hover" id="tabela">
            <thead>
                <tr>
                    <th><a href="?pag=17&tipo=geral&col=n" class="link-off">Nº</a></th>
                    <th><a href="?pag=17&tipo=geral&col=data" class="link-off">Data</a></th>
                    <th><a href="?pag=17&tipo=geral&col=i_hora" class="link-off">Hora Inicial</a></th>
                    <th><a href="?pag=17&tipo=geral&col=f_hora" class="link-off">Hora Final</a></th>
                    <th><a href="?pag=17&tipo=geral&col=esp" class="link-off">Espaço</a></th>
                    <th><a href="?pag=17&tipo=geral&col=asun" class="link-off">Assunto</a></th>
                    <th><a href="?pag=17&tipo=geral&col=soli" class="link-off">Solicitante</a></th>
                    <th><a href="?pag=17&tipo=geral&col=tele" class="link-off">Telefone</a></th>
                    <th>Recurso</th>
                    <th>Editar</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
              <?php
                include_once './php/Solicitantes.php';
                include_once './php/Recurso.php';
                include_once './php/Espaco.php';
                if (!empty($a)) {
                  foreach ($a as $user) {
                    $telefone=$b->getSolicitantesId($user->solicitante)->telefone;
                    $espaco=$b->getEspacoId($user->espaco)->nome;
                    $solicitantes=$b->getSolicitantesId($user->solicitante)->nome;
                    $s=$b->get_rel_solicitacoes($user->id);
                    $rec="";
                    if (!empty($s)) {
                      foreach ($s as $recurso) {
                        $rec.="<a class='link-off' href='./index.php?pag=16&tipo=4&id=$recurso->id'>$recurso->nome;</a>";
                      }
                    }
                    echo "<tr>
                            <td>$user->id</td>
                            <td>$user->data</td>
                            <td>$user->h_inicial</td>
                            <td>$user->h_final</td>
                            <td>$espaco</td>
                            <td>$user->assunto</td>
                            <td>$solicitantes</td>
                            <td>$telefone</td>
                            <td>$rec</td>
                            <td class='editar_table'><a href=\"index.php?pag=11&id=$user->id\"><i class=\"fa fa-edit fa-fw\"></i></a></td>
                            <td class='editar_table'><a href=\"index.php?pag=16&tipo=6&id=$user->id\"><i class=\"fa fa-eye fa-fw\"></i></a></td>
                          </tr>\n";

                  }
                }
              ?>
            </tbody>
        </table>
    </div>
<?php } ?>
