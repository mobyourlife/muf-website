<?php
require_once "core.inc.php";
require_once "facebook.inc.php";

if (isset($fb_profile))
{
	header("Location: " . $website_root . "/painel");
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
				<button class="btn btn-lg btn-primary" onclick="facebookPopup('<?php print($fb_loginurl); ?>'); ">Entrar com Facebook</button>
			</p>
		</div>
		<!--
		<div class="alert alert-info" role="alert">
			Aguardando login com Facebook...
		</div>
		<div>
			<button class="btn btn-lg btn-primary" onclick="facebookPopup('<?php print($fb_loginurl); ?>'); ">Entrar com Facebook</button>
		</div>
		-->
	</div>
	
	<?php require "footer.inc.php"; ?>
	<script src="<?php printlink("js/muf.social-login.js"); ?>"></script>
  </body>
</html>
