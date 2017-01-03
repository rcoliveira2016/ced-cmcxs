div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cadastro de Recursos</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <a href="index.php?pag=8"><i class="fa fa-plus fa-fw"></i> Recurso</a>
          </div>
          <?php
          include_once './php/Recurso.php';
          include_once './php/Banco.php';
          $b=new Banco();
          $usuarios=$b->get_recurso();
          include_once './includs/recurso_tab.php';
          show_table_rec($usuarios);
          ?>
    </div>
</div>
