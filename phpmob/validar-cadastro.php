<?php
require_once "core.inc.php";
require_once "csrf.inc.php";

/* Verificação de autorização. */
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

/* Proteção XSRF. */
$csrf = new csrf();

$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);
 
$form_names = $csrf->form_names(array('full_name', 'account_type', 'account_id'), false);

/* Verifica o retorno do formulário. */
if(isset($_POST[$form_names['full_name']], $_POST[$form_names['account_type']], $_POST[$form_names['account_id']]))
{
	/* Verifica a validade do token CSRF. */
	if($csrf->check_valid('post'))
	{
		/* Consulta os itens do formulário. */
		$full_name = $_POST[$form_names['full_name']];
		$account_type = $_POST[$form_names['account_type']];
		$account_id = $_POST[$form_names['account_id']];

		/* Cadastro o usuário como um site pendente. */
	}
	
	/* Gera novos nomes de formulário. */
	$form_names = $csrf->form_names(array('full_name', 'account_type', 'account_id'), true);
}

?>