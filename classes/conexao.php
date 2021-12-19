<?php 
	const conection = "PROD";
	
	if ( conection == "PROD" ){	
		class conectar{

			private $servidor = "localhost";
			private $usuario = "root";
			private $senha = "";
			private $bd = "db_bar";
		
			public function conexao(){
				$conexao = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->bd);
				
				return $conexao;
			}
		}
	}elseif(conection == "LOCAL"){
		class conectar{

			private $servidor = "localhost";
			private $usuario = "root";
			private $senha = "";
			private $bd = "hotelb82_clayton";
		
			public function conexao(){
				$conexao = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->bd);				
				return $conexao;
			}
		}
	}




 ?>