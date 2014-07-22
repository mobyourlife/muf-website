<?php

/* Verifica se o usuário acabou de ser autenticado. */
if (isset($_SESSION['FB_SESSION']))
{
	if (isset($_SESSION['FB_PROFILE']))
	{
		$fb_profile = unserialize($_SESSION['FB_PROFILE']);
		
		if (!$fb_profile)
		{
			unset($fb_profile);
		}
	}
	
	if (!isset($fb_profile))
	{
		$fb_profile = get_profile();
		$_SESSION['FB_PROFILE'] = serialize($fb_profile);
	}
}

$fb_registered = (isset($_SESSION['MUF_REGISTERED']) ? $_SESSION['MUF_REGISTERED'] : false);
$fb_pending_payment = true;

/* Verifica se o usuário está autenticado. */
if (isset($fb_profile))
{
	/* Conecta-se ao banco de dados. */
	$db = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password);
	mysqli_select_db($db, $mysql_database);
	
	/* Armazena o log de atividade do usuário. */
	if (!isset($_SESSION['FB_JOURNAL']))
	{
		/* Verifica se o usuário já está conectado. */
		$sql = sprintf("SELECT 1 FROM mob_fb_accounts WHERE fb_uid = %s;", $fb_profile->getProperty('id'));
		$res = mysqli_query($db, $sql);
		
		/* Se foi a primeira conexão com o Facebook, o cadastra no banco de dados. */
		if (mysqli_num_rows($res) == 0)
		{
			$sql = sprintf("INSERT INTO mob_fb_accounts (fb_uid, first_login, last_login, login_count, is_fanpage) VALUES (%s, '%s', '%s', %d, %d);"
						, $fb_profile->getProperty('id'), mobdate(), mobdate(), 1, 0);
			mysqli_query($db, $sql);
		}
		/* Se estiver conectado, incrementa o contador de logins. */
		else
		{
			$sql = sprintf("UPDATE mob_fb_accounts SET last_login = '%s', login_count = login_count + 1 WHERE fb_uid = %s;"
						, mobdate(), $fb_profile->getProperty('id'));
			mysqli_query($db, $sql);
		}
		
		/* Define o código da sessão no journal. */
		$_SESSION['FB_JOURNAL'] = time();
	}
	
	/* Registra a atividade do usuário no journal. */
	$sql = sprintf("INSERT INTO mob_fb_login_journal (fb_uid, session_id, logged_in, hits, last_activity) VALUES (%s, %d, '%s', %d, '%s') ON DUPLICATE KEY UPDATE hits = hits + 1, last_activity = '%s';"
					, $fb_profile->getProperty('id'), $_SESSION['FB_JOURNAL'], mobdate(), 1, mobdate(), mobdate());
	mysqli_query($db, $sql);
	
	/* Consulta se esta conta do Facebook já está cadastrada no serviço. */
	$sql = sprintf("SELECT 1 FROM mob_fb_page_admins WHERE fb_uid = %s;", $fb_profile->getProperty('id'));
	$res = mysqli_query($db, $sql);
	$_SESSION['MUF_REGISTERED'] = (mysqli_num_rows($res) == 1) ? true : false;

	/* Fecha a conexão com o banco de dados. */
	mysqli_close($db);
}

?>
