<?php
    require("../fpdf/fpdf.php");
    include "../conexao_local.php";

    class PDF extends FPDF
    {
        function Header() {
            $this->Image('../../imgs/logo_pdf.JPG',15,10,50);
            $this->Image('../../imgs/unesp_pdf.JPG',160,14,30);
            $this->Ln(40);
        }

        function rodape() {
            $this->SetY(260);
            
            $this->Cell(68);
            $this->SetFont('Arial','i',11);
            date_default_timezone_set("America/Sao_Paulo");
            $this->Cell(52, 8, "Gerado eletrônicamente em ".date("d/m/y (G:i)"), 0, 0, 'C');
            
            $this->SetFont('Arial','i',13);
        
            $this->Ln(6);
        
            $this->Cell(0,10,'D. Caroline, E. Rodrigues, F. Modolo, Y. Masuyama, K. Rocha',0,0,'C');
        }

        function Title() {

            $this->SetFont('Arial','b',20);
            
            $this->Ln(-15);
            $this->Cell(20);
            $this->Cell(150,15,"Relatório de resultados",0,0,'C');
           
            $this->SetFont('Arial','b',20);
                
            $this->Ln(15);
        }
        
        function ReceiptHeader($header, $title) {
            $this->SetFont('Arial','b',16);

            $this->SetFillColor(255,255,255);
            $this->Cell(190, 15, $title, 0, 0, 'C', true);
            $this->Ln(17);

            // Header
            $this->Cell(20, 15, "", 0, 0, 'C', true);
            $this->SetFillColor(255,60,60);

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
                if($i%2 == 1)
                {
                    $this->SetFillColor(255,255,255);
                    $this->Cell(20, 8, "", 0, 0, 'C', true);
                    $this->SetFillColor(220,220,220);
                }
                else
                {
                    $this->SetFillColor(255,255,255);
                    $this->Cell(20, 8, "", 0, 0, 'C', true);
                    $this->SetFillColor(255,255,255);
                }
                

                $this->SetFont('Arial','b',11);
                $this->Cell(50, 8, $a[$i], 1, 0, 'C', true);
                $this->Cell(50, 8, $b[$i], 1, 0, 'C', true);
                $this->Cell(50, 8, $c[$i], 1, 0, 'C', true);

                
                $this->Ln();
            }
        }
    }

    /*----------------------------------------------------------------------------*/

    /*--------------------------------------------------------------------------------------------*/

    //PDF Initialization
    $pdf = new PDF();
    $pdf->AliasNbPages();

    //Intro
    $pdf->AddPage();
        $pdf->Title();
        $pdf->rodape();
    //Show
    $pdf->Output('I', 'Relatorio_SmartGrids.pdf');
?>