<?php

	ini_set('display_errors', '1');
	error_reporting(E_ALL | E_STRICT);

	require_once('config.php');
	
	$title = (string)$_GET['titleid'];
	
	//$title = utf8_encode($title);
	//echo $title;
	
	$sql1 = "SELECT participants FROM Speech WHERE Speech.id='".$title."'";
	
	$participants = mysqli_query($connection, $sql1);
	
	while ($row = mysqli_fetch_array($participants)){
		$part = (int)$row[0];
		$part = $part+1;
		$sql = "UPDATE Speech SET participants = '".$part."' WHERE Speech.id='".$title."'";
		$result = mysqli_query($connection, $sql);
	}

	
	
	if((string)$_COOKIE['title'] == ""){
		$_COOKIE['title'] = $title;
		setcookie('title', $title, strtotime("+1 month"));
	}else{
		$cookie = (string)$_COOKIE['title'];
		$list = $cookie.','.$title;
		$_COOKIE['title'] = $list;
		setcookie('title', $list, strtotime("+1 month"));
	}
	
	header("Location: ../frontend/index.php#veranstaltungen");
	exit();
	
	
	//----------
	//UPDATE Speech SET participants = '0' WHERE title LIKE 'ErÃ¶ffnung%';
	//SELECT participants FROM Speech WHERE title LIKE 'ErÃ¶ffnung%';
	
?>

	

	
