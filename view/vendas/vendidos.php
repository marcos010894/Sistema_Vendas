<?php 

            require_once "../../classes/conexao.php";
            require_once "../../classes/vendas.php";
            $c= new conectar();
            $conexao=$c->conexao();

            $obj= new vendas();

            $sql="SELECT id_produto,
                        dataCompra,
                        quantidade,
                        custo
                    from vendas";
            $result=mysqli_query($conexao,$sql); 
            $date = date('m/Y');
            $maisVendidosMes = [];
            $contador = 0;
            $totalDecompras = 0;
            ?>
                        
        <?php while($ver=mysqli_fetch_row($result)):   
                        if (date("m/Y", strtotime($ver[1])) == date("m/Y", strtotime($dataPesquisa)) )  {
                            array_push($maisVendidosMes,
                            [
                                'id_produto' => $ver[0],
                                'quantidade' => intval($ver[2]),
                            ]);
                        };
                        $totalDecompras += 1;
                    ?>
                <?php endwhile; 
                //dar um push apena para brekar o loop
                array_push($maisVendidosMes,
                [
                    'id_produto' => 'breakar',
                    'quantidade' => intval('50'),
                ]);                
                //dar um push apena para brekar o loop
                $contador = 0;
                $indice1 = $maisVendidosMes[0]['id_produto'];
                $somamaisVendidosMes = [];
                    for($i=0;$i<count($maisVendidosMes);$i++){
                        if($indice1 ===  $maisVendidosMes[$i]['id_produto'] or $maisVendidosMes[0]['id_produto'] === $maisVendidosMes[$i]['id_produto']){
                             $maisVendidosMes[0]['quantidade'] += $maisVendidosMes[$i]['quantidade'];
                        }else if($indice1 !=  $maisVendidosMes[$i]['id_produto']){
                            array_push($somamaisVendidosMes, [
                                'quant' => $maisVendidosMes[0]['quantidade'],
                                'id_prod' => $maisVendidosMes[0]['id_produto']
                            ]);
                            $maisVendidosMes[0] = $maisVendidosMes[$i];                       
                        }else{
                            echo '<br> OBS, Algum erro ocorreu <br>';
                        }                        
                    }      
                   

                    //Retorna o Menos vendido
                    
                    $menosVendido = [];
                    uasort($somamaisVendidosMes, function($a, $b){
                        return $a['quant'] >  $b['quant'];
                    });

                    foreach ($somamaisVendidosMes as $e){
                        array_push($menosVendido, $e['id_prod']); 
                    };
                    //FIM Retorna o Menos vendido                   

                    //Retorna o Mais vendido
                    $maisVendido = [];
                    uasort($somamaisVendidosMes, function($a, $b){
                        return $a['quant'] <  $b['quant'] ;
                    });

                    foreach ($somamaisVendidosMes as $e){
                        array_push($maisVendido, $e['id_prod']);
                    };
                    //FIM Retorna o Mais vendido
                ?>
                
        
