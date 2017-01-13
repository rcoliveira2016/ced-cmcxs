<?php function show_table_rec($a){ ?>
  <div class="table-responsive" >
      <table class="table table-striped table-bordered table-hover" id="tabela">
          <thead>
              <tr>
                  <th>Nome</th>
                  <th>Situação</th>
                  <th id="icone">Icone</th>
                  <th>Editar</th>
                  <th>Ver</th>
              </tr>
          </thead>
          <tbody>
            <?php

              if (!empty($a)) {
                foreach ($a as $user) {
                  echo $user;
                }
              }
            ?>
          </tbody>
      </table>
  </div>
  <?php } ?>
