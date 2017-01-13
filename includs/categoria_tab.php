<?php function show_table($a, $b){?>
  <div class="table-responsive" >
      <table class="table table-striped table-bordered table-hover" id="tabela">
          <thead>
              <tr>
                  <th>Nome</th>
                  <th>Espaço Padrão</th>
                  <th>Situação</th>
                  <th>Valido para Ano Letivo</th>
                  <th>Editar</th>
                  <th>Ver</th>
              </tr>
          </thead>
          <tbody>
            <?php
              include_once './php/Espaco.php';
              $usuarios=$a;
              if (!empty($usuarios)) {
                foreach ($usuarios as $user) {
                  $esp=$b->getEspacoId($user->espaco);
                  echo "<tr>
                            <td>$user->nome</td>
                            <td>$esp->nome</td>
                            <td>".(($user->situacao==1) ? "Ativo" : "Inativo")."</td>
                            <td>".(($user->validar==1) ? "Sim" : "Não")."</td>
                            <td class='editar_table'><a href=\"index.php?pag=6&id=$user->id\"><i class=\"fa fa-edit fa-fw\"></i></a></td>
                            <td class='editar_table'><a href=\"index.php?pag=16&tipo=3&id=$user->id\"><i class=\"fa fa-eye fa-fw\"></i></a></td>
                          </tr>";
                }
              }
            ?>
          </tbody>
      </table>
  </div>
<?php } ?>
