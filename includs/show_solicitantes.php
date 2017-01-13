<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cadastro de Solicitantes</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <a href="index.php?pag=10"><i class="fa fa-plus fa-fw"></i>Cadastrar Solicitantes</a>
          </div>
          <?php
          include_once './php/Solicitantes.php';
          include_once './php/Banco.php';
          $b=new Banco();
          $usuarios=$b->get_solicitantes();
          include_once './includs/solitantes_tab.php';
          show_table_sol($usuarios);
          ?>
    </div>
</div>
