<?php
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";
    include "../../back/results/calculos.php";

    /*Tabela inteligente*/
    if(isset($_GET['pesq']))
    {
        $tipo_pesq = $_GET['pesq'];
    }
    else
    {
        $tipo_pesq = 1;
    }

    $id_proj = array();
    $projetos = array();
    $var = array();
    $aux_id = 0;
    $aux = 0;
    $tipo = "";
    $oq = "";

    $sql = "SELECT * FROM projeto WHERE empresa = ".$id_empresa;
    $resultado = mysqli_query($conecta, $sql);
    $qtde = mysqli_num_rows($resultado);

    if($qtde > 0)
    {
        for($cont=0; $cont < $qtde; $cont++)
        {
            $linha=mysqli_fetch_array($resultado);
            $projetos[$cont] = $linha['descricao'];
        }
    }

    if($tipo_pesq == 1){
        $tipo = "string";
        $oq = "Profissional";
        $sql = "SELECT projeto.*, profissional.nome
        FROM projeto
        INNER JOIN profissional ON projeto.responsavel = profissional.id_profissional AND projeto.empresa = ".$id_empresa;
        $resultado = mysqli_query($conecta, $sql);
        $qtde = mysqli_num_rows($resultado);
        if($qtde > 0)
        {
            for($cont=0; $cont < $qtde; $cont++)
            {
                $linha=mysqli_fetch_array($resultado);
                $var[$cont] = $linha['nome'];
            }
        }
    }else if($tipo_pesq == 2){
        $tipo = "number";
        $oq = "Mudanças";
        $sql = "SELECT projeto.*, mudancas.*
        FROM projeto
        INNER JOIN mudancas ON projeto.id_projeto = mudancas.projeto AND projeto.empresa = ".$id_empresa;
        $resultado = mysqli_query($conecta, $sql);
        $qtde = mysqli_num_rows($resultado);
        if($qtde > 0)
        {
            for($cont=0; $cont < $qtde; $cont++)
            {
                $linha=mysqli_fetch_array($resultado);
                if($linha['id_projeto'] == $aux_id){
                    $aux++;
                }else{
                    $var[$aux_id] = $aux;
                    $aux_id++;
                    $aux = 1;
                }
            }
        }
    }else{
        $tipo = "number";
        $oq = "Requisitos";
        $sql = "SELECT projeto.*, requisitos.*
        FROM projeto
        INNER JOIN requisitos ON projeto.id_projeto = requisitos.projeto AND projeto.empresa = ".$id_empresa;
        $resultado = mysqli_query($conecta, $sql);
        $qtde = mysqli_num_rows($resultado);
        if($qtde > 0)
        {
            for($cont=0; $cont < $qtde; $cont++)
            {
                $linha=mysqli_fetch_array($resultado);
                if($linha['id_projeto'] == $aux_id){
                    $aux++;
                }else{
                    $var[$aux_id] = $aux;
                    $aux_id++;
                    $aux = 1;
                }
            }
        }
    }

    ksort($projetos);
    ksort($var);
