<?php 
session_start();
if(isset($_SESSION['usuario'])){

?>

<!DOCTYPE html>
<html>
<head>
	<title>Graficos</title>
	<?php require_once "menu.php" ?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>


<div id="vendasFeitas"></div>


</body>
</html>


<script type="text/javascript">
		$(document).ready(function(){
				$('#vendasFeitas').load('vendas/todavendas.php');
				$('#vendasFeitas').show();				
		});
		function normal(){
			$(document).ready(function(){
				$('#vendasFeitas').load('vendas/todavendas.php' );
				$('#vendasFeitas').show();				
			});	
		}
		function alteraData(parm){
			$(document).ready(function(){
				console.log(document.getElementById('mesEscolha').value)
				
				$('#vendasFeitas').load('vendas/todavendas.php?dataPesquisa=' + document.getElementById('mesEscolha').value );
				$('#vendasFeitas').show();				
			});	
		}
</script>

<?php 
	}else{
		header("location:../index.php");
	}
 ?>

