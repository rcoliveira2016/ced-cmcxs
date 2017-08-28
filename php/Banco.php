<?php
class Banco {
    function __construct() {
        @mysql_connect('localhost', '###','###') or die(mysql_error());
        mysql_select_db('calendario') or die(mysql_error());
    }

    private function sql($sql) {
        mysql_query($sql) or die(mysql_error());
    }
    public function get_users(){
        $sql = "select * from cadas_usu";
        $a=null;
        if($rs = mysql_query($sql)){
          while ($registro = mysql_fetch_array($rs)) {
              $id = $registro[0];
              $nome = $registro[1];
              $senha = $registro[2];
              $n_cartao = $registro[3];
              $mail = $registro[4];
              $perfil = $registro[5];
              $c= new Usuario($id, $nome, $senha, $n_cartao, $mail, $perfil);
              $a[]=$c;
          }
        }
        return $a;
    }
    public function logar($user) {
        $sql="select * from cadas_usu where login='".$user."'";
        $rs = mysql_query($sql) or die();
        $registro = mysql_fetch_array($rs);
        if (mysql_num_rows($rs)==1) {
          return new Usuario($registro[0],$registro[1], $registro[2], $registro[3], $registro[4], $registro[5]);
        }
        return null;
    }

    public function getUserId($id) {
        $sql="select * from cadas_usu where id_usuario='$id'";
        $rs = mysql_query($sql) or die();
        $registro = mysql_fetch_array($rs);
        if (mysql_num_rows($rs)==1) {
          return new Usuario($registro[0],$registro[2], $registro[1], $registro[3], $registro[4], $registro[5]);
        }
        return null;
    }

    public function alterarUsuario($id, $perfil, $situacao){
      $sql="UPDATE `cadas_usu` SET perfil='$perfil', situacao=$situacao where id_usuario=$id";
      $rs = mysql_query($sql);
      return $rs;
    }

    public function validarUser($user){
      $sql="select * from cadas_usu where login='".$user."'";
      $rs = mysql_query($sql) or die();
      if (mysql_num_rows($rs)!=0) {
        return true;
      }
      else {
        return false;
      }

    }
    public function cadastraUsuario($nome, $perfil, $user, $situacao){
      $sql="INSERT INTO `cadas_usu`( `login`, `Nome`, `email`, `perfil`, `situacao`) VALUES ('$user', '$nome', '$user@camaracaxias.rs.gov.br', $perfil, $situacao)";
      $rs = mysql_query($sql);
      return $rs;
    }

    //*************************** ESPACO *****************************************
    //****************************************************************************
    public function validarEspaco($user){
      $sql="select nome from cadas_espaco where Cor='".$user."'";
      $rs = mysql_query($sql) or die();
      $registro = mysql_num_rows($rs);
      if (mysql_num_rows($rs)==0) {
        return true;
      }
      else {
        return false;
      }

    }

    public function get_espaco(){
        $sql = "select * from cadas_espaco ORDER BY nome ASC";
        return $this->getArrayEsp($sql);
    }

    public function cadastraEspaco($nome, $desc, $cor, $situacao, $u){
      $sql="INSERT INTO `cadas_espaco`( `Nome`, `Situacao`, `Cor`, `descricao`) VALUES ('$nome', '$situacao', '$cor', '$desc')";
      $rs = mysql_query($sql);
      $sql="SELECT id_espaco FROM `cadas_espaco` WHERE  Nome='$nome' and Cor='$cor'";
      $result = mysql_query($sql) or die();
      $id=mysql_fetch_array($result);
      $id=$id[0];
      foreach ($u as $user) {
        $sql="INSERT INTO `rel_esp_user` (`id_espaco`, `id_user`) VALUES ($id, $user)";
        $rs = mysql_query($sql);
      }
      return $rs;
    }
    public function getEspacoId($id) {
        $sql="select * from cadas_espaco where id_espaco='$id'";
        $rs = mysql_query($sql);
        $registro = mysql_fetch_array($rs);
        if (mysql_num_rows($rs)==1) {
          $id = $registro[0];
          $nome = $registro[1];
          $senha = $registro[2];
          $n_cartao = $registro[3];
          $mail = $registro[4];
          $perfil = $registro[4];
          return  new Espaco($id, $nome, $senha, $n_cartao, $mail);
        }
        return null;
    }
    public function getArrayEsp($sql){
      $rs = mysql_query($sql);
      $a=null;
      while ($registro = mysql_fetch_array($rs)) {
        $id = $registro[0];
        $nome = $registro[1];
        $senha = $registro[2];
        $n_cartao = $registro[3];
        $mail = $registro[4];
        $c= new Espaco($id, $nome, $senha, $n_cartao, $mail);
        $a[]=$c;
      }
      return $a;
    }
    public function get_rel_espaco($id){
        $sql = "SELECT cadas_usu.* FROM `cadas_espaco`, cadas_usu, rel_esp_user WHERE cadas_usu.id_usuario=rel_esp_user.id_user and rel_esp_user.id_espaco=$id GROUP BY cadas_usu.Nome";
        $a=null;
        if($rs = mysql_query($sql)){
          while ($registro = mysql_fetch_array($rs)) {
              $id = $registro[0];
              $nome = $registro[1];
              $senha = $registro[2];
              $n_cartao = $registro[3];
              $mail = $registro[4];
              $perfil = $registro[5];
              $c= new Usuario($id, $nome, $senha, $n_cartao, $mail, $perfil);
              $a[]=$c;
          }
        }
        return $a;
    }

