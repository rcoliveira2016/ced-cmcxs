
<?php
  include_once './php/Solicitacoes.php';
  include_once './php/functions.php';
  include_once './php/Banco.php';
  $b=new Banco();
  if(isset($_GET['tipo']) and !empty($_GET['tipo'])){
    $t=$_GET['tipo'];
    if ($t=="geral") {
      include_once './includs/filtro_soli.php';
    }
    elseif ($t=="datas") {
      include_once './includs/filtro_data.php';
    }
  }else {
    $t=count($b->get_soli_all(date("Y-m")));
    $a=count($b->get_soli_ano(date("Y-m")));
    $m=count($b->get_soli_mes(date("Y-m")));
    $s=semana($b);
    relatorio($t,$a,$m,$s,$b);
  }
?>
<?php function relatorio($t,$a,$m,$s,$b){ ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Relatórios</h1>
    </div>
</div>
<div class="col-lg-4">
  <div class="panel panel-green">
      <div class="panel-heading">
          <div class="row">
              <div class="col-xs-3">
                  <i class="fa fa-sitemap fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo "$a"; ?></div>
                  <div>Solicitações no sistema</div>
              </div>
          </div>
      </div>
      <a href="./index.php?pag=17&tipo=geral">
          <div class="panel-footer">
              <span class="pull-left">Mais detalhes</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
          </div>
      </a>
  </div>

  <div class="panel panel-red">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-support fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo "$a"; ?></div>
                    <div>Solicitações no Ano</div>
                </div>
            </div>
        </div>
        <a href="./index.php?pag=17&tipo=geral">
            <div class="panel-footer">
                <span class="pull-left">Mais detalhes</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-calendar-o fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo "$m"; ?></div>
                    <div>Solicitações no mês</div>
                </div>
            </div>
        </div>
        <a href="./index.php?pag=17&tipo=geral">
            <div class="panel-footer">
                <span class="pull-left">Mais detalhes</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    <div class="panel panel-yellow">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-calendar fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo "$s"; ?></div>
                    <div>Solicitações na semana</div>
                </div>
            </div>
        </div>
        <a href="./index.php?pag=17&tipo=geral">
            <div class="panel-footer">
                <span class="pull-left">Mais detalhes</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>
<div class="col-lg-4 ">
  <div class="panel panel-default">
      <div class="panel-heading">
          <i class="fa fa-signal fa-fw"></i> Ranking de Espaços - <a href="./index.php?pag=17&tipo=geral">Filtro</a>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
          <div class="list-group">
            <?php
              include_once './php/Espaco.php';
              $sol=$b->get_ranking_esp();
              $c=1;
              if (!empty($sol)) {
                foreach ($sol as $u) {
                  $obj=$u["esp"][0];
                  $count=$u["esp"][1];
                  echo "<a href=\"./index.php?pag=16&tipo=2&id=$obj->id\" class=\"list-group-item\">
                      <strong class=\"fa-fw\">{$c}º - $obj->nome</strong>
                      <span class=\"pull-right text-muted small\"><em> $count Solicitaçãoes</em></span>
                  </a>";
                  $c++;
                }
              }
             ?>
          </div>
      </div>
      <!-- /.panel-body -->
  </div>
</div>
<div class="col-lg-4 off-margin-left">
  <div class="panel panel-default">
      <div class="panel-heading">
          <i class="fa fa-signal fa-fw"></i> Ranking de Solicitantes - <a href="./index.php?pag=17&tipo=geral">Filtro</a>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
          <div class="list-group">
            <?php
              include_once './php/Solicitantes.php';
              $sol=$b->get_ranking();
              $c=1;
              if (!empty($sol)) {
                foreach ($sol as $u) {
                  $obj=$u["esp"][0];
                  $count=$u["esp"][1];
                  echo "<a href=\"./index.php?pag=16&tipo=5&id=$obj->id\" class=\"list-group-item\">
                      <strong class=\"fa-fw\">{$c}º - $obj->nome</strong>
                      <span class=\"pull-right text-muted small\"><em> $count Solicitaçãoes</em></span>
                  </a>";
                  $c++;
                }
              }
             ?>
          </div>
      </div>
      <!-- /.panel-body -->
  </div>
</div>
<?php } ?>

<?php
function semana($b){
  $data=getData(date("d/m/Y"));$arr=povoarSemana($data);
  $semana=$arr[0];
  $s=$b->get_solicitacoes_data($semana[0],$semana[6], $data[1],$data[2],$data[0]);
  return count($s);
}


 ?>
