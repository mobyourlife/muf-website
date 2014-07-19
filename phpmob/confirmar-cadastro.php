<?php
require_once "core.inc.php";

if (isset($fb_profile))
{
	if (isset($fb_registered) && $fb_registered === true)
	{
		header("Location: " . $website_root . "/painel");
	}
}
else
{
	header("Location: " . $website_root . "/login-social");
}

$fb_accounts = get_accounts()->getProperty('data')->asArray();

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
			  
				<!-- Confirmação de nome -->
				<div class="form-group">
				  <label class="col-md-3 control-label" for="name">Nome</label>
				  <div class="col-md-9">
					<input id="name" name="name" type="text" placeholder="Seu nome" class="form-control" value="<?php print($fb_profile->getProperty('name')); ?>" readonly="readonly">
				  </div>
				</div>
		
				<!-- Tipo de conta -->
				<div class="form-group">
				  <label class="col-md-3 control-label" for="email">Tipo de conta</label>
				  <div class="col-md-9">
					<div class="input-group">
						<div id="radioBtn" class="btn-group">
							<input type="hidden" name="account_type" id="account_type">
							<a class="btn btn-primary" data-toggle="account_type" data-value="profile">Pessoal</a>
							<a class="btn btn-default" data-toggle="account_type" data-value="fanpage">Página</a>
						</div>
					</div>
				  </div>
				</div>
		
				<!-- Nome da conta -->
				<div id="select_account_id" class="form-group" style="display: none">
				  <label class="col-md-3 control-label" for="email">Nome da conta</label>
				  <div class="col-md-9">
					<div class="input-group">
						<div id="radioBtn" class="btn-group">
							<input type="hidden" name="account_id" id="account_id">
							<?php
							$first = true;
							if (count($fb_accounts) > 0)
							{
								foreach ($fb_accounts as $page)
								{
								?>
								<a class="btn btn-<?php print(($first == true) ? "primary" : "default"); $first = false; ?>" data-toggle="account_id" data-value="<?php print($page->id); ?>"><?php print($page->name); ?></a><br/>
								<?php
								}
							}
							else
							{
							?>
								Você não é administrador de nenhuma página!
							<?php
							}
							?>
						</div>
					</div>
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
