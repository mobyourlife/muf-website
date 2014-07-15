<?php
require_once "core.inc.php";

if (isset($fb_profile))
{
	if (!isset($fb_registered) || $fb_registered === false)
	{
		header("Location: " . $website_root . "/confirmar-cadastro");
	}
}
else
{
	header("Location: " . $website_root . "/login-social");
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
