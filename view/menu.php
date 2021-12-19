
<?php require_once "dependencias.php" ?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

  <!-- Begin Navbar -->
  <div id="nav">
    <div class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="100">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">

            <li class="active"><a href="inicio.php"><span class="glyphicon glyphicon-home"></span> Inicio</a>
            </li>
            <li class=""> <a href="graficos.php"></span><span class="glyphicon glyphicon-book"></span> Graficos</a>
            </li>

            
            <li class=""> <a href="clientes.php"></span><span class="glyphicon glyphicon-user"></span> Clientes</a>
            </li>
            
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Gestão Produtos <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="categorias.php">Categorias</a></li>
              <li><a href="produtos.php">Produtos</a></li>
            </ul>
          </li>


         
          <li><a href="vendas.php"><span class="glyphicon glyphicon-usd"></span> Vender</a>
          </li>

          <li class="dropdown" >
            <a href="#" style="color: red"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Usuario:   <span class="caret"></span></a>
            <ul class="dropdown-menu">


              <?php if($_SESSION['usuario'] == "admin"): ?>
            <li> <a href="usuarios.php"><span class="glyphicon glyphicon-off"></span> Gestão Usuários</a></li>
          <?php endif; ?>

              <li> <a style="color: red" href="../procedimentos/sair.php"><span class="glyphicon glyphicon-off"></span> Sair</a></li>
              
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.contatiner -->
  </div>
</div>
<!-- Main jumbotron for a primary marketing message or call to action -->


<div class="modal fade" id="adcservico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Editar Produto</h4>
					</div>
					<div class="modal-body">
          <form action="" id="frmAdcServices"> 
            <label for="">Nome do serviço</label>
            <input type="text" class="form-control input-sm" id="descricao" name="nome" >
            <label for="">Descrição do serviço</label>
            <input type="text-area" class="form-control input-sm" id="descricao" name="descricao" >
            <label for="">Preço</label>
            <input type="number" class="form-control input-sm" id="descricao" name="preco" ><br>
          </form>
					</div>
					<div class="modal-footer">
						<button id="adcService" type="button" class="btn btn-warning" data-dismiss="modal">Registrar</button>
					</div>
				</div>
			</div>
		</div>


<!-- /container -->        


</body>
</html>

<script type="text/javascript">
			$('#adcService').click(function(){

        vazios=validarFormVazio('frmAdcServices');

        if(vazios > 0){
          alertify.alert("Preencha todos os campos!!");
          return false;
        }

        var formData = new FormData(document.getElementById("frmAdcServices"));

        $.ajax({
          url: "../procedimentos/produtos/inserirProdutos.php",
          type: "post",
          dataType: "html",
          data: formData,
          cache: false,
          contentType: false,
          processData: false,

          success:function(r){
            
            if(r == 1){
              $('#frmProdutos')[0].reset();
              $('#tabelaProdutosLoad').load("produtos/tabelaProdutos.php");
              alertify.success("Adicionado com sucesso!!");
            }else{
              alertify.error("Falha ao Adicionar");
            }
          }
        });

        });
</script>