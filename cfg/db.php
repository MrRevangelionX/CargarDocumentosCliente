<?php
	$host 	  = '192.168.21.2';	
	$user     = 'sr2008';
	$passwd   = '2008';	
	$database = 'negocios_docs';
	
	global $conexion;
	$conexion = new PDO("sqlsrv:server=$host;database=$database", $user, $passwd);
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	function Query($query){
		global $conexion;
		if ($resultSet = $conexion->query($query)) {
			return $resultSet;
		}
		else{
			return false;
		}
	}

	function countQuery($query){
		$data = Query($query);	
		$i = 0;
		foreach ($data as $row) {
			$i++;
		}
		return $i; 
	}