<?php
	$dbHost="localhost";
	$dbName="test";
	$dbLog="titi1";
	$dbPass="tortue";
	$bdd = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbLog, $dbPass);
?>