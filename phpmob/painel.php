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

/* Conecta-se ao banco de dados. */
$db = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password);
mysqli_select_db($db, $mysql_database);

/* Consulta o cadastro. */
$sql = sprintf("SELECT fb_uid, fb_pgid, register_date, subdomain, account_status FROM mob_fb_page_admins WHERE fb_uid = %s;"
				, $fb_profile->getProperty('id'));
$res = mysqli_query($db, $sql);

/* Verifica a consulta. */
$row = mysqli_fetch_assoc($res);
$account_type = ($row['fb_uid'] == $row['fb_pgid']) ? "Pessoal" : "Página";
$register_date = date("d/m/Y H:i:s", strtotime($row['register_date']));
$account_status_id = $row['account_status'];
$account_status = "Conta bloqueada";

switch ($account_status_id)
{
	case 1:
		$account_status = "Aguardando pagamento";
		break;
	
	case 2:
		$account_status = "Aguardando confirmação do PagSeguro";
		break;
	
	case 10:
		$account_status = "Conta ativa";
		break;
}

/* Fecha a conexão com o banco de dados. */
mysqli_close($db);

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
											<td><?php print($account_type); ?></td>
										</tr>
										<tr>
											<td>Data de cadastro:</td>
											<td><?php print($register_date); ?></td>
										</tr>
										<tr>
											<td>Estado da conta</td>
											<td><?php print($account_status); ?></td>
										</tr>
									</tbody>
								</table>

								<div class="center">
									<?php
									if ($account_status_id == 1)
									{
									?>
									<a href="<?php printlink("efetuar-pagamento"); ?>" class="btn btn-lg btn-success"><span class="fa fa-dollar jump-5"></span> Efetuar pagamento</a>
									<?php
									}
									?>
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
