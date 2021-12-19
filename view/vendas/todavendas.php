<?php 
            $total = 0;
            $totalCusto = 0;
            $totalLucro = 0;
            $vendidosHoje = 0;
            $totalCustoMes = 0;
            $totalLucroMes = 0;
            $mes = 0;
            $ano = 0;
            $totalDeVendasMes = 0;
            $tiketMedio = 0;
            $dataPesquisa;
            if(isset($_GET['dataPesquisa'])){
                $dataPesquisa = date($_GET['dataPesquisa']);
            }else{
                $dataPesquisa = date('Y-m-d');
            }

            
            require_once "../../classes/conexao.php";
            require_once "../../classes/vendas.php";
            $c= new conectar();
            $conexao=$c->conexao();

            $obj= new vendas();

            $sql="SELECT id_venda,
                        dataCompra,
                        id_cliente,
                        custo
                    from vendas group by id_venda";
            $result=mysqli_query($conexao,$sql); 
            $date = date('m/Y');

            $buscaId = $obj->criarComprovante();
            ?>
        <?php 
        ?>       
                
        <?php while($ver=mysqli_fetch_row($result)):
                        if (date("d/m/Y", strtotime($ver[1])) == date("d/m/Y", strtotime($dataPesquisa)) )  {
                            $vendidosHoje += $obj->obterTotal($ver[0]);
                        };
                        if (date("m/Y", strtotime($ver[1])) == date("m/Y", strtotime($dataPesquisa)) )  {
                            $mes += $obj->obterTotal($ver[0]);
                            $totalCustoMes += $obj->obterTotalCusto($ver[0]);
                            $totalLucroMes += $obj->obterTotal($ver[0]) - $obj->obterTotalCusto($ver[0]);
                        };
                        if (date("Y", strtotime($ver[1])) == date("Y", strtotime($dataPesquisa)) )  {
                            $ano += $obj->obterTotal($ver[0]);
                        };
                    ?>
                <?php endwhile; 
                    function verificaMeses($param){
                        while($ver=mysqli_fetch_row($result)):
                            if (date("m/Y", strtotime($ver[1])) == date("m/Y", strtotime($param)) )  {
                                echo `teste`;
                            };
                        endwhile; 
                        
                    }
                        ?>
             
            <?php 
            if($mes <= 0){
                echo 'Não existe produto vendido esse mes, para ter mais relatorios.
                <div id="ano">Vendidos/ano
                    <div> <h4>'.  number_format($ano, 2) . '  </h4></div>
                </div>
                    <center><button class="btn btn-primary" onclick="normal()">Volta ao normal</button></center>
                ';
            }else{
            include_once './vendidos.php';
            
                $obterprodMaisVendido = $obj->obterDadosProduto($maisVendido[0]);                 
                $obterprodmenosVendido = $obj->obterDadosProduto($menosVendido[0]);
                for($i=0;$i<count($maisVendido);$i++){
                    $totalDeVendasMes = $totalDeVendasMes + $somamaisVendidosMes[$i]['quant'];
                }
                $tiketMedio = ($mes / $totalDecompras);
            ?> 
        <div class="container">
            <div id="faturamento" style="overflow:auto;" >
                <div class="btn btn-danger" style="margin:5px;">
                    <h4> Escolha o mês </h4>
                    <Select onchange="alteraData()" id="mesEscolha" class="btn btn-danger">
                        <Option > <?php echo $dataPesquisa ?></Option>
                        <Option value="<?php echo date('Y/12/d') ?>"> Mês 12 </Option>
                        <Option value="<?php echo date('Y/11/d') ?>"> Mês 11 </Option>
                        <Option value="<?php echo date('Y/10/d') ?>"> Mês 10 </Option>
                        <Option value="<?php echo date('Y/9/d') ?>"> Mês 9 </Option>
                        <Option value="<?php echo date('Y/8/d') ?>"> Mês 8 </Option>
                        <Option value="<?php echo date('Y/7/d') ?>"> Mês 7 </Option>
                        <Option value="<?php echo date('Y/6/d') ?>"> Mês 6 </Option>
                        <Option value="<?php echo date('Y/5/d') ?>"> Mês 5 </Option>
                        <Option value="<?php echo date('Y/4/d') ?>"> Mês 4 </Option>
                        <Option value="<?php echo date('Y/3/d') ?>"> Mês 3 </Option>
                        <Option value="<?php echo date('Y/2/d') ?>"> Mês 2 </Option>
                        <Option value="<?php echo date('Y/1/d') ?>"> Mês 1 </Option>


                    </Select>
                </div>    
                    <div id="dia">Vendidos/Hoje 
                        <div> <h4> <?php echo "R$ " . number_format($vendidosHoje, 2);  ?> </h4></div>             
                    </div>
                    <div id="mes">Vendidos/mês
                        <div> <h4> <?php echo "R$ " . number_format($mes, 2);  ?> </h4></div>      
                    </div>
                    <div id="ticket">TicketMedio/mês
                        <div> <h4> R$  <?php echo  number_format($tiketMedio, 2);  ?> </h4></div>
                    </div>
                    <div id="ticket">Prod/Vendidos/mês:
                        <div> <h4> <?php echo  $totalDeVendasMes  ?> </h4></div>
                    </div>
                    <div id="ano">Vendidos/ano
                        <div> <h4> <?php echo "R$ " . number_format($ano, 2);  ?> </h4></div>
                    </div>
                </div>
                <div class="totalLucroCusto">
                    <div class="lucro">
                    <h4> Lucro liquido do mês</h4>
                     <h3><span > R$ <?php echo number_format($totalLucroMes, 2) ?> </span></h3>
                    </div>
                    <div class="custo">
                    <h4> Custo do mês</h4>
                        <h3><span > R$ <?php echo number_format($totalCustoMes, 2) ?> </span></h3>
                        </div>
                </div>

                
                <div id="relatorios" >
                    <div class="geralleft">
                        <div id="mais_menosVendido">
                            <div> <h4>O seu produto mais vendido/mes foi: <span style="color:orange"> <?php echo $obterprodMaisVendido['nome']; ?>  </span></h4></div>     
                            <div> <h4>E o seu produto menos vendido/mes foi: <span> <?php echo $obterprodmenosVendido['nome']; ?>  </span></h4></div>         
                        </div>
                        <button class="btn btn-success" onclick="($('#myModal').modal())">Relatorio Facil.</button>
                    </div>
                    <div class="geral">
                        <h6>Relatorio Mensal</h6>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Valor</th>
                                <th scope="col">Resultado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Vendidos nos mês:</th>
                                <td style="color:green">R$ <?php echo $mes; ?>, 00</td>
                            </tr>
                            <tr>
                                <th scope="row">Ticket Medio:</th>
                                <td style="color:green">R$  <?php echo  number_format($tiketMedio, 2);  ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Mais Vendido:</th>
                                <td ><span style="color:orange"> <?php echo $obterprodMaisVendido['nome']; ?> </td>
                            </tr>
                            <tr>
                                <th scope="row">Menos Vendido:</th>
                                <td ><span style="color:red"> <?php echo $obterprodmenosVendido['nome']; ?> </td>
                            </tr>
                            <tr>
                                <th scope="row">Total de produtos vendidos:</th>
                                <td ><span style="color:rgb(250, 19, 250)"> <?php echo $totalDeVendasMes; ?> Produtos </td>
                            </tr>
                        </tbody>
                        </table>        
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModal">Olá, Aqui vai um breve relato de como está seu mês. :)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    Até o momento, você teve um total de vendas que somam o valor de lucro bruto de
                           <span> R$ <number_format(?php echo $mes, 2) ?>, </span> neste periodo o custo que você teve com os produtos vendidos foi dê 
                           <span> R$ <?php echo number_format($totalCustoMes, 2) ?> </span> e o lucro liquido foi de: 
                           <span> R$ <?php echo number_format($totalLucroMes, 2) ?> </span>.
                            Atualmente o seu produto mais vendido é  <span style="color: orange"> <?php echo $obterprodMaisVendido['nome']; ?> </span> e o seu produto menos vendido foi 
                            <span style="color:blue"><?php echo $obterprodmenosVendido['nome']; ?><span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                    </div>
                </div>
                </div>
                <script>
                    $('#myModal').modal()
                </script>
                <?php } ?>

        </div>
        
