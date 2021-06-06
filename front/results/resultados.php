<?php
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";
    include "../../back/results/calculos.php";
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
                    ['Year', 'Sales', 'Expenses'],
                    ['2004',  1000,      400],
                    ['2005',  1170,      460],
                    ['2006',  660,       1120],
                    ['2007',  1030,      540]
                    ]);

                    var options = {
                    title: 'Consumo antes e depois',
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
                    ['Projeto', 'Custo'],
                    ['New York City, NY', 8175000],
                    ['Los Angeles, CA', 3792000],
                    ['Chicago, IL', 2695000],
                    ['Houston, TX', 2099000],
                    ['Philadelphia, PA', 1526000]
                ]);

                var materialOptions = {
                    chart: {
                    title: 'Population of Largest U.S. Cities'
                    },
                    hAxis: {
                    title: 'Total Population',
                    minValue: 0,
                    },
                    vAxis: {
                    title: 'City'
                    },
                    bars: 'horizontal'
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
                    ['Mushrooms', 3],
                    ['Onions', 1],
                    ['Olives', 1],
                    ['Zucchini', 1],
                    ['Pepperoni', 2]
                    ]);

                    // Set chart options
                    var options = {'title':'Média de consumo por equipamento',
                                pieSliceText: 'none',
                                'width':400,
                                'height':300};

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
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Name');
                    data.addColumn('number', 'Salary');
                    data.addColumn('boolean', 'Full Time Employee');
                    data.addRows([
                    ['Mike',  {v: 10000, f: '$10,000'}, true],
                    ['Jim',   {v:8000,   f: '$8,000'},  false],
                    ['Alice', {v: 12500, f: '$12,500'}, true],
                    ['Bob',   {v: 7000,  f: '$7,000'},  true]
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
                    <p>Antes e depois - Consumo (gráfico de linhas com 3 linhas)</p><br>
                    <p>Consumo por equipamento (gráfico de pizza, pra ver quando cada equipamento gasta)</p><br>
                    <p>Gasto por projeto (gráfico de barras/pizza, pra ver quando foi gasto por projeto)</p><br>
                    <p>Tabela/gráfico inteligente (o usuário define os dados q quer ver na tabela/gráfico)</p>
                </center>

                <div class="graficos">
                    <div id="column"></div>
                </div>
                <!--
                <div class="graficos">
                    <div id="chart_div1"></div>
                    <div class="col-2">
                        <div id="chart_div2"></div>
                        <div id="chart_div3"></div>
                    </div>
                </div>
                <div class="tabela">
                    <div id="tabela"></div>
                </div>
                -->
            </div>
        </div>
    </body>
</html>
