<?php
require "core.inc.php";

?>
<html>
	<head>
		<script type="text/javascript">
		function CloseAndRefresh() 
		{
			window.opener.location.href = window.opener.location.href;
			window.close();
		}
		</script>
	</head>
	<body onload="CloseAndRefresh(); ">
	</body>
</html>
