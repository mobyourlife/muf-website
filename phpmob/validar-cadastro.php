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
		if (strlen($full_name) != 0)
		{
			if ($account_type == "profile")
			{
				$account_id = $fb_profile->getProperty('id');
			}
			
			if (isset($account_type) && isset($account_id))
			{
				/* Conecta-se ao banco de dados. */
				$db = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password);
				mysqli_select_db($db, $mysql_database);
				
				/* Executa o comando no banco de dados. */
				$sql = sprintf("INSERT INTO mob_fb_page_admins (fb_uid, fb_pgid, account_status) VALUES (%s, %s, %d) ON DUPLICATE KEY UPDATE fb_pgid = fb_pgid;"
								, $fb_profile->getProperty('id'), $account_id, 0);
				mysqli_query($db, $sql);
	
				/* Consulta se esta conta do Facebook foi no serviço com sucesso. */
				$sql = sprintf("SELECT 1 FROM mob_fb_page_admins WHERE fb_pgid = %s;", $fb_profile->getProperty('id'));
				$res = mysqli_query($db, $sql);
				$_SESSION['MUF_REGISTERED'] = (mysqli_num_rows($res) == 1) ? true : false;
				
				/* Fecha a conexão com o banco de dados. */
				mysqli_close($db);
				
				/* Redireciona para a página de pagamento. */
				header("Location: " . $website_root . "/efetuar-pagamento");
			}
		}
	}
	
	/* Gera novos nomes de formulário. */
	$form_names = $csrf->form_names(array('full_name', 'account_type', 'account_id'), true);
	
	/* Retorna para a página de cadastro. */
	header("Location: " . $website_root . "/confirmar-cadastro");
}

?>