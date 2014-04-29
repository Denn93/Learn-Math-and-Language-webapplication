<?php
/**
 * class class
 *
 * Description for class Config
 *
 * @author: Dennis
*/

class Config
{
	public static $config = array();
	
	static function init()
	{
		Config::$config['odbcString'] = 'mysql:dbname=dbname;host=localhost';
		Config::$config['dbUser'] = 'username';
		Config::$config['dbPass'] = 'passwrod';
                
        Config::$config['ENVIREMONT'] = 'PRODUCTION';
	}
}
?>