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
        <h1>Dúvidas frequentes</h1>
        <p>Esclareça algumas dúvidas frequentes nesta página. Caso a sua dúvida não esteja listada, contate o suporte técnico!</p>
		<p><a href="<?php printlink("suporte-tecnico"); ?>" class="btn btn-jumbo btn-lg"><span class="glyphicon glyphicon-envelope"></span> Suporte Técnico</a></p>
      </div>
    </div>

    <div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-lg-4">
				<div class="box">							
					<div class="icon">
						<div class="image"><i class="fa fa-thumbs-o-up"></i></div>
						<div class="info">
							<h3 class="title">O que?</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in lobortis nisl, vitae iaculis sapien. Phasellus ultrices gravida massa luctus ornare. Suspendisse blandit quam elit, eu imperdiet neque semper.</p>
							<div class="more">
								<a href="#" title="Veja o que é o Mob Your Life">Saiba mais <i class="fa fa-angle-double-right"></i></a>
							</div>
						</div>
					</div>
					<div class="space"></div>
				</div> 
			</div>
				
			<div class="col-xs-12 col-sm-6 col-lg-4">
				<div class="box">							
					<div class="icon">
						<div class="image"><i class="fa fa-flag"></i></div>
						<div class="info">
							<h3 class="title">Por que?</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in lobortis nisl, vitae iaculis sapien. Phasellus ultrices gravida massa luctus ornare. Suspendisse blandit quam elit, eu imperdiet neque semper.</p>
							<div class="more">
								<a href="#" title="Entenda por que o Mob Your Life foi criado">Saiba mais <i class="fa fa-angle-double-right"></i></a>
							</div>
						</div>
					</div>
					<div class="space"></div>
				</div> 
			</div>
				
			<div class="col-xs-12 col-sm-6 col-lg-4">
				<div class="box">							
					<div class="icon">
						<div class="image"><i class="fa fa-desktop"></i></div>
						<div class="info">
							<h3 class="title">Como?</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in lobortis nisl, vitae iaculis sapien. Phasellus ultrices gravida massa luctus ornare. Suspendisse blandit quam elit, eu imperdiet neque semper.</p>
							<div class="more">
								<a href="#" title="Saiba como o Mob Your Life funciona">Saiba mais <i class="fa fa-angle-double-right"></i></a>
							</div>
						</div>
					</div>
					<div class="space"></div>
				</div>
			</div>
		</div>
	</div>
	
	<?php require "footer.inc.php"; ?>
  </body>
</html>
