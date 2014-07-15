<?php
require_once "core.inc.php";

/* Verifica se o usuário está autenticado. */
if (!isset($fb_profile))
{
	header("Location: " . $website_root . "/login-social");
}

/* Conecta-se ao banco de dados. */
$db = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);
mysql_select_db($mysql_database, $db);

/* Verifica se o usuário está cadastrado. */
$sql = sprintf("SELECT 1 FROM mobface_facebookuser WHERE fb_uid = %d;", $fb_profile->getProperty('id'));
$res = mysql_query($sql);
$muf_registered = (mysql_num_rows($res) == 1) ? true : false;

/* Fecha a conexão com o banco de dados. */
mysql_close($db);

/* Redireciona o usuário para a página de cadastro. */
if ($muf_registered === false)
{
	header("Location: " . $website_root . "/confirmar-cadastro");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <?php include("header.inc.php"); ?>
  <body>

    <?php require "navbar.inc.php"; ?>

    <div class="jumbotron">
      <div class="container">
        <h1>Painel do usuário</h1>
        <p>Administre a sua conta no Mob Your Face.</p>
      </div>
    </div>

    
	
	<?php require "footer.inc.php"; ?>
  </body>
</html>
