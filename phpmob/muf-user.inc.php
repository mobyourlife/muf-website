<?php

/* Verifica se o usuário está autenticado. */
if (isset($fb_profile))
{
	/* Conecta-se ao banco de dados. */
	$db = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password);
	mysqli_select_db($db, $mysql_database);

	/* Verifica se o usuário está cadastrado. */
	$sql = sprintf("SELECT 1 FROM mobface_facebookuser WHERE fb_uid = %d;", $fb_profile->getProperty('id'));
	$res = mysqli_query($db, $sql);
	$muf_registered = (mysqli_num_rows($res) == 1) ? true : false;

	/* Fecha a conexão com o banco de dados. */
	mysqli_close($db);
}

?>
