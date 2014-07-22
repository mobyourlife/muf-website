<?php
require_once "core.inc.php";

if (isset($fb_profile))
{
	if (isset($fb_registered) && $fb_registered === true)
	{
		if (isset($fb_pending_payment) && $fb_pending_payment === false)
		{
			header("Location: " . $website_root . "/painel");
		}
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
        <h1>Efetuar pagamento</h1>
        <p>Faça o seu pagamento seguro para finalizar a sua compra e começar a usar o seu novo site!</p>
      </div>
    </div>

    <div class="container">
		<div class="process">
			<div class="process-row">
				<div class="process-step">
					<button type="button" class="btn btn-success btn-circle" disabled="disabled"><i class="fa fa-facebook fa-3x"></i></button>
					<p>Login social</p>
				</div>
				<div class="process-step">
					<button type="button" class="btn btn-success btn-circle" disabled="disabled"><i class="fa fa-pencil fa-3x"></i></button>
					<p>Confirmar cadastro</p>
				</div>
				<div class="process-step">
					<button type="button" class="btn btn-info btn-circle" disabled="disabled"><i class="fa fa-usd fa-3x"></i></button>
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
				Clique no botão abaixo para efetuar o pagamento com PagSeguro.
			</p>
			<p>
				<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
				<form action="<?php print(($pgs_producao === true) ? "https://pagseguro.uol.com.br/checkout/v2/payment.html" : "https://sandbox.pagseguro.uol.com.br/checkout/v2/payment.html"); ?>" method="post" onsubmit="PagSeguroLightbox(this); return false;">
					<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
					<input type="hidden" name="code" value="<?php print($pgs_token); ?>" />
					<input type="image" src="<?php printlink("/img/pagseguro.gif"); ?>" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
				</form>
				<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
				<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
			</p>
		</div>
	</div>
	
	<?php require "footer.inc.php"; ?>
	<script src="<?php printlink("js/muf.social-login.js"); ?>"></script>
  </body>
</html>