    public function alteraEspaco($nome, $desc, $cor, $situacao, $u, $id){
      $sql="UPDATE `cadas_espaco` SET  `Nome`='$nome', `Situacao`='$situacao', `Cor`='$cor', `descricao`='$desc' WHERE id_espaco=$id ";
      $rs = mysql_query($sql);
      $sql="DELETE FROM `rel_esp_user` WHERE id_espaco=$id";
      $rs = mysql_query($sql);
      foreach ($u as $user) {
        $sql="INSERT INTO `rel_esp_user` (`id_espaco`, `id_user`) VALUES ($id, $user)";
        $rs = mysql_query($sql);
      }
      return $rs;

    }
    //*************************** categoria *****************************************
    //*******************************************************************************

    public function getArrayCat($sql){
      $rs = mysql_query($sql) or die();
      $a=null;
      while ($registro = mysql_fetch_array($rs)) {
          $id = $registro[0];
          $nome = $registro[1];
          $espaco = $registro[3];
          $situacao = $registro[2];
          $validar = $registro[4];
          $c= new Categoria($id, $nome, $espaco, $situacao, $validar);
          $a[]=$c;
      }
      return $a;
    }

    public function get_categoria(){
        $sql = "select * from cadas_categoria ORDER BY nome ASC";
        return $this->getArrayCat($sql);
    }

    public function get_categoria_select(){
        return $this->getArrayCat("select * from cadas_categoria WHERE Situacao=1 ORDER BY nome ASC");
    }

    public function validarCategoria($nome){
        $sql = "select * from cadas_categoria where nome='$nome'";
        $rs = mysql_query($sql) or die();
        return ((mysql_num_rows($rs)==0) ? true : false);

    }

    public function cadastraCategoria($nome, $espaco, $situacao, $validar, $u){
      $sql="INSERT INTO `cadas_categoria`(`Nome`, `Situacao`, `Espaco`, `Validar`) VALUES ('$nome', '$situacao', '$espaco', $validar)";
      $rs = mysql_query($sql);
      $sql="SELECT id_categoria FROM `cadas_categoria` WHERE Nome = '$nome' and Espaco = '$espaco'";
      $result = mysql_query($sql) or die();
      $id=mysql_fetch_array($result);
      $id=$id[0];
      foreach ($u as $user) {
        $sql="INSERT INTO `rel_cat_esp` (`id_categoria`, `id_user`) VALUES ($id, $user)";
        $rs = mysql_query($sql);
      }
      return $rs;
    }



    public function getCategoriaId($id) {
        $sql="select * from cadas_categoria where id_categoria='$id'";
        $rs = mysql_query($sql);
        $registro = mysql_fetch_array($rs);
        if (mysql_num_rows($rs)==1) {
          $id = $registro[0];
          $nome = $registro[1];
          $espaco = $registro[3];
          $situacao = $registro[2];
          $validar = $registro[4];
          return new Categoria($id, $nome, $espaco, $situacao, $validar);
        }
        return null;
    }

    public function alteraCategoria($nome, $espaco, $situacao, $validar, $u, $id){
      $sql="UPDATE `cadas_categoria` SET  `Nome`='$nome', `Situacao`='$situacao', `Espaco`='$espaco', `Validar`='$validar' WHERE id_Categoria=$id ";
      $rs = mysql_query($sql);
      $sql="DELETE FROM `rel_cat_esp` WHERE id_categoria=$id";
      $rs = mysql_query($sql);
      foreach ($u as $user) {
        $sql="INSERT INTO `rel_cat_esp` (`id_categoria`, `id_user`) VALUES ($id, $user)";
        $rs = mysql_query($sql);
      }
      return $rs;
    }

