div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $titulo; ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a href="index.php?pag=11"><i class="fa fa-plus fa-fw"></i>Cadastrar Solicitação - </a><a class="btn btn-danger" href="./index.php?pag=12&all=true">Mostrar todos</a>
        </div>
        <?php
          $t=(isset($_GET['all']))? "true" : "";
          include_once './php/Solicitacoes.php';
          include_once './php/Banco.php';
          $b=new Banco();
          $usuarios=$b->get_solicitacoes($t);
          include_once "./includs/table_soli.php";
          show_table_soc($usuarios, $b);
        ?>
    </div>
  </div>
</div>
