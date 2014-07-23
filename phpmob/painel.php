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
$register_date = fromsqldate($row['register_date']);
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

$subdomain = $row['subdomain'];
$url = "http://" . $subdomain . ".mobyourlife.com.br";
$url_label = $subdomain . ".mobyourlife.com.br";

/* Resgata o próximo cupom de desconto. */
$sql = sprintf("SELECT id, label, freebie_days, redeem_date, expire_date FROM mob_coupons_freebies WHERE best_before > NOW() AND redeem_date IS NULL ORDER BY best_before ASC LIMIT 1;"
				, $fb_profile->getProperty('id'));
$res = mysqli_query($db, $sql);

if (mysqli_num_rows($res) != 0)
{
	$row = mysqli_fetch_assoc($res);
	
	if ($row)
	{
		$sql = sprintf("UPDATE mob_coupons_freebies SET redeem_date = NOW(), expire_date = NOW() + INTERVAL %d DAY WHERE id = %d;"
						, $row['freebie_days'], $row['id']);
		mysqli_query($db, $sql);
	}
}

/* Consulta os cupons de desconto disponíveis. */
$sql = sprintf("SELECT id, label, freebie_days, redeem_date, expire_date FROM mob_all_coupons WHERE fb_uid = %s;"
				, $fb_profile->getProperty('id'));
$res = mysqli_query($db, $sql);

/* Lista todos os cupons, resgatando-os conforme possível. */
$coupons = array();

while ($row = mysqli_fetch_assoc($res))
{
	$item = array();
	$item['label'] = $row['label'];
	$item['redeem_date'] = fromsqldate($row['redeem_date']);
	$item['expire_date'] = fromsqldate($row['expire_date']);
	
	if (is_null($item['redeem_date']))
	{
		$item['status_color'] = "info";
		$item['status_text'] = "Disponível";
	}
	else
	{
		$item['status_color'] = "success";
		$item['status_text'] = "Ativo";
	}
	
	$coupons[] = $item;
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
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Painel do usuário</h3>
						<span class="pull-right">
						<!-- Tabs -->
							<ul class="nav panel-tabs">
								<li class="active"><a href="#perfil" data-toggle="tab">Perfil</a></li>
								<li><a href="#cupons" data-toggle="tab">Cupons</a></li>
								<li><a href="#faturas" data-toggle="tab">Faturas</a></li>
							</ul>
						</span>
					</div>
					<div class="panel-body">
						<div class="tab-content">
						<div class="tab-pane active" id="perfil">
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
												<td>Data de expiração:</td>
												<td>-</td>
											</tr>
											<tr>
												<td>Estado da conta</td>
												<td><?php print($account_status); ?></td>
											</tr>
											<tr>
												<td>Seu endereço</td>
												<td><a href="<?php print($url); ?>"><?php print($url_label); ?></a></td>
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
										<a href="<?php print($url); ?>" class="btn btn-lg btn-info"><span class="fa fa-globe jump-5"></span> Acessar meu site</a>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="faturas">
							Nenhuma fatura em sua conta.
						</div>
						<div class="tab-pane" id="cupons">
							<div class="row">
								<div class="span5">
									<?php if (count($coupons) > 0) { ?>
									<table class="table table-striped table-condensed">
										  <thead>
										  <tr>
											  <th>Cupom</th>
											  <th>Data de ativação</th>
											  <th>Expiração</th>
											  <th>Estado</th>
										  </tr>
									  </thead>   
									  <tbody>
										<?php foreach ($coupons as $item) { ?>
										<tr>
											<td><?php print($item['label']); ?></td>
											<td><?php print($item['redeem_date']); ?></td>
											<td><?php print($item['expire_date']); ?></td>
											<td><span class="label label-<?php print($item['status_color']); ?>"><?php print($item['status_text']); ?></span></td>
										</tr>
										<?php } ?>
									  </tbody>
									</table>
									<?php } else { ?>
									Nenhum cupom em sua conta.
									<?php } ?>
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