    public function get_rel_cat($id){
      $sql = "SELECT cadas_usu.* FROM `cadas_categoria`, cadas_usu, rel_cat_esp WHERE cadas_usu.id_usuario=rel_cat_esp.id_user and rel_cat_esp.id_categoria=$id GROUP BY cadas_usu.Nome";
      $rs = mysql_query($sql) or die();
      $a=null;
      while ($registro = mysql_fetch_array($rs)) {
        $id = $registro[0];
        $nome = $registro[1];
        $senha = $registro[2];
        $n_cartao = $registro[3];
        $mail = $registro[4];
        $perfil = $registro[5];
        $c= new Usuario($id, $nome, $senha, $n_cartao, $mail, $perfil);
        $a[]=$c;
      }
      return $a;
    }

//
// RECURSOS
//
  public function getArrayRecurso($sql){
    $a=null;
    if($rs = mysql_query($sql)){
      while ($registro = mysql_fetch_array($rs)) {
        $id = $registro[0];
        $nome = $registro[1];
        $desc = $registro[2];
        $icone = $registro[4];
        $situacao = $registro[3];
        $c= new Recurso($id, $nome, $desc, $icone, $situacao);
        $a[]=$c;
      }
    }
    return $a;
  }
  public function get_recurso(){
    $sql = "SELECT * FROM cadas_recurso";
    return $this->getArrayRecurso($sql);
  }

  public function validaRecurso($nome){
    $sql = "SELECT id_recurso FROM `cadas_recurso` WHERE Nome='$nome'";
    $rs = mysql_query($sql) or die();
    return ((mysql_num_rows($rs)==0) ? true : false);
  }

  public function cadastraRecurso($nome, $desc, $situacao, $u, $e, $icone){
    $sql="INSERT INTO `cadas_recurso`(`Nome`, `Situacao`, `Descricao`, `icone`) VALUES ('$nome', '$situacao', '$desc', '$icone')";
    $rs = mysql_query($sql);
    $sql="SELECT id_recurso FROM `cadas_recurso` WHERE Nome = '$nome' and Descricao = '$desc'";
    $result = mysql_query($sql) or die();
    $id=mysql_fetch_array($result);
    $id=$id[0];
    foreach ($e as $user) {
      $sql="INSERT INTO `rel_rec_esp` (`id_recurso`, `id_espaco`) VALUES ($id, $user)";
      $rs = mysql_query($sql);
    }
    foreach ($u as $user) {
      $sql="INSERT INTO `rel_rec_usu` (`id_recurso`, `id_usuario`) VALUES ($id, $user)";
      $rs = mysql_query($sql);
    }
    return $rs;
  }

  public function getRecursoId($id){
    $sql = "SELECT * FROM cadas_recurso where id_recurso=$id";
    $a=null;
    if($rs = mysql_query($sql)){
      while ($registro = mysql_fetch_array($rs)) {
        $id = $registro[0];
        $nome = $registro[1];
        $desc = $registro[2];
        $icone = $registro[4];
        $situacao = $registro[3];
        return new Recurso($id, $nome, $desc, $icone, $situacao);
      }
    }
  }

  public function get_rel_rec_user($id){
    $sql="SELECT cadas_usu.* FROM `cadas_recurso`, cadas_usu, rel_rec_usu WHERE cadas_usu.id_usuario=rel_rec_usu.id_usuario and rel_rec_usu.id_recurso=$id GROUP BY cadas_usu.Nome ";
    return $this->getArrayRecurso($sql);
  }
  public function get_rel_rec_esp($id){
    $sql="SELECT cadas_espaco.* FROM `cadas_recurso`, cadas_espaco, rel_rec_esp WHERE cadas_espaco.id_espaco=rel_rec_esp.id_espaco and rel_rec_esp.id_recurso=$id GROUP BY cadas_espaco.Nome";
    return $this->getArrayEsp($sql);
  }

