<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cadastro de Usuário</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <a href="index.php?pag=2"><i class="fa fa-plus fa-fw"></i>Cadastrar usuário</a>
          </div>
          <?php
            include_once './php/Usuario.php';
            include_once './php/Banco.php';
            $b=new Banco();
            include_once './includs/user_table.php';
            show_table_usu($b->get_users());
          ?>
    </div>
</div>
