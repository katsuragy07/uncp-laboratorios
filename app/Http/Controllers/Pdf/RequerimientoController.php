<?php
namespace App\Http\Controllers\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Laboratorio;
use Illuminate\Support\Facades\Auth;
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

class RequerimientoController extends Controller
{
   private $pdf;
 
    public function index(Request $request)
    {

        $id = $request->id; 

        $rowCabecera = DB::table('tb_requerimiento as rq')
                ->join('tb_laboratorio', 'rq.laboratorio_dest_id', '=', 'tb_laboratorio.id')
                ->join('tb_facultad', 'tb_laboratorio.facultad_id', '=', 'tb_facultad.id')
                ->join('tb_persona', 'rq.encargado_lab_dest_id', '=', 'tb_persona.id')
                ->join('tb_persona as r', 'rq.solicitante_id', '=', 'r.id')
                ->leftjoin('tb_atencion as a', 'rq.id', '=', 'a.requerimiento_id')

                ->selectRaw("rq.*, a.id as atencion_id, a.fch_entrega, a.hora_entrega ,tb_facultad.nom_facultad, tb_laboratorio.nombre_lab , CONCAT(tb_persona.nombres,' ', tb_persona.apellidos) as encargado, CONCAT(r.nombres,' ', r.apellidos) as resp_recibir,r.num_doc as dni_responsable")
                
                ->whereRaw("rq.id = ".$id)->first();


        $gridDetalle = DB::table('tb_detalle_requerimiento as dr')
                ->join('tb_equipo as e', 'dr.equipo_id', '=', 'e.id')
                ->join('tb_unidad_medida as um', 'e.unidad_medida_id', '=', 'um.id')
                ->join('tb_lote_equipo as le', 'dr.lote_equipo_id', '=', 'le.id')
                //->join('tb_persona as r', 'tb_atencion.recibido_id', '=', 'r.id')
                ->selectRaw("e.*, dr.*, um.unidad_medida, le.lote, le.fch_vencimiento")                
                ->whereRaw("dr.requerimiento_id = ".$id)->get();

 


    ob_end_clean();
    $this->pdf = new PDF();
    
    $this->pdf::AddPage('P','A4');
    $this->pdf::SetAutoPageBreak(true, 0);
    $this->pdf::AliasNbPages();
    $this->pdf::SetLeftMargin(22);
    $this->pdf::SetRightMargin(20);

    $this->pdf::SetTitle(utf8_decode('Ficha de entrega'));

    ##### Cabecera ####
   // $this->pdf::Image(url('images/logouncpok.png'),12,10,26);
 //   $this->pdf::Image(url('images/logounilab.png'),170,10,26);    
    $this->pdf::SetY(12);
    $this->pdf::SetFont('Arial','B',12);
    $this->pdf::MultiCell(0,7, utf8_decode("UNIVERSIDAD NACIONAL DEL CENTRO DEL PERÚ"), '', 'C');
  //  $this->pdf::MultiCell(0,4, utf8_decode("VICERRECTORADO DE INVESTIGACIÓN"), '', 'C');
    $this->pdf::SetFont('Arial','',12);
    
    $infolab=Laboratorio::find(Auth::user()->laboratorio_id);
    $this->pdf::Cell(0,7,utf8_decode($infolab->nombre_lab.'.'),0,1,"C");    

    //$this->pdf::MultiCell(0,4, utf8_decode(""), '', 'C');
    $this->pdf::SetFont('Arial','',10);
    $this->pdf::MultiCell(0,5, utf8_decode("Av. Mariscal Castilla N° 3909-4089 El Tambo-Huancayo Teléfono 064-481060"), '', 'C');
    $this->pdf::SetFont('Courier','I',10);
    //$this->pdf::Cell(0,5,utf8_decode("Año Del Bicentenario Del Perú: 200 Años de Independencia"),0,1,"C");    
    $y = 35;
    $this->pdf::line(30, $y,180, $y);
    $this->pdf::line(30, $y+0.5,180, $y+0.5);
    $this->pdf::SetY(40);
    ##### .Cabecera ####

    $this->pdf::SetFont('Arial','B',12);
    $this->pdf::Cell(0,5,utf8_decode("REQUERIMIENTO DE LABORATORIO"),0,1,"C");    
    $this->pdf::ln(2);
    $this->pdf::SetFont('Arial','B',10);
    $this->pdf::Cell(0,5,utf8_decode("N° REQUERIMIENTO: ".$rowCabecera->id),0,1,"C");


    $this->pdf::SetFont('Arial','B',8);
    $this->pdf::Cell(42,5,utf8_decode('FECHA DE REQUERIMIENTO: '),0,0,'');
    $this->pdf::SetFont('Arial','',8);
    $this->pdf::Cell(30,5,fechausu($rowCabecera->fch_requerimiento),0,0,''); 
    
    $this->pdf::SetFont('Arial','B',8);
    $this->pdf::Cell(42,5,utf8_decode('HORA DE REQUERIMIENTO: '),0,0,'');
    $this->pdf::SetFont('Arial','',8);
    $this->pdf::MultiCell(0,5, ($rowCabecera->hora_requerimiento), '', '');


    $this->pdf::SetFont('Arial','B',8);
    $this->pdf::Cell(42,5,utf8_decode('FECHA DE ENTREGA: '),0,0,'');
    $this->pdf::SetFont('Arial','',8);
    $this->pdf::Cell(30,5,fechausu($rowCabecera->fch_entrega),0,0,''); 
    
    $this->pdf::SetFont('Arial','B',8);
    $this->pdf::Cell(42,5,utf8_decode('HORA DE ENTREGA: '),0,0,'');
    $this->pdf::SetFont('Arial','',8);
    $this->pdf::MultiCell(0,5, fechausu($rowCabecera->hora_entrega), '', '');

    
    /*
    $this->pdf->SetFont('Arial','B',8);
    $this->pdf->Cell(20,4,utf8_decode('CLIENTE'),0,0,'');
    $this->pdf->SetFont('Arial','',8);
    $this->pdf->MultiCell(103,4, ': '.utf8_decode($venta->razonsocial), '', 'L');
    */

    $this->pdf::SetFont('Arial','B',8);
    $this->pdf::Cell(23,5,utf8_decode('FACULTAD: '),0,0,'');
    $this->pdf::SetFont('Arial','',8);
    $this->pdf::MultiCell(0,5, utf8_decode($rowCabecera->nom_facultad), '', '');

    $this->pdf::SetFont('Arial','B',8);
    $this->pdf::Cell(23,5,utf8_decode('LABORATORIO: '),0,0,'');
    $this->pdf::SetFont('Arial','',8);
    $this->pdf::MultiCell(0,5, utf8_decode($rowCabecera->nombre_lab), '', '');

    $this->pdf::SetFont('Arial','B',8);
    $this->pdf::Cell(23,5,utf8_decode('A CARGO DE: '),0,0,'');
    $this->pdf::SetFont('Arial','',8);    
    $this->pdf::MultiCell(0,5, utf8_decode($rowCabecera->encargado), '', '');

  


    $this->pdf::ln(2);
    $this->pdf::MultiCell(0,5, utf8_decode("        El almacen central de laboratorios hace la entrega de los siguientes materiales y reactivos."), '', '');
    $this->pdf::ln(2);


    $this->pdf::SetFont('Arial', 'B', 8);
    $this->pdf::Cell(10,7,'ITEM','1',0,'L','');
    $this->pdf::Cell(50,7,utf8_decode('MATERIAL'),'1',0,'L','');
    $this->pdf::Cell(30,7,utf8_decode('MARCA'),'1',0,'L','');
    $this->pdf::Cell(25,7,utf8_decode('ESPECIFICACIÓN'),'1',0,'L','');
    $this->pdf::Cell(17,7,utf8_decode('CANTIDAD'),'1',0,'L','');
    $this->pdf::Cell(15,7,utf8_decode('UNIDAD'),'1',0,'L','');
    $this->pdf::Cell(25,7,utf8_decode('LOTE/F. VENC.'),'1',1,'L','');

    $i = 0;
    $this->pdf::SetFont('Arial', '', 8);
    foreach($gridDetalle as $fila){
        $i++;        
        $this->pdf::Cell(10,5,$i,'',0,'C','');
        $this->pdf::Cell(50,5,utf8_decode($fila->nom_equipo),'',0,'L','');
        $this->pdf::Cell(30,5,utf8_decode($fila->marca),'',0,'L','');
        $this->pdf::Cell(25,5,utf8_decode($fila->especificacion),'',0,'L','');
        $this->pdf::Cell(17,5,($fila->cantidad_requerimiento)*1,'',0,'C','');
        $this->pdf::Cell(15,5,utf8_decode($fila->unidad_medida),'',0,'L','');
        $this->pdf::Cell(25,5,utf8_decode($fila->lote.' / '.fechausu($fila->fch_vencimiento)),'',1,'L','');

    }

    $this->pdf::SetXY(81,250);
    //$this->pdf::ln(1);
    $this->pdf::SetFont('Arial', '', 6);
    $this->pdf::Cell(50,4,utf8_decode('RECIBI CONFORME'),'T',1,'C','');    
    $this->pdf::SetFont('Arial', '', 8);
    $this->pdf::Cell(0,4,utf8_decode(''.strtoupper($rowCabecera->resp_recibir)),'',1,'C','');
    $this->pdf::Cell(0,4,utf8_decode('DNI: '.$rowCabecera->dni_responsable),'',1,'C','');





        $this->pdf::Output("Ficha de Entrega.pdf", 'I');
    }
}

?>