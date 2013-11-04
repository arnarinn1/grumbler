<!doctype html>
<html>
	<head>
		<title>Grumpy</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="css" href="../css/bootstrap.css">
	</head>
	<body>

<?php
	
	require_once("data_access/db_util.php");

	$db = new DbUtil();

	$db->GetMessages();

?>
	
	</body>
</html>