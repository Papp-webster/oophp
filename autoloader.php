<?php

function autoload($className)
{
	$classPath = strtr(__DIR__ ."/controller/". $className.".php", "/\\", DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR);
	if(file_exists($classPath)) {
		require_once $classPath;
	}
	
}

spl_autoload_register('autoload');