  public function alterarRecurso($id, $nome, $desc, $situacao, $u, $e, $file){
    if ($file=="") {
      $sql="UPDATE `cadas_recurso` SET `Nome`='$nome' ,`Descricao`='$desc',`Situacao`='$situacao' WHERE id_recurso=$id";
    }
    else {
      $sql="UPDATE `cadas_recurso` SET `Nome`='$nome' ,`Descricao`='$desc',`Situacao`='$situacao',icone='$file' WHERE id_recurso=$id";
    }
    $rs=mysql_query($sql);
    $rs=mysql_query("DELETE from rel_rec_esp where id_recurso=$id");
    foreach ($e as $user) {
      $sql="INSERT INTO `rel_rec_esp` (`id_recurso`, `id_espaco`) VALUES ($id, $user)";
      echo "$sql";
      $rs = mysql_query($sql);
    }
    $rs=mysql_query("DELETE from rel_rec_usu where id_recurso=$id");
    foreach ($u as $user) {
      $sql="INSERT INTO `rel_rec_usu` (`id_recurso`, `id_usuario`) VALUES ($id, $user)";
      $rs = mysql_query($sql);
    }
    return $rs;
  }
  //
  //                        SOLICITANTES
  //

  public function get_solicitantes(){
    $sql="SELECT * FROM cadas_solicitante ORDER BY nome ASC";
    return $this->getArraySoli($sql);
  }

  public function getArraySoli($sql){
    $a=null;
    if($rs= mysql_query($sql)){
      while ($registro = mysql_fetch_array($rs)) {
          $id = $registro[0];
          $nome = $registro[1];
          $mail = $registro[2];
          $cpf = $registro[3];
          $cnpj = $registro[4];
          $situacao = $registro[5];
          $telefone = $registro[6];
          $contato = $registro[7];
          $descricao = $registro[8];
          $endereco = $registro[9];
          $c= new Solicitantes($id, $nome, $mail, $cpf, $cnpj, $situacao, $telefone, $contato, $descricao, $endereco);
          $a[]=$c;
      }
    }
    return $a;
  }

  public function validarSolicitantes($nome){
    $sql="SELECT * FROM cadas_solicitante WHERE Nome='$nome'";
    $rs= mysql_query($sql);
    return ((mysql_num_rows($rs)==0) ? true : false);
  }

  public function cadastrarSolicitantes($nome, $mail, $desc, $cnpj, $cpf, $telefone, $situacao, $contato, $endereco){
    if ($cnpj==null) {
      $cpf=(empty($cpf))? "null" : $cpf;
      $sql="INSERT INTO `cadas_solicitante`(`Nome`, `Email`, `CPF`,  `Situacao`, `Telefone`, `Nome_Contato`, `Descricao`, `Endereco`) VALUES ('$nome', '$mail', $cpf, '$situacao', '$telefone', '$contato', '$desc','$endereco')";
    } else {
      $sql="INSERT INTO `cadas_solicitante`(`Nome`, `Email`, `CNPJ`, `Situacao`, `Telefone`, `Nome_Contato`, `Descricao`, `Endereco`) VALUES ('$nome', '$mail', '$cnpj', '$situacao', '$telefone', '$contato','$desc' ,'$endereco')";
    }
    echo "$sql";
    return mysql_query($sql) or mysql_error();
  }

  public function getSolicitantesId($id){
    $sql="SELECT * FROM cadas_solicitante WHERE id_solicitante=$id";
    if($rs= mysql_query($sql)){
      while ($registro = mysql_fetch_array($rs)) {
          $id = $registro[0];
          $nome = $registro[1];
          $mail = $registro[2];
          $cpf = $registro[3];
          $cnpj = $registro[4];
          $situacao = $registro[5];
          $telefone = $registro[6];
          $contato = $registro[7];
          $descricao = $registro[8];
          $endereco = $registro[9];
          return new Solicitantes($id, $nome, $mail, $cpf, $cnpj, $situacao, $telefone, $contato, $descricao, $endereco);
      }
    }
    return null;
  }

  public function alterarSolicitantes($nome, $mail, $desc, $cnpj, $cpf, $telefone, $situacao, $contato, $endereco, $id){
    $sql="UPDATE `cadas_solicitante` SET `Nome`='$nome',`Email`='$mail',`CPF`='$cpf',`CNPJ`='$cnpj',`Situacao`='$situacao',`Telefone`='$telefone',`Nome_Contato`='$contato',`Descricao`='$desc',`Endereco`='$endereco' WHERE id_solicitante=$id";
    $rs = mysql_query($sql);
    return $rs;
  }
  //
  //                          SOLIITACAOES
  //

  public function ocultar_solicitacao($id){
    $sql="UPDATE `solicitacoes` SET `mostrar`=1 WHERE id=$id";
    $rs = mysql_query($sql);
    return $rs;
  }

