<html lang="pt-br">
    <head> 
        <meta charset="utf-8">
        <link rel="icon" href="favicon.ico">
        <title>Clientes</title> 
		<link rel="shortcut icon" href="images/icone.ico">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    <?php
    
        require ('configuracoes.php');
    
        $vConexao = mysqli_connect($vServidor, $vUsuario, $vSenha, $vBase);

        if (isset($_COOKIE[$vCookieLogin]) and ($_COOKIE[$vCookieLogin]==0))
            {
             die('<h2 style="font-size: 36px; margin-top: 100px; text-align: center;"> Faça o login novamente<br> para continuar </h2><br><a style="position:absolute; top:190px; left: 930px" class="btn btn-default"href="index.html">OK</a>' . mysqli_error($vConexao));
            }
    
        else {
    
        if(!$vConexao)
            {
            die('Problemas na conexão: ' . mysqli_connect_error()); 
            }
    
            $vSql = 'SELECT id, nome, endereco, bairro, cidade, telefone
                     FROM clientes
                     WHERE id > 0';
    
            $vExecucao = mysqli_query($vConexao, $vSql);
    
            if(!$vExecucao)
                {
                die('Problema na execução do Código ' . mysqli_error($vConexao));
                }
    
            $vCont = mysqli_num_rows($vExecucao);
    
        }
        
    ?>
    
        <style>
            
              .container_modal {
                width: 600px;
                height: 500px;  
                border-radius: 10px;
                background-color: #d6d6d6;
                padding: 30px;
                }
            
            h2 {
                text-align: center;
                margin-top: 10px; 
                }
            
            .container {
                width: 90%;
                margin-top: 10px;
                margin-left: 30px;
                }
            
            thead {
                background-color: #d6d6d6;
                width: 100%;
                }
            
            #vFiltro {
                background-image: url('images/sistema/filtro.png');
                background-position: 0px 0px;
                background-repeat: no-repeat;
                width: 50%;
                font-size: 16px;
                padding: 12px 20px 12px 40px;
                border: 1px solid #333;
                margin-bottom: 10px;
                border-radius: 10px;
                }
            
            a {
                display: inline-block;
			    color: #333;
			    text-align: center;
			    padding: 12px 16px;
			    text-decoration: none;
                background-color: white;
                border-radius: 10px;
                border: 1px solid #333;
                font-family: Arial;
                font-size: 16px;
                }
            
            .a_nav {
                display: inline-block;
			    color: #d6d6d6;
			    text-align: center;
			    padding: 12px 16px;
			    text-decoration: none;
                background-color: transparent;
                border-radius: 10px;
                border: 2px solid #d6d6d6;
                font-family: Arial;
                font-size: 16px;
                position: absolute;
                right: 80px;
                top: 10px; 
            }
            
            .a_nav_msg {
                display: inline-block;
			    color: #d6d6d6;
			    text-align: center;
			    padding: 12px 16px;
			    text-decoration: none;
                background-color: transparent;
                border-radius: 10px;
                border: 2px solid #d6d6d6;
                font-family: Arial;
                font-size: 16px;
                position: absolute;
                right: 185px;
                top: 10px; 
            }
            
            .a_nav_sair {
                display: inline-block;
			    color: #f94848;
			    text-align: center;
			    padding: 12px 16px;
			    text-decoration: none;
                background-color: transparent;
                border-radius: 10px;
                border: 2px solid #f94848;
                font-family: Arial;
                font-size: 16px;
                position: absolute;
                right: 10px;
                top: 10px; 
                }
            
            a:hover  {
                 text-decoration: none;
			     background-color:#d6d6d6;
			     color: black;
                 opacity: 0.5;
			     }
            
            .a_nav_sair:hover  {
                 text-decoration: none;
			     background-color:#f94848;
			     color: black;
                 opacity: 0.5;
			     }
            
            th {
                text-align: left;
                cursor: pointer;
                }
            
            td {
                text-align: left;
                }
            
            .th_opcoes {
                cursor: default;
                }
            
            nav {
                background-color: #333;
                width: 100%;
                height: 70px;
                }
            
            img {
                position: absolute;
                margin-left:20px;
                margin-top: 8px;   
                }
            
            .div_table{
                margin-left: 30px;
                margin-right: 30px;
            }
        </style>
        
    </head>

    <body>
        
        <nav>
			<img src="images/logo.png">
            <a style="text-decoration:none" title="Ir para tabela serviços" class="a_nav" href="servico.php">Serviços</a>
            <a style="text-decoration:none" title="Ir para mensagens" class="a_nav_msg" href="mensagem.php">Mensagens</a>
            <a style="text-decoration:none" class="a_nav_sair" href="index.html">Sair</a>
		</nav>
        
        <div class="container">
            <h1>Clientes</h1><br>
            <?php echo '<h4>' . $vCont . ' Registros encontrados' . '</h4>'; ?>
            
            <input type="text" id="vFiltro" onkeyup="Filtrar()" placeholder="Filtre um nome" title="Filtre um nome">
        
            <a data-toggle="modal" href="#" data-target="#modal-cadastrar-cliente" style="text-decoration: none" class="btn-default"> Cadastrar </a>
            <a href="relatorio_clientes.php" style="text-decoration: none" class="btn-default"> Relatório </a>
            
            <div class="modal fade" id="modal-cadastrar-cliente" tabindex="-1" role="dialog" aria-labelledby="Modal-label-7">
			     <div class="modal-dialog" role="document">
                    <div class="container_modal">
                        <center><h2>Cadastrar cliente</h2></center>
                        <form method="post" action="clientes_inserir_executar.php">
                            <div class="form-group">
                                <label for="vNome">Nome:</label>
                                <input type="text" class="form-control" id="vNome" placeholder="Nome do cliente" name="vNome">
                            </div>

                            <div class="form-group">
                                <label for="vEndereco">Endereço:</label>
                                <input type="text" class="form-control" id="vEndereco" placeholder="Endereço do cliente" name="vEndereco">
                            </div>
                
                            <div class="form-group">
                                <label for="vBairro">Bairro:</label>
                                <input type="text" class="form-control" id="vBairro" placeholder="Bairro do cliente" name="vBairro">
                            </div>
                
                            <div class="form-group">
                                <label for="vCidade">Cidade:</label>
                                <input type="text" class="form-control" id="vCidade" placeholder="Cidade do cliente" name="vCidade">
                            </div>
                
                            <div class="form-group">
                                <label for="vTelefone">Telefone:</label>
                                <input type="text" class="form-control" id="vTelefone" placeholder="Telefone do cliente" name="vTelefone">
                            </div>
   
                            <div class="form-group">
                                <center>        
                                    <button class="btn btn-default" type="submit" name="vBotao" value="confirmar">Confirmar</button>
                                    <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                </center>
                            </div>
            
                        </form>
                    </div>
                    </div>
			</div>
		</div>
        <div class="table-responsive">
        <div class="div_table" >
            <table id="vTabela" class="table table-default">
        
                <thead>
                    <tr> 
                        <th onclick="Ordenar(0)">Nome</th>
                        <th onclick="Ordenar(1)">Endereço</th>
                        <th onclick="Ordenar(2)">Bairro</th>
                        <th onclick="Ordenar(3)">Cidade</th>
                        <th onclick="Ordenar(4)">Telefone</th>
                        <th class="th_opcoes"></th> 
                        <th class="th_opcoes"></th> 
                    </tr>
                </thead>
                
                <tbody> 
                    <?php
                        while ($vTabela = mysqli_fetch_array($vExecucao))
                            {          
                            echo '<tr>
                                    <td>' . utf8_encode($vTabela['nome']) . '</td>
                                    <td>' . utf8_encode($vTabela['endereco']) . '</td>
                                    <td>' . utf8_encode($vTabela['bairro']) . '</td> 
                                    <td>' . utf8_encode($vTabela['cidade']) . '</td>
                                    <td>' . utf8_encode($vTabela['telefone']) . '</td>
                                    
                                   <form method="post" action="clientes_editar.php">
                                        <td><button type="submit" title="Editar Registro" class="btn btn-default glyphicon glyphicon-pencil" id="vId" name="vId" value="' . $vTabela['id'] . '" ></button></td>
                                    </form>
                                    
                                   <form method="post" action="clientes_excluir.php">
                                        <td><button type="submit" title="Exluir Registro" class="btn btn-default glyphicon glyphicon-remove" id="vId" name="vId"  value="' . $vTabela['id'] . '"></button></td> 
                                    </form>';
                                    
                                '</tr>';      
                            };
                    
                        mysqli_close($vConexao);
                    ?>
                </tbody> 
             
            </table>
           
        </div>
        </div>
        
            <script>
                
                function Filtrar ()
                    {
                    var input, filter, table, tr, td, i;
                        input = document.getElementById("vFiltro");
                        filter = input.value.toUpperCase();
                        table = document.getElementById("vTabela");
                        tr = table.getElementsByTagName("tr");
		
                    
                    for (i = 0; i < tr.length; i++)
                            {
                            td = tr[i].getElementsByTagName ("td")[0]; 
                                if (td)
                                    {
                                    if (td.innerHTML.toUpperCase().indexOf(filter)>-1)
                                        {
                                        tr[i].style.display = "";    
                                        }
                                    else
                                        {
                                        tr[i].style.display = "none";
                                        }    
                                    }
                            }
                    }
                
                function Ordenar (n)
                    {
                    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;   
                        table = document.getElementById("vTabela");
                        switching = true;
                        dir = "asc";
                        
                        while (switching)
                            {
                            switching = false;
                            rows = table.rows;
                        
                            for (i = 1; i < (rows.length - 1); i++)
                                {
                                shouldSwitch = false;
                                x = rows[i].getElementsByTagName("td")[n];
                                y = rows[i + 1].getElementsByTagName("td")[n];
                                    
                                    if (dir == "asc")
                                        {
                                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase())
                                            {
                                            shouldSwitch = true;
                                            break;    
                                            }    
                                        }
                                    else if (dir == "desc")
                                        {
                                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase())
                                            {
                                            shouldSwitch = true;
                                            break;    
                                            }
                                        }
                                }
                                
                            if (shouldSwitch) 
                                {
                                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                                switching = true;
                                switchcount ++;      
                                } 
                            else
                                {
                                if (switchcount == 0 && dir =="asc")
                                    {
                                    dir = "desc";
                                    switching = true;    
                                    }
                                }
                            }
                    }
            </script>
        
        </div>
        
    </body>

</html>