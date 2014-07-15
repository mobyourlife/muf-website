<?php
require_once "core.inc.php";

/* Redireciona o usuário para a página de login. */
if (!isset($fb_profile))
{
	header("Location: " . $website_root . "/login-social");
}
/* Redireciona o usuário para o painel do usuário. */
else if ($muf_registered === true)
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
        <h1>Confirmar cadastro</h1>
        <p>Por favor verifique os seus dados antes de continuar.</p>
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
					<button type="button" class="btn btn-info btn-circle" disabled="disabled"><i class="fa fa-pencil fa-3x"></i></button>
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
		
		<div class="col-md-8 col-md-offset-2">
			<form class="form-horizontal" action="" method="post">
			  <fieldset>
			  
				<!-- Name input -->
				<div class="form-group">
				  <label class="col-md-3 control-label" for="name">Nome</label>
				  <div class="col-md-9">
					<input id="name" name="name" type="text" placeholder="Seu nome" class="form-control" value="<?php print($fb_profile->getProperty('name')); ?>">
				  </div>
				</div>
		
				<!-- Email input -->
				<div class="form-group">
				  <label class="col-md-3 control-label" for="email">E-mail</label>
				  <div class="col-md-9">
					<input id="email" name="email" type="text" placeholder="Seu endereço de e-mail" class="form-control" value="<?php print($fb_profile->getProperty('email')); ?>">
				  </div>
				</div>
		
				<!-- Home town -->
				<div class="form-group">
				  <label class="col-md-3 control-label" for="email">Localização</label>
				  <div class="col-md-9">
					<input id="location" name="location" type="text" placeholder="Sua cidade residencial" class="form-control" value="<?php print($fb_profile->getProperty('location')); ?>">
				  </div>
				</div>
		
				<!-- Message body -->
				<div class="form-group">
				  <label class="col-md-3 control-label" for="message">Mensagem</label>
				  <div class="col-md-9">
					<textarea class="form-control" id="message" name="message" placeholder="Digite a sua mensagem aqui" rows="5"></textarea>
				  </div>
				</div>
		
				<!-- Form actions -->
				<div class="form-group">
				  <div class="col-md-12 text-right">
					<button type="submit" class="btn btn-info btn-lg">Continuar</button>
				  </div>
				</div>
			  </fieldset>
			</form>
		</div>
	</div>
	
	<?php require "footer.inc.php"; ?>
	<script src="<?php printlink("js/muf.social-login.js"); ?>"></script>
  </body>
</html>