  public function validarHoraBanco($f, $i, $e, $d){
    $data=explode("/", $d);
    $data=$data[2]."-".$data[1]."-".$data[0];
    $sql='SELECT *
        FROM `solicitacoes`
        WHERE ((TIME_TO_SEC(i_hora) <= TIME_TO_SEC("'.$i.'") and TIME_TO_SEC(f_hora) >= TIME_TO_SEC("'.$i.'")) OR
        (TIME_TO_SEC(f_hora) >= TIME_TO_SEC("'.$f.'") and TIME_TO_SEC(i_hora) <= TIME_TO_SEC("'.$f.'"))) and id_espaco="'.$e.'" and data="'.$data.'" and mostrar=0';
    if (mysql_num_rows(mysql_query($sql))==0) {
      return true;
    }
    return false;
  }

  public function validarHoraBancoAlterar($f, $i, $e, $d, $id){
    $data=explode("/", $d);
    $data=$data[2]."-".$data[1]."-".$data[0];
    $sql='SELECT *
        FROM `solicitacoes`
        WHERE ((TIME_TO_SEC(i_hora) <= TIME_TO_SEC("'.$i.'") and TIME_TO_SEC(f_hora) >= TIME_TO_SEC("'.$i.'")) OR
        (TIME_TO_SEC(f_hora) >= TIME_TO_SEC("'.$f.'") and TIME_TO_SEC(i_hora) <= TIME_TO_SEC("'.$f.'"))) and id_espaco="'.$e.'" and data="'.$data.'" and mostrar=0 and id!='.$id.'';
    if (mysql_num_rows(mysql_query($sql))==0) {
      return true;
    }
    return false;
  }

  public function addSolicitantes($arr){
    $d=(isset($arr['desc']) and !empty($arr['desc']))? $arr['desc'] : " ";
    $data=explode("/", $arr['data']);
    $data=$data[2]."-".$data[1]."-".$data[0];
    $interno=(isset($arr['interno']))? 1 : 0;
    $sql="INSERT INTO `solicitacoes`(`id_espaco`, `id_solicitante`, `assunto`, `id_categoria`, `data`, `i_hora`, `f_hora`, `desc`, `id_user`, site_camara, mostrar) VALUES
     ({$arr['espaco']}, {$arr['solicitantes']}, '{$arr['assunto']}', {$arr['categoria']}, '$data', '{$arr['h_inicial']}', '{$arr['h_final']}', '$d', {$arr['id']}, $interno, 0)";
    $rs = mysql_query($sql) or die(mysql_error());
    if(isset($arr['rec']) and !empty($arr['rec'])){
      $sql="SELECT id FROM `solicitacoes` WHERE i_hora = '{$arr['h_inicial']}' and f_hora = '{$arr['h_final']}' and data='$data' and mostrar=0";
      $result = mysql_query($sql) or die(mysql_error());
      $id=mysql_fetch_array($result);
      $id=$id[0];
      foreach ($arr['rec'] as $user) {
        $sql="INSERT INTO `rel_rec_soli` (`id_recurso`, `id_solicitacao`) VALUES ($user, $id)";
        $rs = mysql_query($sql) or die(mysql_error());
      }
    }
    return $rs;
  }

  public function get_solicitacoes($true){
    $data=($true=="true")? "" : "'".date("y-m-d")."'<=data and";
    $sql="SELECT *, DATE_FORMAT(data, '%d/%m/%Y')  from solicitacoes WHERE $data mostrar=0 ORDER BY  data, i_hora ASC";
    return $this->getArraySoc($sql);
  }

  public function getSolicitacoesId($id){
    $sql="SELECT *, DATE_FORMAT(data,'%d/%m/%Y')  from solicitacoes where id=$id and mostrar=0";
    if($rs=mysql_query($sql)){
      while ($registro = mysql_fetch_array($rs)) {
          $id = $registro[0];
          $espaco = $registro[1];
          $solicitante = $registro[2];
          $assunto = $registro[3];
          $categoria = $registro[4];
          $data = $registro[12];
          $h_inicial = $registro[6];
          $h_final = $registro[7];
          $desc = $registro[8];
          $user = $registro[9];
          return new Solicitacoes($id, $user, $espaco, $categoria, $solicitante, $data, $h_inicial, $h_final, $assunto, $desc, $registro[10]);
      }
    }else {
      return false;
    }
  }

