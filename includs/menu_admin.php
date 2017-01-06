<div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">
      <li class="sidebar-search">
        <form action="./index.php?pag=14" method="post">
          <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="consulta" <?php echo ((isset($_POST['consulta']) and $id_pagina==14)? "value='{$_POST['consulta']}'": "");?> placeholder="Procurar.." title="Você pode pesquisar: nomes, datas, locais, etc">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="submit">
                      <i class="fa fa-search"></i>
                  </button>
                </span>
          </div>
        </form>
      </li>
        <?php if($nivel==1){ ?>
          <li>
              <a href="#"><i class="fa fa-wrench fa-fw"></i> Administração<span class="fa arrow"></span></a>
              <ul class="nav nav-second-level">
                  <li>
                      <a href="index.php?pag=1">Cadastro de Usuários</a>
                  </li>
                  <li>
                      <a href="index.php?pag=3">Cadastro de Espaço</a>
                  </li>
                  <li>
                      <a href="index.php?pag=5">Cadastro de Categoria</a>
                  </li>
                  <li>
                      <a href="index.php?pag=7">Cadastro de Recursos</a>
                  </li>
                  <li>
                      <a href="index.php?pag=9">Cadastro de Solicitantes</a>
                  </li>
              </ul>
          </li>
        <?php } ?>
        <li>
          <a href="#"><i class="fa fa-calendar fa-fw"></i> Solicitações<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
              <li>
                  <a href="index.php?pag=11">Nova Solicitação</a>
              </li>
              <li>
                  <a href="index.php?pag=12">Solicitações</a>
              </li>
              <li>
                  <a href="index.php?pag=15">Calendário</a>
              </li>
              <li>
                  <a href="index.php?pag=17">Relatórios</a>
              </li>
              <li>
                  <a href="index.php?pag=18">Agenda</a>
              </li>
          </ul>
        </li>
    </ul>
</div>
