<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

 session_start();
  if (isset($_GET["order"])) $order = @$_GET["order"];
  if (isset($_GET["type"])) $ordtype = @$_GET["type"];

  if (isset($_POST["filter"])) $filter = @$_POST["filter"];
  if (isset($_POST["filter_field"])) $filterfield = @$_POST["filter_field"];
  $wholeonly = false;
  if (isset($_POST["wholeonly"])) $wholeonly = @$_POST["wholeonly"];

  if (!isset($order) && isset($_SESSION["order"])) $order = $_SESSION["order"];
  if (!isset($ordtype) && isset($_SESSION["type"])) $ordtype = $_SESSION["type"];
  if (!isset($filter) && isset($_SESSION["filter"])) $filter = $_SESSION["filter"];
  if (!isset($filterfield) && isset($_SESSION["filter_field"])) $filterfield = $_SESSION["filter_field"];

?>

<html>
<head>
<title></title>
<meta name="generator" http-equiv="content-type" content="text/html; charset=UTF-8">
<style type="text/css">
  body {
    background-color: #FFFFFF;
    color: #004080;
    font-family: Arial;
    font-size: 12px;
  }
  .bd {
    background-color: #FFFFFF;
    color: #004080;
    font-family: Arial;
    font-size: 12px;
  }
  .tbl {
    background-color: #FFFFFF;
  }
  a:link { 
    background-color: #FFFFFF01;
    color: #0000FF;
    font-family: Arial;
    font-size: 12px;
  }
  a:active { 
    background-color: #FFFFFF01;
    color: #0000FF;
    font-family: Arial;
    font-size: 12px;
  }
  a:visited { 
    background-color: #FFFFFF01;
    color: #800080;
    font-family: Arial;
    font-size: 12px;
  }
  .hr {
    background-color: #B22222;
    color: #FFFFFF;
    font-family: Arial;
    font-size: 12px;
    font-weight: bold;
  }
  a.hr:link {
    color: #FFFFFF;
    font-family: Arial;
    font-size: 12px;
    font-weight: bold;
  }
  a.hr:active {
    color: #FFFFFF;
    font-family: Arial;
    font-size: 12px;
    font-weight: bold;
  }
  a.hr:visited {
    color: #FFFFFF;
    font-family: Arial;
    font-size: 12px;
    font-weight: bold;
  }
  .dr {
    background-color: #FFFFFF;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
  }
  .sr {
    background-color: #F5F5F5;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
  }
</style>
</head>
<body>
<table class="bd" width="100%"><tr><td class="hr"><h2>Consulta de Auditoría</h2></td></tr></table>
<?php
  $conn = connect();
  $showrecs = 10;
  $pagerange = 10;

  $a = @$_GET["a"];
  $recid = @$_GET["recid"];
  $page = @$_GET["page"];
  if (!isset($page)) $page = 1;

  $sql = @$_POST["sql"];

  switch ($sql) {
    case "update":
      sql_update();
      break;
  }

  switch ($a) {
    case "view":
      viewrec($recid);
      break;
    case "edit":
      editrec($recid);
      break;
    default:
      select();
      break;
  }

  if (isset($order)) $_SESSION["order"] = $order;
  if (isset($ordtype)) $_SESSION["type"] = $ordtype;
  if (isset($filter)) $_SESSION["filter"] = $filter;
  if (isset($filterfield)) $_SESSION["filter_field"] = $filterfield;
  if (isset($wholeonly)) $_SESSION["wholeonly"] = $wholeonly;

  pg_close($conn);
?>
<table class="bd" width="100%"><tr><td class="hr">PDVSA-INTEVEP</td></tr></table>
</body>
</html>

