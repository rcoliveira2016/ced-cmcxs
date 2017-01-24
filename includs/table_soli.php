<?php function show_table_soc($a, $b){ ?>
    <div class="table-responsive" >
        <table class="table table-striped table-bordered table-hover" id="tabela">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Data</th>
                    <th>Hora Inicial</th>
                    <th>Hora Final</th>
                    <th>Espaço</th>
                    <th>Assunto</th>
                    <th>Solicitante</th>
                    <th>Telefone</th>
                    <th>Usuário</th>
                    <th>Editar</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
              <?php
                include_once './php/Solicitantes.php';
                include_once './php/Recurso.php';
                include_once './php/Espaco.php';
                include_once './php/Usuario.php';
                if (!empty($a)) {
                  foreach ($a as $user) {
                    $telefone=$b->getSolicitantesId($user->solicitante)->telefone;
                    $espaco=$b->getEspacoId($user->espaco)->nome;
                    $solicitantes=$b->getSolicitantesId($user->solicitante)->nome;
                    $s=$b->get_rel_solicitacoes($user->id);
                    $rec=$b->getUserId($user->user);
                    echo "<tr>
                            <td>$user->id</td>
                            <td>$user->data</td>
                            <td>$user->h_inicial</td>
                            <td>$user->h_final</td>
                            <td>$espaco</td>
                            <td>$user->assunto</td>
                            <td>$solicitantes</td>
                            <td>$telefone</td>
                            <td>$rec->nome</td>
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