?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <link rel="stylesheet" href="../../styles/projetos/menu.css">
        <link rel="stylesheet" href="../../styles/results/resultados.css">

        <!--Gráficos..............................................................................................................-->
        <!--Consumo antes e depois............................................................................................-->
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                    ['Ano', 'Antes', 'Depois'],
                        <?php
                            for($x3=0; $x3 < count($conano); $x3++){
                                print_r("['".$conano[$x3]."', ".$conant[$x3].", ".$condep[$x3]."],");
                            }
                        ?>
                    ]);

                    var options = {
                    title: 'Consumo antes e depois da implementação da smart-grid.',
                    curveType: 'function',
                    legend: { position: 'bottom' }
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('chart_div1'));

                    chart.draw(data, options);
                }
            </script>
        <!--Gasto por projeto..............................................................................................................-->
        <script>    
            google.charts.load('current', {packages: ['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawMaterial);

            function drawMaterial() {
                var data = google.visualization.arrayToDataTable([
                    ['Projeto', 'Orçamento', 'Custo'],
                    <?php
                        for($x3=0; $x3 < $ind_proj; $x3++){
                            print_r("['".$projeto[$x3]."', ".$orcamento[$x3].", ".$custo[$x3]."],");
                        }
                    ?>
                ]);

                var materialOptions = {
                    chart: {
                    title: 'Custo final de cada projeto'
                    },
                    hAxis: {
                    title: 'Valor',
                    minValue: 0,
                    },
                    vAxis: {
                    title: 'Projeto'
                    },
                    bars: 'hotizontal'
                };
                var materialChart = new google.charts.Bar(document.getElementById('column'));
                materialChart.draw(data, materialOptions);
            }
        </script>
        <!--Consumo por equipamento média..............................................................................................................-->
            <script type="text/javascript">

                // Load the Visualization API and the corechart package.
                google.charts.load('current', {'packages':['corechart']});

                // Set a callback to run when the Google Visualization API is loaded.
                google.charts.setOnLoadCallback(drawChart);

                // Callback that creates and populates a data table,
                // instantiates the pie chart, passes in the data and
                // draws it.
                function drawChart() {

                    // Create the data table.
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Topping');
                    data.addColumn('number', 'Slices');
                    data.addRows([
                        <?php
                            for($x3=0; $x3 < $ind_conequip; $x3++){
                                print_r("['".$equipamento[$x3]."', ".$auxcon[$x3]."],");
                            }
                        ?>
                    ]);

                    // Set chart options
                    var options = {'title':'Média de consumo por equipamento em <?php echo $mesconpequip."/".$auxconpequip;?>',
                                pieSliceText: 'none',
                                'width': 700,
                                'height':600};

                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.PieChart(document.getElementById('chart_div3'));
                    chart.draw(data, options);
                }
            </script>
        <!--Tabela inteligente..............................................................................................................-->
            <script type="text/javascript">
                google.charts.load('current', {'packages':['table']});
                google.charts.setOnLoadCallback(drawTable);

                function drawTable() {
                    var data = google.visualization.arrayToDataTable([
                        ['Projetos', '<?php echo $oq;?>'],
                        <?php
                            for($x3=0; $x3 < count($projetos); $x3++){
                                print_r("['".$projetos[$x3]."', '".$var[$x3]."'],");
                            }
                        ?>
                    ]);

                    var table = new google.visualization.Table(document.getElementById('tabela'));

                    table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
                }
            </script>
        <title>Smart Grid</title>
    </head>

    <body onclick="verifica()" onload="verifica()">

        <div class="tudo">

        <div class="aba">
                <div class="logo">
                    <a href="../../front/projetos/menu.php"><img src="../../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                    <h2 class="nav-text">Smart Grids</h2>
                </div>
                <ul>
                    <li class="navitem"><a href="../empresa/empresa.php"><i class="fas fa-city"></i><span class="nav-text">Empresa</span></a></li>
                    <li class="navitem"><a href="../projetos/menu.php?pagina=1"><i class="fas fa-stream"></i><span class="nav-text">Projetos</span></a></li>
                    <li class="navitem"><a href="../funcs/funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                    <li class="navitem"><a href="../equip/equipamentos.php"><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                    <li class="navitem"><a href="../controle/controle.php"><i class="fas fa-cogs"></i><span class="nav-text">Consumo</span></a></li>
                    <li class="pag navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

        <div class="conteudo">
                <a href="../../back/results/gerar_relatorio.php"><p class="ir">Gerar PDF das estatísticas&#8594;</p></a>
                <h1>Análise dos dados</h1>
                <center>
                    <p>Tabela/gráfico inteligente (o usuário define os dados q quer ver na tabela/gráfico)</p>
                </center>

                <div class="graficos">
                    <div id="chart_div1"></div>
                    <center>
                        <div id="chart_div3"></div>
                    </center>
                    <div id="column"></div>

                    <select name="pesq" onchange="reloadWithParam()" id="pesq">
                        <option value="1" <?php if($tipo_pesq == 1) echo "selected"?>>Profissional</option>
                        <option value="2" <?php if($tipo_pesq == 2) echo "selected"?>>Mudança</option>
                        <option value="3" <?php if($tipo_pesq == 3) echo "selected"?>>Requisitos</option>
                    </select>
                    <script>
                        function reloadWithParam(){
                            var d = document.getElementById("pesq").value;
                            window.location.href="resultados.php?pesq=" + d;
                        }
                    </script>
                    <div id="tabela"></div>

                    
                </div>
            </div>
        </div>
    </body>
</html>