  public function alterarSolicitacoes($a){
    $d=(isset($a['desc']) and !empty($a['desc']))? $a['desc'] : " ";
    $data=explode("/", $a['data']);
    $data=$data[2]."-".$data[1]."-".$data[0];
    $interno=(isset($a['interno']))? 1 : 0;
    $sql="UPDATE `solicitacoes` SET `id_espaco`={$a['espaco']},`id_solicitante`={$a['solicitantes']},`assunto`='{$a['assunto']}',`id_categoria`={$a['categoria']},
    `data`='$data',`i_hora`='{$a['h_inicial']}',`f_hora`='{$a['h_final']}',`desc`='$d',`id_user`={$a['id']}, `site_camara`=$interno WHERE id={$a['id_s']}";
    $rs = mysql_query($sql);
    $sql="DELETE FROM rel_rec_soli where id_solicitacao={$a['id_s']}";
    $result = mysql_query($sql);
    foreach ($a['rec'] as $user) {
      $sql="INSERT INTO `rel_rec_soli` (`id_recurso`, `id_solicitacao`) VALUES ($user, {$a['id_s']})";
      mysql_query($sql);
    }
    return $rs;
  }

  public function get_solicitacoes_data($dom, $sab, $mes, $ano, $dia){
    $mesAux=$mes;
    if ($dom>$sab) {
      if ($dia<$dom) {
        $mes--;
      }else {
        $mesAux=$mes+1;
      }
    }
    $sql="SELECT *,DATE_FORMAT(data,'%d/%m/%Y') FROM `solicitacoes` WHERE data BETWEEN '$ano-$mes-$dom' AND '$ano-$mesAux-$sab' and mostrar=0 ORDER by data";
    return $this->getArraySoc($sql);
  }
  public function get_rel_solicitacoes($id){
    $sql="SELECT cadas_recurso.* FROM rel_rec_soli , cadas_recurso WHERE id_solicitacao=$id and rel_rec_soli.id_recurso=cadas_recurso.id_recurso GROUP BY cadas_recurso.Nome ";
    $a=null;
    if($rs = mysql_query($sql)){
      while ($registro = mysql_fetch_array($rs)) {
        $id = $registro[0];
        $nome = $registro[1];
        $desc = $registro[2];
        $icone = $registro[4];
        $situacao = $registro[3];
        $c= new Recurso($id, $nome, $desc, $icone, $situacao);
        $a[]=$c;
      }
    }
    return $a;
  }

  public function get_recurso_espaco($id){
    $sql="SELECT cadas_recurso.* FROM rel_rec_esp,cadas_recurso
    where rel_rec_esp.id_espaco=$id and rel_rec_esp.id_recurso=cadas_recurso.id_recurso";
    $a=array();
    if($rs = mysql_query($sql)){
      while ($registro = mysql_fetch_array($rs)) {
        $id = $registro[0];
        $nome = $registro[1];
        $desc = $registro[2];
        $icone = $registro[4];
        $situacao = $registro[3];
        $c= new Recurso($id, $nome, $desc, $icone, $situacao);
        $a[]=$c;
      }
    }
    return $a;
  }

  public function get_solicitacoes_data_where($dom, $sab, $mes, $ano, $dia, $soli, $espaco, $categoria){
    $mesAux=$mes;
    if ($dom>$sab) {
      if ($dia<$dom) {
        $mes--;
      }else {
        $mesAux=$mes+1;
      }
    }
    $where=($espaco!="all" and !empty($espaco))? " and id_espaco=$espaco" : "";
    $where.=($soli!="all" and !empty($soli))? " and id_solicitante=$soli" : "";
    $where.=($categoria!="all" and !empty($categoria))? " and id_categoria=$categoria" : "";
    $sql="SELECT *,DATE_FORMAT(data,'%d/%m/%Y') FROM `solicitacoes` WHERE mostrar=0 and data BETWEEN '$ano-$mes-$dom' AND '$ano-$mesAux-$sab'$where ORDER by data";
    return $this->getArraySoc($sql);
  }

