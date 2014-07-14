<div class="navbar navbar-muf navbar-fixed-top" role="navigation">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="<?php printlink(); ?>"><img src="<?php printlink("img/logo.png"); ?>" alt="Mob Your Face"/></a>
	  <ul class="nav navbar-nav">
		<li class="active"><a href="<?php printlink("como-funciona"); ?>">Como Funciona</a></li>
		<li><a href="<?php printlink("duvidas-frequentes"); ?>">Dúvidas Frequentes</a></li>
		<li><a href="<?php printlink("precos"); ?>">Preços</a></li>
		<li><a href="<?php printlink("suporte-tecnico"); ?>">Suporte Técnico</a></li>
		<li><a href="<?php printlink("contato"); ?>">Contato</a></li>
      </ul>
	</div>
	
	<div class="navbar-collapse collapse">
	  <form method="post" action="<?php print(isset($fb_loginurl) ? $fb_loginurl : "."); ?>" class="navbar-form navbar-right" role="form">
		<?php if (isset($fb_profile)) { ?>
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			<span class="glyphicon glyphicon-user"></span> <?php print($fb_profile->getProperty('name')); ?> <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu">
			<li><a href="<?php printlink("meu-perfil"); ?>">Meu perfil</a></li>
			<li class="divider"></li>
			<li><a href="<?php printlink("sair"); ?>">Sair</a></li>
		  </ul>
		</div>
		<?php } else { ?>
		<a href="<?php printlink("login-social"); ?>" class="btn btn-primary">Entrar</a>
		<a href="<?php printlink("login-social"); ?>" class="btn btn-primary">Cadastrar</a>
		<?php } ?>
	  </form>
	</div><!--/.navbar-collapse -->
  </div>
</div>