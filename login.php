<?php
session_start();
if (!empty($_SESSION)) {
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Cêdencias</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/metisMenu.min.css" rel="stylesheet">
    <link href="./css/sb-admin-2.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Entar</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="php/login_user.php">
                            <?php
                              if (!empty($_GET) and isset($_GET['erro'])) {
                                if ($_GET['erro']=="op") {
                                  echo "<div class=\"alert alert-danger\">
                                          Falha na validação do usuário
                                        </div>";
                                }
                                if ($_GET['erro']=="de") {
                                  echo "<div class=\"alert alert-warning\">
                                          Seu usuário foi desativado
                                        </div>";
                                }
                              }
                            ?>
                            <fieldset>
                                <div class="form-group">
                                    <label class="panel-title">Usuário</label>
                                    <input class="form-control" placeholder="usuário" name="user" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                   <label class="panel-title">Senha</label>
                                   <input class="form-control" placeholder="Senha" name="senha" type="password" >
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block" name="submit">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/validar.js"></script>
</body>

</html>
