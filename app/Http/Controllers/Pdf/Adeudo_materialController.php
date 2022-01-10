<?php
namespace App\Http\Controllers\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Laboratorio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
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

class Adeudo_materialController extends Controller
{
   private $pdf;
 
    public function index(Request $request)
    {


        $id = $request->id; 

        $gridDetalle = DB::table('tb_detalle_atencion as da')
                ->join('tb_atencion as a', 'da.atencion_id', '=', 'a.id')
                ->join('tb_persona as r', 'a.recibido_id', '=', 'r.id')
                ->join('tb_equipo as e', 'da.equipo_id', '=', 'e.id')
                ->join('tb_unidad_medida as um', 'e.unidad_medida_id', '=', 'um.id')
                ->join('tb_unidad_medida as umm', 'e.unidad_med_min_id', '=', 'umm.id')
                ->join('tb_lote_equipo as le', 'da.lote_equipo_id', '=', 'le.id')
                //->join('tb_persona as r', 'tb_atencion.recibido_id', '=', 'r.id')
                ->selectRaw("a.fch_entrega, e.*, da.*,da.id as detalle_atencion_id, um.unidad_medida,umm.unidad_medida as unidad_med_min, le.lote, le.fch_vencimiento,CONCAT(r.nombres,' ', r.apellidos) as resp_recibir,r.num_doc as dni_responsable, (SELECT SUM(cantidad_devolucion) FROM `tb_detalle_devolucion` AS dd WHERE dd.`detalle_atencion_id` = da.id) as cantidad_devolucion")

                ->whereRaw("(SELECT SUM(IFNULL(dd.cantidad_devolucion,0)) FROM `tb_detalle_atencion` AS dax 
  LEFT JOIN tb_detalle_devolucion dd ON dax.`id` = dd.`detalle_atencion_id` 
  INNER JOIN `tb_equipo` eq ON dax.`equipo_id` = eq.`id` 
  WHERE dax.`id` = da.id AND eq.tipo_equipo_id != 3)
   < cantidad_atencion AND IFNULL(a.`requerimiento_id`,0) >0 ")
                ->get();



    ob_end_clean();
    $this->pdf = new PDF();
    
    $this->pdf::AddPage('P','A4');
    $this->pdf::SetAutoPageBreak(true, 0);
    $this->pdf::AliasNbPages();
    $this->pdf::SetLeftMargin(22);
    $this->pdf::SetRightMargin(20);

    $this->pdf::SetTitle(utf8_decode('Lista de Adeudo'));

    ##### Cabecera ####
   // $this->pdf::Image(url('images/logouncp.png'),12,10,26);
    //$this->pdf::Image(url('images/logounilab.png'),170,10,26);    
    $this->pdf::SetY(12);
    $this->pdf::SetFont('Arial','B',12);
    $this->pdf::MultiCell(0,7, utf8_decode("UNIVERSIDAD NACIONAL DEL CENTRO DEL PERÚ"), '', 'C');
    
    if(Auth::user()->laboratorio_id>0){
        $infolab=Laboratorio::find(Auth::user()->laboratorio_id);
        $this->pdf::Cell(0,7,utf8_decode($infolab->nombre_lab.'.'),0,1,"C"); 
    }
    $this->pdf::SetFont('Arial','',10);
    $this->pdf::MultiCell(0,5, utf8_decode("Av. Mariscal Castilla N° 3909-4089 El Tambo-Huancayo Teléfono 064-481060"), '', 'C');
    $this->pdf::SetFont('Courier','I',10);
  //  $this->pdf::Cell(0,5,utf8_decode("Año Del Bicentenario Del Perú: 200 Años de Independencia"),0,1,"C");    
    $y = 35; 
    $this->pdf::line(30, $y,180, $y);
    $this->pdf::line(30, $y+0.5,180, $y+0.5);
    $this->pdf::SetY(40);
    ##### .Cabecera ####

    $this->pdf::SetFont('Arial','B',12);
    $this->pdf::Cell(0,5,utf8_decode("LISTA QUE ADEUDAN EQUIPOS Y MATERIALES"),0,1,"C");    
    $this->pdf::ln(2);
   // $this->pdf::SetFont('Arial','B',10);
   // $this->pdf::Cell(0,5,utf8_decode("N° REQUERIMIENTO: ".$rowCabecera->id),0,1,"C");

$this->pdf::SetFillColor(255, 255, 255);
    $this->pdf::SetFont('Arial', 'B', 8);
    $this->pdf::Cell(10,7,'ITEM','1',0,'L','');
    $this->pdf::Cell(15,7,utf8_decode('FECHA'),'1',0,'L','');
    $this->pdf::Cell(35,7,utf8_decode('RESPONSABLE'),'1',0,'L','');
    $this->pdf::Cell(50,7,utf8_decode('MATERIAL'),'1',0,'L','');
    $this->pdf::Cell(30,7,utf8_decode('MARCA'),'1',0,'L','');

    $this->pdf::Cell(17,7,utf8_decode('CANTIDAD'),'1',0,'L','');
    $this->pdf::Cell(15,7,utf8_decode('UNIDAD'),'1',1,'L','');

    $i = 0;
    $this->pdf::SetFont('Arial', '', 8);
    foreach($gridDetalle as $fila){
        $i++;        
        $this->pdf::Cell(10,5,$i,'',0,'C','');
        $this->pdf::Cell(15,5,fechausu($fila->fch_entrega),'',0,'L','');
        $this->pdf::Cell(35,5,utf8_decode($fila->resp_recibir),'',0,'L','');
        $this->pdf::Cell(50,5,utf8_decode($fila->nom_equipo),'',0,'L',1);
        $this->pdf::Cell(30,5,utf8_decode($fila->marca),'',0,'L','');    
        $this->pdf::Cell(17,5,($fila->cantidad_atencion-$fila->cantidad_devolucion),'',0,'C','');
        $this->pdf::Cell(15,5,utf8_decode($fila->unidad_medida),'',1,'L','');

    }

 



        $this->pdf::Output("Lista de Adeudo.pdf", 'I');
    }
}

?>