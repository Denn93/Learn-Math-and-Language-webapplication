<?php

/**
 * class class
 *
 * Description for class Database
 *
 * @author: Dennis
*/
try{
	$pdo = new PDO(Config::$config['odbcString'], Config::$config['dbUser'], Config::$config['dbPass']);
	}
catch (PDOException $e)
	{
		echo "test";
	echo $e->getMessage();		
	}

?>