<?php
require_once "core.inc.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
  <?php include("header.inc.php"); ?>
  <body>

    <?php require "navbar.inc.php"; ?>

    <div class="jumbotron">
      <div class="container">
        <h1>Preços</h1>
        <p>Além da facilidade proporcionada pelo Mob Your Face, nós também temos preços campeões!</p>
      </div>
    </div>

    <div class="container center">
		<div class="row">
			<div class="col-md-4 col-md-offset-2">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="text-center">PRIMEIRO ANO</h4>
					</div>
					<div class="panel-body text-center">
						<p class="lead">
							<strong>12 x R$ 99,90</strong><em>*</em></p>
					</div>
					<ul class="list-group list-group-flush text-center">
						<li class="list-group-item"><i class="icon-ok text-danger"></i>Uso pessoal e profissional</li>
						<li class="list-group-item"><i class="icon-ok text-danger"></i>Atualizações ilimitadas</li>
						<li class="list-group-item"><i class="icon-ok text-danger"></i>Suporte técnico especializado</li>
					</ul>
					<div class="panel-footer">
						<a class="btn btn-lg btn-block btn-primary" href=".">COMPRE AGORA!</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h4 class="text-center">SEGUNDO ANO EM DIANTE</h4>
					</div>
					<div class="panel-body text-center">
						<p class="lead">
							<strong>R$ 59,90 / ano</strong></p>
					</div>
					<ul class="list-group list-group-flush text-center">
						<li class="list-group-item"><i class="icon-ok text-danger"></i>Uso pessoal e profissional</li>
						<li class="list-group-item"><i class="icon-ok text-danger"></i>Atualizações ilimitadas</li>
						<li class="list-group-item"><i class="icon-ok text-danger"></i>Suporte técnico especializado</li>
					</ul>
					<div class="panel-footer">
						<a class="btn btn-lg btn-block btn-info" href=".">RENOVE AGORA!</a>
					</div>
				</div>
			</div>
		</div>
		
		<div>
			<p>
				Compre o seu site por apenas 12 parcelas de R$ 99,90 com direito a atualizações ilimitadas! Use o seu site para fins pessoais ou profissionais.<br/>
				A partir do segundo ano, pague apenas a taxa de manutenção de R$ 59,90 por ano!
			</p>
		</div>
		
		<div class="notice">
			<span class="label label-primary">* O preço à vista para o primeiro ano é de R$ 999,90 e pode ser parcelado em até 12 vezes com juros.</span>
		</div>
		</p>
	</div>
	
	<?php require "footer.inc.php"; ?>
  </body>
</html>
