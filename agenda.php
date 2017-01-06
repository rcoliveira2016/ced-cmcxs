
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
    <link href="./bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="./css/jquery-ui.css" rel="stylesheet">
    <title>Cedências</title>
    <link rel="stylesheet" href="./css/style.css" charset="utf-8">
    <script src="./js/jquery.min.js"></script>
    <style media="screen">
      #page-wrapper{
        margin: 0;
        padding-left: 40px!important;
        padding-right: 40px!important;
      }
    </style>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Cedências - Câmara Caxias</a>
            </div>

            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <?php
                /****************************************************************************************************************
                *************************************************  **************************************************************
                **********************************************         **********************************************************
                ******************************************    Conteudo    *******************************************************
                **********************************************         **********************************************************
                *************************************************  **************************************************************
                ****************************************************************************************************************/
                $titulo="Agenda";
                include_once "./includs/agenda.php";
             ?>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
