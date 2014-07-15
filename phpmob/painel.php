<?php
require_once "core.inc.php";
require_once "muf-user.inc.php";

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
