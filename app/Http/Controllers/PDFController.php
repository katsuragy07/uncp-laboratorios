<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Models\Headergeneral_fpdf;

 
use Fpdf;
 /*
class PDFX extends Fpdf {
    function Header() {
      //  $this->Image(storage_path() . 'logo.png',10,6,30);
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,10,'Title',1,0,'C');
        $this->Ln(20);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
*/
class PDF extends FPDF
{
function Footer()
{
    // Go to 1.5 cm from bottom
    $this->SetY(-50);
    // Select Arial italic 8
    $this->SetFont('Arial','I',8);
    // Print centered page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
}

class PDFController extends Controller
{
   private $pdf;
 
    /*public function __construct(\App\Models\Headergeneral_fpdf $pdf)
    {
         $this->pdf = $pdf;//new Headergeneral_fpdf();
    }*/
 
     public function createPdf(Request $request)
    {

        ob_end_clean();

        $this->pdf = new PDF();
       // $header = $pdfClass::Header();

    //$this->pdf::SetAutoPageBreak(true, 0);

    $this->pdf::AddPage('P','A4');
    //$this->pdf::AddPage('P',  array(80,250));
    //$this->pdf::AliasNbPages();

       // $this->pdf = new  Fpdf;
      $this->pdf::SetFont('Arial', '', 9);
        for($i=1;$i<=40;$i++){
            $this->pdf::Cell(0,10,'Printing line number '.$i,0,1);
        }

        //header('Content-type: application/pdf');

        $this->pdf::Output();
        //exit;
    }
}

?>