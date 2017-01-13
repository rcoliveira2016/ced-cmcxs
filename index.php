
<?php
session_start();
$id_pagina;
date_default_timezone_set('America/Sao_Paulo');
//validar usuario{
if(!empty($_SESSION) and isset($_SESSION['nivel'])){
    if ($_SESSION['nivel']==1) {
        $nivel=1;
    }else{
        $nivel=2;
    }
}else {
    $nivel=0;
    $id_pagina=0;
}
//}final validar

if (!empty($_GET) ) {
  if (isset($_GET['pag'])) {
    $id_pagina=$_GET['pag'];
  }
}else {
  $id_pagina=0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/sb-admin-2.css" rel="stylesheet">
    <link href="./css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <title>Cedências</title>
    <?php
        if ($id_pagina==4) {
            echo '    <link rel="stylesheet" href="./css/palette-color-picker.css">';
        }
        elseif ($id_pagina==11 or $id_pagina==15 or $id_pagina==17 or $id_pagina==18 or $id_pagina==0) {
          echo '<link href="./css/jquery-ui.css" rel="stylesheet">';
        }
    ?>
    <link rel="stylesheet" href="./css/style.css" charset="utf-8">
    <script src="./js/jquery.min.js"></script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Cedências - Câmara Caxias</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">

              <?php if ($nivel!=0) { ?>
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['nome'];?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="index.php?pag=11"><i class="fa fa-plus"></i> Nova solicitação</a>
                        <li><a href="login.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                        </li>

              <?php
                    }else{
                      echo '<li><a href="login.php"><i class="fa fa-gear fa-fw"></i> Fazer Login</a>';
                    }
               ?>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <?php

                  /****************************************************************************************************************
                  ********************************************     ****************************************************************
                  **************************************  MENU USUARIO  ***********************************************************
                  ********************************************     ****************************************************************
                  ****************************************************************************************************************/
                  if($nivel==1 or $nivel==2){
                    include_once("./includs/menu_admin.php");
                  }
                  else{?>
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                              <a href="./index.php?pag=12"><i class="fa fa-list fa-fw"></i> Solicitações</a>
                            </li>
                            <li>
                              <a href="./index.php?pag=15"><i class="fa fa-calendar fa-fw"></i> Calendário</a>
                            </li>
                            <li>
                                <a href="index.php?pag=18"><i class="fa fa-book fa-fw"></i>Agenda</a>
                            </li>
                        </ul>
                    </div>
                  <?php }


                ?>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <?php
                /****************************************************************************************************************
                ********************************************     ****************************************************************
                **************************************    Conteudo    ***********************************************************
                ********************************************     ****************************************************************
                ****************************************************************************************************************/

                include_once "./includs/conteudo.php";

                getConteudo($id_pagina, $nivel);

             ?>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/metisMenu.min.js"></script>
    <script src="./js/sb-admin-2.js"></script>
    <script src="./js/show_img.js"></script>
    <?php if($id_pagina==11 or $id_pagina==10){ ?>
    <script src="./js/mask.js"></script>
    <?php } ?>
</body>

</html>
