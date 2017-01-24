<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cadastro de Espaço</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <a href="index.php?pag=4"><i class="fa fa-plus fa-fw"></i>Cadastrar Espaço</a>
          </div>
          <?php
            include_once './php/Espaco.php';
            include_once './php/Banco.php';
            $b=new Banco();
            $usuarios=$b->get_espaco();
            include_once './includs/espaco_tab.php';
            show_table_esp($usuarios);
          ?>
    </div>
</div>
