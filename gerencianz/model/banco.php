<?php
	$conn = NULL;
	
	class Banco{
		public static function getConexao(){
			$servername = "127.0.0.1:3306";
			$database = "casofa";
			$username = "root";
			$password = "root";

			try{	
					if($GLOBALS['conn'])
						$GLOBALS['conn'] = NULL;
					$GLOBALS['conn'] = new PDO('mysql:host=' . $servername . ';dbname=' . $database, $username, $password);	
					//$GLOBALS['conn']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					return $GLOBALS['conn'];
			}catch(Exception $erro){
				echo 'Não foi possível conectar: '.$erro;
			}
			return NULL;
		}
	}
?>