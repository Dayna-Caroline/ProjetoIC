<?php
    require("../fpdf/fpdf.php");
    include "../conexao_local.php";

    $id_empresa = $_GET['id_empresa'];

    class PDF extends FPDF
    {
        function Header() {
            $this->Image('../../imgs/logo_pdf.JPG',15,10,50);
            $this->SetFont('Arial','b',10);
    
            $this->Cell(260,18,"Patrocinado pelo Conselho Nacional de Desenvolvimento",0,0,'C');
            $this->Cell(-260,26,"Iniciação Científica Ensino Médio (PIBIC-EM/CNPq)",0,0,'C');
            $this->Ln(40);
        }

        function Title() {

            $this->SetFont('Arial','b',20);
            
            $this->Ln(-15);
            $this->Cell(20);
            $this->Cell(150,15,"Relatório de resultados",0,0,'C');
           
            $this->SetFont('Arial','b',20);
                
            $this->Ln(10);
        }
        
        function ReceiptHeader($header, $title) {
            $this->SetFont('Arial','b',16);

            $this->Ln(10);
            $this->SetFillColor(255,255,255);
            $this->Cell(190, 15, $title, 0, 0, 'C', true);
            $this->Ln(17);

            // Header
            $this->Cell(20, 15, "", 0, 0, 'C', true);
            $this->SetFillColor(150,255,140);

            foreach($header as $column)
                $this->Cell(50, 8, $column, 1, 0, 'C', true);
            
            $this->Ln(8);
        }

        function ReceiptData($a, $b, $c) {
            $this->SetFont('Arial','',13);
            
            for($i=0; $i<count($a); $i++)
            {
                //Quebra pagina?
                if(($i%29) == 0 && $i != 0)
                {
                    $this->AddPage();
                    $this->Ln(26);
                }
                
                //Color
               
                $this->SetFillColor(255,255,255);
                $this->Cell(20, 8, "", 0, 0, 'C', true);
                $this->SetFillColor(255,255,255);
                

                $this->SetFont('Arial','b',11);
                $this->Cell(50, 8, $a[$i], 1, 0, 'C', true);
                $this->Cell(50, 8, $b[$i], 1, 0, 'C', true);
                $this->Cell(50, 8, $c[$i], 1, 0, 'C', true);

                
                $this->Ln();
            }
        }

        function ReceiptHeader2($header, $title) {
            $this->SetFont('Arial','b',16);

            $this->Ln(10);
            $this->SetFillColor(255,255,255);
            $this->Cell(190, 15, $title, 0, 0, 'C', true);
            $this->Ln(17);

            // Header
            $this->Cell(15, 15, "", 0, 0, 'C', true);
            $this->SetFillColor(150,255,140);

            foreach($header as $column)
                $this->Cell(80, 8, $column, 1, 0, 'C', true);
            
            $this->Ln(8);
        }

        function ReceiptData2($a, $b) {
            $this->SetFont('Arial','',13);
            
            for($i=0; $i<count($a); $i++)
            {
                //Quebra pagina?
                if(($i%29) == 0 && $i != 0)
                {
                    $this->AddPage();
                    $this->Ln(26);
                }
                
                //Color
                
                $this->SetFillColor(255,255,255);
                $this->Cell(15, 8, "", 0, 0, 'C', true);
                $this->SetFillColor(255,255,255);
                

                $this->SetFont('Arial','b',11);
                $this->Cell(80, 8, $a[$i], 1, 0, 'C', true);
                $this->Cell(80, 8, $b[$i], 1, 0, 'C', true);

                
                $this->Ln();
            }
        }

        function ReceiptHeader_prof($header, $title) {
            $this->SetFont('Arial','b',16);

            $this->Ln(10);
            $this->SetFillColor(255,255,255);
            $this->Cell(190, 15, $title, 0, 0, 'C', true);
            $this->Ln(17);

            // Header
            $this->Cell(15, 15, "", 0, 0, 'C', true);
            $this->SetFillColor(150,255,140);

            foreach($header as $column)
                $this->Cell(80, 8, $column, 1, 0, 'C', true);
            
            $this->Ln(8);
        }

        function ReceiptData_prof($a, $b) {
            $this->SetFont('Arial','',13);
            
            for($i=0; $i<count($a); $i++)
            {
                //Quebra pagina?
                if(($i%29) == 0 && $i != 0)
                {
                    $this->AddPage();
                    $this->Ln(26);
                }
                
                //Color
                
                $this->SetFillColor(255,255,255);
                $this->Cell(15, 8, "", 0, 0, 'C', true);
                $this->SetFillColor(255,255,255);
                

                $this->SetFont('Arial','b',11);
                $this->Cell(80, 8, $a[$i], 1, 0, 'C', true);
                $this->Cell(80, 8, $b[$i], 1, 0, 'C', true);

                
                $this->Ln();
            }
        }
    }

    /*----------------------------------------------------------------------------*/
    /*Gráfico Antes e depois consumo---------------------------------------------------------*/
        $conant = array();
        $condep = array();
        $conano = array();
        $auxantot = 0;
        $auxdeptot = 0;
        $auxpos = 0;
        $test = 0;
        $ind_equip = 0;

        $sql = "SELECT * FROM consumo WHERE empresa = ".$id_empresa." ORDER BY dia ASC";
        $resultado = mysqli_query($conecta, $sql);
        $qtde = mysqli_num_rows($resultado);
        if($qtde > 0)
        {
            $linha=mysqli_fetch_array($resultado);
            list($ano, $mes, $dia) = explode('-', $linha['dia']);         
            $conano[0] = $ano;
        }

        $sql = "SELECT * FROM consumo WHERE empresa = ".$id_empresa." ORDER BY dia ASC";
        $resultado = mysqli_query($conecta, $sql);
        $qtde = mysqli_num_rows($resultado);
        if($qtde > 0)
        {
            for($cont=0; $cont < $qtde; $cont++)
            {
                $linha=mysqli_fetch_array($resultado);
                list($ano, $mes, $dia) = explode('-', $linha['dia']);
                if($ano == $conano[$auxpos]){
                    if($linha['fase'] == 1){
                        $auxantot += $linha['consumo'];
                    }else{
                        $auxdeptot += $linha['consumo'];
                    }
                }else{                
                    $auxantot = 0;
                    $auxdeptot = 0;
                    $auxpos++;

                    $conano[$auxpos] = $ano;

                    if($linha['fase'] == 1){
                        $auxantot += $linha['consumo'];
                    }else{
                        $auxdeptot += $linha['consumo'];
                    }
                }
                $conant[$auxpos] = $auxantot;
                $condep[$auxpos] = $auxdeptot;
            }
        }

        ksort($conano); 
        ksort($conant);
        ksort($condep);
    /*Média de consumo no último ano---------------------------------------------------------*/
        $equipamento = array();
        $auxcon = array();
        $auxconpequip = 0;
        $mesconpequip = 0;
        $ind_conequip = 0;

        $sql1 = "SELECT * FROM consumo WHERE empresa = ".$id_empresa." ORDER BY dia DESC";
        $resultado = mysqli_query($conecta, $sql1);
        $qtde = mysqli_num_rows($resultado);
        if($qtde > 0)
        {
            $linha=mysqli_fetch_array($resultado);
            list($ano, $mes, $dia) = explode('-', $linha['dia']);         
            $auxconpequip = $ano;
            $mesconpequip = $mes;
        }

        $sql2 = "SELECT consumo.*, equipamentos.descricao
                FROM consumo
                INNER JOIN equipamentos ON consumo.equipamento = equipamentos.id_equipamento AND consumo.empresa = ".$id_empresa."
                ORDER BY dia DESC";
        $resultado = mysqli_query($conecta, $sql2);
        $qtde = mysqli_num_rows($resultado);


        if($qtde > 0)
        {
            for($cont1=0; $cont1 < $qtde; $cont1++)
            {
                $linha=mysqli_fetch_array($resultado);
                list($ano, $mes, $dia) = explode('-', $linha['dia']);
                if($ano == $auxconpequip && $mes == $mesconpequip){
                    $equipamento[$cont1] = $linha['descricao'];
                    $auxcon[$cont1] = $linha['consumo'];
                    $ind_conequip ++;
                }else{
                    break;
                } 
            }
        }
        ksort($equipamento);
        ksort($auxcon); 

    /*--------------------------------------------------------------------------------------------*/
    /*Gráfico Custo final projetos---------------------------------------------------------*/
        $projeto = array();
        $custo = array();
        $orcamento = array();
        $ind_proj = 0;

        $sql = "SELECT * FROM projeto WHERE empresa = ".$id_empresa;
        $resultado = mysqli_query($conecta, $sql);
        $qtde = mysqli_num_rows($resultado);

        if($qtde > 0)
        {
            for($cont=0; $cont < $qtde; $cont++)
            {
                $linha=mysqli_fetch_array($resultado);
                $projeto[$cont] = $linha['descricao'];
                $orcamento[$cont] = $linha['orcamento'];
                $custo[$cont] = $linha['c_final']; 
                $ind_proj ++;
            }
        }

        ksort($projeto);
        ksort($orcamento);
        ksort($custo);
    /*--------------------------------------------------------------------------------------------*/
    //Projetos e profissionais---------------------------------------------------------------------------
        $id_proj = array();
        $projetos = array();
        $var = array();

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
        ksort($projetos);
        ksort($var);

    //------------------------------------------------------------------------------------------------------------------------
    
    $table1 = ['Ano', 'S/ Smart-grid', 'C/ Smart-grid'];
    $table2 = ['Equipamento', 'Consumo (W)'];
    $table3 = ['Projeto', 'Orçamento', 'Custo final'];
    $table4 = ['Projeto', 'Profissional'];

    //PDF Initialization
    $pdf = new PDF();
    $pdf->AliasNbPages();

    //Intro
    $pdf->AddPage();
        $pdf->Title();
        $pdf->ReceiptHeader($table1, 'Consumo antes e depois da implementação da smart-grid.');
        $pdf->ReceiptData($conano, $conant, $condep);
        $pdf->ReceiptHeader2($table2, 'Média de consumo por equipamento no último mês.');
        $pdf->ReceiptData2($equipamento, $auxcon);
        $pdf->ReceiptHeader($table3, 'Orçamento e custo final por projeto.');
        $pdf->ReceiptData($projeto, $orcamento, $custo);
        $pdf->ReceiptHeader_prof($table4, 'Profissionais e projetos.');
        $pdf->ReceiptData_prof($projetos, $var);
    //Show
    $pdf->Output('I', 'Relatorio_SmartGrids.pdf');
?>