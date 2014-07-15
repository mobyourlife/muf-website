<?php
require_once "core.inc.php";

if (isset($fb_profile))
{
	if (isset($fb_registered) && $fb_registered === true)
	{
		header("Location: " . $website_root . "/painel");
	}
	else
	{
		header("Location: " . $website_root . "/confirmar-cadastro");
	}
}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <?php include("header.inc.php"); ?>
  <body>

    <?php require "navbar.inc.php"; ?>

    <div class="jumbotron">
      <div class="container">
        <h1>Login social</h1>
        <p>Efetue login através de seu Facebook para começar.</p>
      </div>
    </div>

    <div class="container">
		<div class="process">
			<div class="process-row">
				<div class="process-step">
					<button type="button" class="btn btn-info btn-circle" disabled="disabled"><i class="fa fa-facebook fa-3x"></i></button>
					<p>Login social</p>
				</div>
				<div class="process-step">
					<button type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-pencil fa-3x"></i></button>
					<p>Confirmar cadastro</p>
				</div>
				<div class="process-step">
					<button type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-usd fa-3x"></i></button>
					<p>Efetuar pagamento</p>
				</div> 
				 <div class="process-step">
					<button type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-thumbs-up fa-3x"></i></button>
					<p>Pronto!</p>
				</div> 
			</div>
		</div>
		<div class="center">
			<p>
				Clique no botão abaixo para efetuar login.
			</p>
			<p>
				<button id="btn-fblogin" class="btn btn-lg btn-primary" onclick="facebookPopup('<?php print($fb_loginurl); ?>', '<?php print($fb_panelurl); ?>'); "><span class="fa fa-facebook jump-5"></span> Entrar com Facebook</button>
			</p>
		</div>
	</div>
	
	<?php require "footer.inc.php"; ?>
	<script src="<?php printlink("js/muf.social-login.js"); ?>"></script>
  </body>
</html>
