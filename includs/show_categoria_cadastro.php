div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cadastro de Categoria</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <a href="index.php?pag=6"><i class="fa fa-plus fa-fw"></i>Cadastrar Categoria</a>
          </div>
          <?php
            include_once './includs/categoria_tab.php';
            include_once './php/Categoria.php';
            include_once './php/Banco.php';
            $b=new Banco();
            show_table($b->get_categoria(), $b);
          ?>
    </div>
</div>
