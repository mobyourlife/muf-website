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
        <p>Administre a sua conta no Mob Your Life.</p>
      </div>
    </div>
    
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
				<div class="panel panel-info">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12 col-lg-12"> 
								<table class="table table-user-information">
									<tbody>
										<tr>
											<td>Seu nome:</td>
											<td><?php print($fb_profile->getProperty('name')); ?></td>
										</tr>
									<tbody>
										<tr>
											<td>Tipo de conta:</td>
											<td>Pessoal</td>
										</tr>
										<tr>
											<td>Data de cadastro:</td>
											<td>06/23/2013</td>
										</tr>
										<tr>
											<td>Estado da conta</td>
											<td>Aguardando pagamento</td>
										</tr>
									</tbody>
								</table>

								<div class="center">
									<a href="<?php printlink("efetuar-pagamento"); ?>" class="btn btn-lg btn-success"><span class="fa fa-dollar jump-5"></span> Efetuar pagamento</a>
									<a href="#" class="btn btn-lg btn-info"><span class="fa fa-globe jump-5"></span> Acessar meu site</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php require "footer.inc.php"; ?>
  </body>
</html>