<?php function select()
  {
  global $a;
  global $showrecs;
  global $page;
  global $filter;
  global $filterfield;
  global $wholeonly;
  global $order;
  global $ordtype;


  if ($a == "reset") {
    $filter = "";
    $filterfield = "";
    $wholeonly = "";
    $order = "";
    $ordtype = "";
  }

  $checkstr = "";
  if ($wholeonly) $checkstr = " checked";
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }
  $res = sql_select();
  $count = sql_getrecordcount();
  if ($count % $showrecs != 0) {
    $pagecount = intval($count / $showrecs) + 1;
  }
  else {
    $pagecount = intval($count / $showrecs);
  }
  $startrec = $showrecs * ($page - 1);
  if ($startrec < $count) {@pg_result_seek($res, $startrec);}
  $reccount = min($showrecs * $page, $count);
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr><td></td></tr>
<tr><td>Mostrando Registros <?php echo $startrec + 1 ?> - <?php echo $reccount ?> de <?php echo $count ?></td></tr>
</table>
<hr size="1" noshade>
<form action="pagina_auditoria.php" method="post">
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><b>Personalizar Filtro</b>&nbsp;</td>
<td><input type="text" name="filter" value="<?php echo $filter ?>"></td>
<td><select name="filter_field">
<option value="">Todos Los Campos</option>
<option value="<?php echo "fe_auditoria" ?>"<?php if ($filterfield == "fe_auditoria") { echo "selected"; } ?>><?php echo htmlspecialchars("Fecha") ?></option>
<option value="<?php echo "di_ip" ?>"<?php if ($filterfield == "di_ip") { echo "selected"; } ?>><?php echo htmlspecialchars("IP") ?></option>
<option value="<?php echo "in_usuario_red" ?>"<?php if ($filterfield == "in_usuario_red") { echo "selected"; } ?>><?php echo htmlspecialchars("Id RED") ?></option>
<option value="<?php echo "tx_accion" ?>"<?php if ($filterfield == "tx_accion") { echo "selected"; } ?>><?php echo htmlspecialchars("Acción") ?></option>
<option value="<?php echo "tx_tipo_accion" ?>"<?php if ($filterfield == "tx_tipo_accion") { echo "selected"; } ?>><?php echo htmlspecialchars("Tipo de Acción") ?></option>
<option value="<?php echo "tx_tabla" ?>"<?php if ($filterfield == "tx_tabla") { echo "selected"; } ?>><?php echo htmlspecialchars("Tabla") ?></option>
</select></td>
<td><input type="checkbox" name="wholeonly"<?php echo $checkstr ?>>Solo palabras completas</td>
</td></tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="action" value="Aplicar Filtro"></td>
<td><a href="pagina_auditoria.php?a=reset">Borrar Filtro</a></td>
</tr>
</table>
</form>
<hr size="1" noshade>
<?php showpagenav($page, $pagecount); ?>
<br>
<table class="tbl" border="0" cellspacing="1" cellpadding="5"width="100%">
<tr>
<td class="hr">&nbsp;</td>
<td class="hr">&nbsp;</td>
<td class="hr"><a class="hr" href="pagina_auditoria.php?order=<?php echo "fe_auditoria" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("Fecha") ?></a></td>
<td class="hr"><a class="hr" href="pagina_auditoria.php?order=<?php echo "di_ip" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("IP") ?></a></td>
<td class="hr"><a class="hr" href="pagina_auditoria.php?order=<?php echo "in_usuario_red" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("Id RED") ?></a></td>
<td class="hr"><a class="hr" href="pagina_auditoria.php?order=<?php echo "tx_accion" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("Acción") ?></a></td>
<td class="hr"><a class="hr" href="pagina_auditoria.php?order=<?php echo "tx_tipo_accion" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("Tipo de Acción") ?></a></td>
<td class="hr"><a class="hr" href="pagina_auditoria.php?order=<?php echo "tx_tabla" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("Tabla") ?></a></td>
</tr>
<?php
  for ($i = $startrec; $i < $reccount; $i++)
  {
    $row = pg_fetch_assoc($res);
    $style = "dr";
    if ($i % 2 != 0) {
      $style = "sr";
    }
?>
<tr>
<td class="<?php echo $style ?>"><a href="pagina_auditoria.php?a=view&recid=<?php echo $i ?>">Ver</a></td>
<td class="<?php echo $style ?>"><a href="pagina_auditoria.php?a=edit&recid=<?php echo $i ?>">Modificar</a></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["fe_auditoria"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["di_ip"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["in_usuario_red"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["tx_accion"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["tx_tipo_accion"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["tx_tabla"]) ?></td>
</tr>
<?php
  }
  pg_free_result($res);
?>
</table>
<br>
<?php } ?>

<?php function showrow($row, $recid)
  {
?>
<table class="tbl" border="0" cellspacing="1" cellpadding="5"width="50%">
<tr>
<td class="hr"><?php echo htmlspecialchars("Fecha")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["fe_auditoria"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("IP")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["di_ip"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("Id RED")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["in_usuario_red"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("Acción")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["tx_accion"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("Tipo de Acción")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["tx_tipo_accion"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("Tabla")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["tx_tabla"]) ?></td>
</tr>
</table>
<?php } ?>

<?php function showroweditor($row, $iseditmode)
  {
  global $conn;
?>
<table class="tbl" border="0" cellspacing="1" cellpadding="5"width="50%">
<tr>
<td class="hr"><?php echo htmlspecialchars("co_auditoria")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="co_auditoria" value="<?php echo str_replace('"', '&quot;', trim($row["co_auditoria"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("Fecha")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="fe_auditoria" value="<?php echo str_replace('"', '&quot;', trim($row["fe_auditoria"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("IP")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="di_ip" maxlength="15" value="<?php echo str_replace('"', '&quot;', trim($row["di_ip"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("Id RED")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="in_usuario_red" maxlength="15" value="<?php echo str_replace('"', '&quot;', trim($row["in_usuario_red"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("Acción")."&nbsp;" ?></td>
<td class="dr"><textarea cols="35" rows="4" name="tx_accion" maxlength="200"><?php echo str_replace('"', '&quot;', trim($row["tx_accion"])) ?></textarea></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("Tipo de Acción")."&nbsp;" ?></td>
<td class="dr"><select name="tx_tipo_accion">
<option value=""></option>
<?php
  $lookupvalues = array("I","D","U");

  reset($lookupvalues);
  foreach($lookupvalues as $val){
  $caption = $val;
  if ($row["tx_tipo_accion"] == $val) {$selstr = " selected"; } else {$selstr = ""; }
 ?><option value="<?php echo $val ?>"<?php echo $selstr ?>><?php echo $caption ?></option>
<?php } ?></select>
</td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("Tabla")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="tx_tabla" maxlength="20" value="<?php echo str_replace('"', '&quot;', trim($row["tx_tabla"])) ?>"></td>
</tr>
</table>
<?php } ?>

<?php function showpagenav($page, $pagecount)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<?php if ($page > 1) { ?>
<td><a href="pagina_auditoria.php?page=<?php echo $page - 1 ?>">&lt;&lt;&nbsp;Anterior</a>&nbsp;</td>
<?php } ?>
<?php
  global $pagerange;

  if ($pagecount > 1) {

  if ($pagecount % $pagerange != 0) {
    $rangecount = intval($pagecount / $pagerange) + 1;
  }
  else {
    $rangecount = intval($pagecount / $pagerange);
  }
  for ($i = 1; $i < $rangecount + 1; $i++) {
    $startpage = (($i - 1) * $pagerange) + 1;
    $count = min($i * $pagerange, $pagecount);

    if ((($page >= $startpage) && ($page <= ($i * $pagerange)))) {
      for ($j = $startpage; $j < $count + 1; $j++) {
        if ($j == $page) {
?>
<td><b><?php echo $j ?></b></td>
<?php } else { ?>
<td><a href="pagina_auditoria.php?page=<?php echo $j ?>"><?php echo $j ?></a></td>
<?php } } } else { ?>
<td><a href="pagina_auditoria.php?page=<?php echo $startpage ?>"><?php echo $startpage ."..." .$count ?></a></td>
<?php } } } ?>
<?php if ($page < $pagecount) { ?>
<td>&nbsp;<a href="pagina_auditoria.php?page=<?php echo $page + 1 ?>">Siguiente&nbsp;&gt;&gt;</a>&nbsp;</td>
<?php } ?>
</tr>
</table>
<?php } ?>

<?php function showrecnav($a, $recid, $count)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="pagina_auditoria.php">Regresar</a></td>
<?php if ($recid > 0) { ?>
<td><a href="pagina_auditoria.php?a=<?php echo $a ?>&recid=<?php echo $recid - 1 ?>">Anterior</a></td>
<?php } if ($recid < $count - 1) { ?>
<td><a href="pagina_auditoria.php?a=<?php echo $a ?>&recid=<?php echo $recid + 1 ?>">Siguiente</a></td>
<?php } ?>
</tr>
</table>
<hr size="1" noshade>
<?php } ?>


<?php function viewrec($recid)
{
  $res = sql_select();
  $count = sql_getrecordcount();
  @pg_result_seek($res, $recid);
  $row = pg_fetch_assoc($res);
  showrecnav("view", $recid, $count);
?>
<br>
<?php showrow($row, $recid) ?>
<br>
<hr size="1" noshade>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="pagina_auditoria.php?a=edit&recid=<?php echo $recid ?>">Modificar Registro</a></td>
</tr>
</table>
<?php
  pg_free_result($res);
} ?>

<?php function editrec($recid)
{
  $res = sql_select();
  $count = sql_getrecordcount();
  @pg_result_seek($res, $recid);
  $row = pg_fetch_assoc($res);
  showrecnav("edit", $recid, $count);
?>
<br>
<form enctype="multipart/form-data" action="pagina_auditoria.php" method="post">
<input type="hidden" name="sql" value="update">
<input type="hidden" name="xco_auditoria" value="<?php echo $row["co_auditoria"] ?>">
<?php showroweditor($row, true); ?>
<p><input type="submit" name="action" value="Guardar"></p>
</form>
<?php
  pg_free_result($res);
} ?>

<?php function connect()
{
  $conn = pg_connect("host=129.90.60.41 port=5433 dbname=sisaalab user=sisaalab password=sisaalab2008");
  return $conn;
}

function sqlvalue($val, $quote)
{
  if ($quote)
    $tmp = sqlstr($val);
  else
    $tmp = $val;
  if ($tmp == "")
    $tmp = "NULL";
  elseif ($quote)
    $tmp = "'".$tmp."'";
  return $tmp;
}

function sqlstr($val)
{
  return str_replace("'", "''", $val);
}

function sql_select()
{
  global $conn;
  global $order;
  global $ordtype;
  global $filter;
  global $filterfield;
  global $wholeonly;

  $filterstr = sqlstr($filter);
  if (!$wholeonly && isset($wholeonly) && $filterstr!='') $filterstr = "%" .$filterstr ."%";
  $sql = "SELECT co_auditoria, fe_auditoria, di_ip, in_usuario_red, tx_accion, tx_tipo_accion, tx_tabla FROM sisaalab.tr013_auditoria";
  if (isset($filterstr) && $filterstr!='' && isset($filterfield) && $filterfield!='') {
    $sql .= " where " .sqlstr($filterfield) ." like '" .$filterstr ."'";
  } elseif (isset($filterstr) && $filterstr!='') {
    $sql .= " where (fe_auditoria like '" .$filterstr ."') or (di_ip like '" .$filterstr ."') or (in_usuario_red like '" .$filterstr ."') or (tx_accion like '" .$filterstr ."') or (tx_tipo_accion like '" .$filterstr ."') or (tx_tabla like '" .$filterstr ."')";
  }
  if (isset($order) && $order!='') $sql .= " order by \"" .sqlstr($order) ."\"";
  if (isset($ordtype) && $ordtype!='') $sql .= " " .sqlstr($ordtype);
  $res = pg_query($conn, $sql) or die(pg_last_error());
  return $res;
}

function sql_getrecordcount()
{
  global $conn;
  global $order;
  global $ordtype;
  global $filter;
  global $filterfield;
  global $wholeonly;

  $filterstr = sqlstr($filter);
  if (!$wholeonly && isset($wholeonly) && $filterstr!='') $filterstr = "%" .$filterstr ."%";
  $sql = "SELECT COUNT(*) FROM sisaalab.tr013_auditoria";
  if (isset($filterstr) && $filterstr!='' && isset($filterfield) && $filterfield!='') {
    $sql .= " where " .sqlstr($filterfield) ." like '" .$filterstr ."'";
  } elseif (isset($filterstr) && $filterstr!='') {
    $sql .= " where (fe_auditoria like '" .$filterstr ."') or (di_ip like '" .$filterstr ."') or (in_usuario_red like '" .$filterstr ."') or (tx_accion like '" .$filterstr ."') or (tx_tipo_accion like '" .$filterstr ."') or (tx_tabla like '" .$filterstr ."')";
  }
  $res = pg_query($conn, $sql) or die(pg_last_error());
  $row = pg_fetch_assoc($res);
  reset($row);
  return current($row);
}

function sql_update()
{
  global $conn;
  global $_POST;

  $sql = "update sisaalab.tr013_auditoria set co_auditoria=" .sqlvalue(@$_POST["co_auditoria"], false).", fe_auditoria=" .sqlvalue(@$_POST["fe_auditoria"], true).", di_ip=" .sqlvalue(@$_POST["di_ip"], true).", in_usuario_red=" .sqlvalue(@$_POST["in_usuario_red"], true).", tx_accion=" .sqlvalue(@$_POST["tx_accion"], true).", tx_tipo_accion=" .sqlvalue(@$_POST["tx_tipo_accion"], true).", tx_tabla=" .sqlvalue(@$_POST["tx_tabla"], true) ." where " .primarykeycondition();
  pg_query($conn, $sql) or die(pg_last_error());
}
function primarykeycondition()
{
  global $_POST;
  $pk = "";
  $pk .= "(co_auditoria";
  if (@$_POST["xco_auditoria"] == "") {
    $pk .= " IS NULL";
  }else{
  $pk .= " = " .sqlvalue(@$_POST["xco_auditoria"], false);
  };
  $pk .= ")";
  return $pk;
}
 ?>
