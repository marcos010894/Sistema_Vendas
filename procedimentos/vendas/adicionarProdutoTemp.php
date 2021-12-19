<?php 
	session_start();
	require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();

	$idcliente=1;
	$idproduto=$_POST['produtoVenda'];
	$descricao=$_POST['descricaoV'];
	$quantidade=$_POST['quantidadeV'];
	$quantV=$_POST['quantV'];
	$preco=$_POST['precoV'];
	$custo=$_POST['custoV'];






	$sql="SELECT nome 
			from produtos
			where id_produto='$idproduto'";
	$result=mysqli_query($conexao,$sql);

	$nomeproduto=mysqli_fetch_row($result)[0];

	$produto=$idproduto."||".
				$nomeproduto."||".
				$descricao."||".
				$preco."||".
				$ncliente."||".
				$quantidade."||".
				$quantV."||".
				$quantV * $preco."||".
				$idcliente."||".
				$quantV * $custo;

	$_SESSION['tabelaComprasTemp'][]=$produto;




	//ATUALIZAÇÃO DO ESTOQUE - FEITO NO FINAL DO CURSO
	$quantNova = $quantidade - $quantV;
	$sqlU = "UPDATE produtos SET quantidade = '$quantNova' where id_produto = '$idproduto' ";
		mysqli_query($conexao,$sqlU);

 ?>