  public function buscar($query){
    $soc=array();
    $sql="SELECT solicitacoes.*,DATE_FORMAT(data,'%d/%m/%Y') FROM `solicitacoes`, cadas_espaco, cadas_solicitante, cadas_categoria WHERE mostrar=0 and solicitacoes.id_espaco=cadas_espaco.id_espaco and solicitacoes.id_solicitante=cadas_solicitante.id_solicitante and solicitacoes.id_categoria=cadas_categoria.id_categoria and (cadas_categoria.Nome LIKE '%$query%' OR cadas_espaco.Nome LIKE '%$query%' OR cadas_solicitante.Nome LIKE '%$query%' or DATE_FORMAT(data,'%d/%m/%Y') LIKE '%$query%' ) ";
    if ($rs=mysql_query($sql)) {
      while ($registro = mysql_fetch_array($rs)) {
          $id = $registro[0];
          $espaco = $registro[1];
          $solicitante = $registro[2];
          $assunto = $registro[3];
          $categoria = $registro[4];
          $data = $registro[12];
          $h_inicial = $registro[6];
          $h_final = $registro[7];
          $desc = $registro[8];
          $user = $registro[9];
          $soc[]= new Solicitacoes($id, $user, $espaco, $categoria, $solicitante, $data, $h_inicial, $h_final, $assunto, $desc, $registro[10]);
      }
    }
    $a=array();
    $sql="SELECT * FROM `cadas_categoria` WHERE Nome LIKE '%$query%'";
    $cat=array();
    if ($rs = mysql_query($sql)) {
      while ($registro = mysql_fetch_array($rs)) {
          $id = $registro[0];
          $nome = $registro[1];
          $espaco = $registro[3];
          $situacao = $registro[2];
          $validar = $registro[4];
          $c= new Categoria($id, $nome, $espaco, $situacao, $validar);
          $cat[]=$c;
      }
    }
    $sql="SELECT * FROM `cadas_espaco` WHERE `Nome` LIKE '%$query%'";
    $esp=$this->getArrayEsp($sql);
    $sql="SELECT * FROM `cadas_recurso` WHERE `Nome` LIKE '%$query%'";
    $rec=array();
    if($rs = mysql_query($sql)){
      while ($registro = mysql_fetch_array($rs)) {
        $id = $registro[0];
        $nome = $registro[1];
        $desc = $registro[2];
        $icone = $registro[4];
        $situacao = $registro[3];
        $c= new Recurso($id, $nome, $desc, $icone, $situacao);
        $rec[]=$c;
      }
    }
    $sql="SELECT * FROM `cadas_solicitante` WHERE Nome LIKE '%$query%' or Telefone LIKE '%$query%' or Nome_Contato LIKE '%$query%' or Endereco LIKE '%$query%' or CPF LIKE '%$query%' or CNPJ LIKE '%$query%'";
    $sol=array();
    if ($rs= mysql_query($sql)) {
      while ($registro = mysql_fetch_array($rs)) {
          $id = $registro[0];
          $nome = $registro[1];
          $mail = $registro[2];
          $cpf = $registro[3];
          $cnpj = $registro[4];
          $situacao = $registro[5];
          $telefone = $registro[6];
          $contato = $registro[7];
          $descricao = $registro[8];
          $endereco = $registro[9];
          $c= new Solicitantes($id, $nome, $mail, $cpf, $cnpj, $situacao, $telefone, $contato, $descricao, $endereco);
          $sol[]=$c;
      }
    }
    $sql="SELECT * FROM `cadas_usu` WHERE Nome LIKE '%$query%' or login LIKE '%$query%'";
    $usu=array();
    if($rs = mysql_query($sql)){
      while ($registro = mysql_fetch_array($rs)) {
          $id = $registro[0];
          $nome = $registro[1];
          $senha = $registro[2];
          $n_cartao = $registro[3];
          $mail = $registro[4];
          $perfil = $registro[5];
          $c= new Usuario($id, $nome, $senha, $n_cartao, $mail, $perfil);
          $usu[]=$c;
      }
    }
    $a['categoria']=$cat;$a['espaco']=$esp;$a['recurso']=$rec;$a['usuario']=$usu;$a['solicitante']=$sol;$a['solicitacoes']=$soc;
    return $a;
  }
  // Relatorios
  public function get_ranking(){
    $sql="SELECT cadas_solicitante.*,COUNT(solicitacoes.id) as cont FROM `solicitacoes`, cadas_solicitante WHERE mostrar=0 and cadas_solicitante.id_solicitante=solicitacoes.id_solicitante GROUP BY cadas_solicitante.Nome ORDER by cont DESC";
    $a=null;
    if($rs= mysql_query($sql)){
      while ($registro = mysql_fetch_array($rs)) {
          $id = $registro[0];
          $nome = $registro[1];
          $mail = $registro[2];
          $cpf = $registro[3];
          $cnpj = $registro[4];
          $situacao = $registro[5];
          $telefone = $registro[6];
          $contato = $registro[7];
          $descricao = $registro[8];
          $endereco = $registro[9];
          $c= new Solicitantes($id, $nome, $mail, $cpf, $cnpj, $situacao, $telefone, $contato, $descricao, $endereco);
          $a[]['esp']=array($c, $registro[10]);
      }
    }
    return $a;
  }

