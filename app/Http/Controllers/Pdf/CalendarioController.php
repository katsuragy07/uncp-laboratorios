<?php
namespace App\Http\Controllers\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Laboratorio;
use Illuminate\Support\Facades\Auth;

 
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

class CalendarioController extends Controller
{
   private $pdf;
 
    public function index(Request $request)
    {

        $id = $request->id; 



    ob_end_clean();
    $this->pdf = new PDF();
    
    $this->pdf::AddPage('L','A4');
    $this->pdf::SetAutoPageBreak(true, 0);
    $this->pdf::AliasNbPages();
    $this->pdf::SetLeftMargin(22);
    $this->pdf::SetRightMargin(20);

    $this->pdf::SetTitle(utf8_decode('Ficha de entrega'));

    ##### Cabecera ####
    $this->pdf::Image(url('images/logouncp.png'),50,10,26);
    $this->pdf::Image(url('images/logounilab.png'),216,10,26);    
    $this->pdf::SetY(12);
    $this->pdf::SetFont('Arial','B',12);
    $this->pdf::MultiCell(0,4, utf8_decode("UNIVERSIDAD NACIONAL DEL CENTRO DEL PERÚ"), '', 'C');
    $this->pdf::MultiCell(0,4, utf8_decode("VICERRECTORADO DE INVESTIGACIÓN"), '', 'C');
    $this->pdf::SetFont('Arial','',12);
    $this->pdf::MultiCell(0,4, utf8_decode("UNIDAD DE LABORATORIOS"), '', 'C');
    $this->pdf::SetFont('Arial','',10);
    $this->pdf::MultiCell(0,5, utf8_decode("Av. Mariscal Castilla N° 3909-4089 El Tambo-Huancayo Teléfono 064-481060"), '', 'C');
    $this->pdf::SetFont('Courier','I',10);
 //   $this->pdf::Cell(0,5,utf8_decode("Año Del Bicentenario Del Perú: 200 Años de Independencia"),0,1,"C");    
    $y = 35;
    $this->pdf::line(80, $y,210, $y);
    $this->pdf::line(80, $y+0.5,210, $y+0.5);
    $this->pdf::SetY(40);
    ##### .Cabecera ####

    $infolab=Laboratorio::find($request->laboratorio_id);
   // $infolab=Laboratorio::find(Auth::user()->laboratorio_id);
    $this->pdf::SetFont('Arial','B',12);
    $this->pdf::Cell(0,5,utf8_decode($infolab->nombre_lab),0,1,"C");    
    $this->pdf::SetFont('Arial','',12);
    $this->pdf::Cell(0,5,utf8_decode("CALENDARIO ACADÉMICO ".$request->periodo),0,1,"C");    
    $this->pdf::ln(2);
    $this->pdf::SetFont('Arial','B',10);

    $this->pdf::SetFont('Arial', 'B', 8);
    $this->pdf::Cell(25,7,'HORA','1',0,'C','');
    $this->pdf::Cell(37,7,utf8_decode('LUNES'),'1',0,'C','');
    $this->pdf::Cell(37,7,utf8_decode('MARTES'),'1',0,'C','');
    $this->pdf::Cell(37,7,utf8_decode('MIERCOLES'),'1',0,'C','');
    $this->pdf::Cell(37,7,utf8_decode('JUEVES'),'1',0,'C','');
    $this->pdf::Cell(37,7,utf8_decode('VIERNES'),'1',0,'C','');
    $this->pdf::Cell(37,7,utf8_decode('SABADO'),'1',0,'C','');
   


        $this->pdf::Output("Ficha de Entrega.pdf", 'I');
    }
}

?>