  public function get_ranking_esp(){
    $sql="SELECT cadas_espaco.*,COUNT(solicitacoes.id) as cont FROM `solicitacoes`, cadas_espaco WHERE mostrar=0 and cadas_espaco.id_espaco=solicitacoes.id_espaco GROUP BY cadas_espaco.Nome ORDER by cont DESC";
    $a=null;
    if ($rs = mysql_query($sql)) {
      while ($registro = mysql_fetch_array($rs)) {
          $id = $registro[0];
          $nome = $registro[1];
          $senha = $registro[2];
          $n_cartao = $registro[3];
          $mail = $registro[4];
          $c= new Espaco($id, $nome, $senha, $n_cartao, $mail);
          $a[]['esp']=array($c, $registro[5]);
      }
    }
    return $a;
  }

  public function get_soli_all(){
    $sql="SELECT *,DATE_FORMAT(data,'%d/%m/%Y') as cont FROM `solicitacoes` where mostrar=0";
    return $this->getArraySoc($sql);
  }

  public function get_soli_ano(){
    $d=date("Y");
    $sql="SELECT *,DATE_FORMAT(data,'%d/%m/%Y') FROM `solicitacoes` WHERE mostrar=0 and data BETWEEN '$d-01-01' and '$d-12-31'";
    return $this->getArraySoc($sql);
  }

  public function get_soli_mes($d){
    $sql="SELECT *,DATE_FORMAT(data,'%d/%m/%Y') FROM solicitacoes WHERE mostrar=0 and '$d'=SUBSTRING_INDEX(data,'-',2)";
    return $this->getArraySoc($sql);
  }

  public function getArraySoc($sql){
    $a=array();
    if ($rs=mysql_query($sql)) {
      while ($registro = mysql_fetch_array($rs)) {
          $id = $registro[0];
          $espaco = $registro[1];
          $solicitante = $registro[2];
          $assunto = $registro[3];
          $categoria = $registro[4];
          $data = $registro[12];
          $h_inicial = $registro[6];
          $h_final = $registro[7];
          $desc = $registro[8];
          $user = $registro[9];
          $a[]= new Solicitacoes($id, $user, $espaco, $categoria, $solicitante, $data, $h_inicial, $h_final, $assunto, $desc, $registro[10]);
      }
    }
    return $a;
  }

  public function getRelCatSocData($id, $data, $s){
    $where=($s)? "and site_camara=0":"";
    $sql="SELECT *,DATE_FORMAT(data, '%d/%m/%Y') as dataF FROM `solicitacoes`,cadas_categoria WHERE mostrar=0 and cadas_categoria.id_categoria=solicitacoes.id_categoria and cadas_categoria.id_categoria=$id and DATE_FORMAT(data, '%d/%m/%Y')='$data' $where ";
    $a=array();
    if($rs=mysql_query($sql)){
      while ($registro = mysql_fetch_array($rs)) {
          $id = $registro[0];
          $espaco = $registro[1];
          $solicitante = $registro[2];
          $assunto = $registro[3];
          $categoria = $registro[4];
          $data = $registro["dataF"];
          $h_inicial = $registro[6];
          $h_final = $registro[7];
          $desc = $registro[8];
          $user = $registro[9];
          $a[]= new Solicitacoes($id, $user, $espaco, $categoria, $solicitante, $data, $h_inicial, $h_final, $assunto, $desc, $registro[10]);
      }
    }
    return $a;
  }

  public function getPesquisaEspaco($tipo, $data, $soli, $espaco, $categoria, $tipo){
    $where=($espaco!="all" and !empty($espaco))? " and id_espaco=$espaco" : "";
    $where.=($soli!="all" and !empty($soli))? " and id_solicitante=$soli" : "";
    $where.=($categoria!="all" and !empty($categoria))? " and id_categoria=$categoria" : "";
    if ($tipo==1) {
      $sql="SELECT *,DATE_FORMAT(data,'%d/%m/%Y') FROM `solicitacoes` WHERE mostrar=0 and SUBSTRING_INDEX(data,'-',1)='$data' $where  ORDER BY  data, i_hora ASC";
    }
    elseif ($tipo==2) {
      $sql="SELECT *,DATE_FORMAT(data,'%d/%m/%Y') FROM `solicitacoes` WHERE mostrar=0 and SUBSTRING_INDEX(data,'-',2)='$data' $where  ORDER BY  data, i_hora ASC";
    }
    elseif ($tipo==3) {
      $sql="SELECT *,DATE_FORMAT(data,'%d/%m/%Y') FROM `solicitacoes` WHERE mostrar=0 and data='$data' $where  ORDER BY  data, i_hora ASC";
    }
    if (isset($sql)) {
      return $this->getArraySoc($sql);
    }else {
      return array();
    }
  }

}
?>
