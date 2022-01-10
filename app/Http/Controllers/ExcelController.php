<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorio;
use App\Models\UsuarioPermiso; 
use Illuminate\Support\Facades\Auth;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function exportarExcel(Request $request )
    {
    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();


		$sheet->setCellValue('B2', 'COD. SUNEDU');
        $sheet->setCellValue('C2', 'NOMBRE');
        $sheet->setCellValue('D2', 'AULA');
        $sheet->setCellValue('E2', 'PABELLON');
        $sheet->setCellValue('F2', 'AFORO');
        $sheet->setCellValue('G2', 'AREA TOTAL M2');

		$sheet->getColumnDimension("B")->setAutoSize(true); // Ancho de la columna 
		$sheet->getColumnDimension("C")->setAutoSize(true);
        $sheet->getColumnDimension("D")->setAutoSize(true);
        $sheet->getColumnDimension("E")->setAutoSize(true);
        $sheet->getColumnDimension("F")->setAutoSize(true);
        $sheet->getColumnDimension("G")->setAutoSize(true);


        $idfacultad=$request->idfacu;
        $descripcion='';
        if($request->descrip!='all'){ $descripcion=$request->descrip; }

        $where = '';
        if($request->facultad_id!='all'){
            $where = " and `facultad_id` = '".$idfacultad."' ";            
        }

        $lista = DB::table('tb_laboratorio')
            ->whereRaw("(nombre_lab LIKE '%".$descripcion."%' or cod_sunedu LIKE '%".$descripcion."%') and status <> 'EL' ".$where)
            ->select('tb_laboratorio.*')
            ->get();

        $xfila=3; // desde la fina 3(del excel) hacia abajo mostrar
        foreach($lista as $laboratorio){
            $sheet->setCellValue('B'.$xfila, $laboratorio->cod_sunedu); //COD. SUNEDU
            $sheet->setCellValue('C'.$xfila, $laboratorio->nombre_lab); //NOMBRE
            $sheet->setCellValue('D'.$xfila, $laboratorio->num_aula); //AULA
            $sheet->setCellValue('E'.$xfila, $laboratorio->pabellon); // PABELLON
            $sheet->setCellValue('F'.$xfila, $laboratorio->aforo); //AFORO
            $sheet->setCellValue('G'.$xfila, $laboratorio->area_total); //AREA TOTAL M2
            $xfila++;
        }
    

		$writer = new Xlsx($spreadsheet); 

        $aleat = date('dHis');
        
        $filename = 'Lista-Laboratorios'.'_'.$aleat.'.xlsx';
        $file_path = public_path('files/excel/'.$filename);
        $writer->save($file_path);
        return response()->download($file_path);

    }


    public function exportarexcelfacultad(Request $request )
    {
    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();


		$sheet->setCellValue('B2', 'ITEM');
        $sheet->setCellValue('C2', 'NOMBRE DE LA FACULTAD');
        $sheet->setCellValue('D2', 'CONDICION');

		$sheet->getColumnDimension("B")->setAutoSize(true); // Ancho de la columna 
		$sheet->getColumnDimension("C")->setAutoSize(true);
        $sheet->getColumnDimension("D")->setAutoSize(true);
       

       $idfacultad=$request->descrip;
        $descripcion='';
        if($request->descrip!='all'){ $descripcion=$request->descrip; }

        $where = '';
        if($request->descrip!='all'){
            $where = " and `nom_facultad` = '".$idfacultad."' ";            
        }


        $lista = DB::table('tb_facultad')
            ->whereRaw("(nom_facultad LIKE '%".$descripcion."%') and status <> 'EL' ")
            ->select('tb_facultad.*')
            ->get();

        $xfila=3; // desde la fina 3(del excel) hacia abajo mostrar
        foreach($lista as $faultad){
            $sheet->setCellValue('B'.$xfila, $faultad->id); //ID
            $sheet->setCellValue('C'.$xfila, $faultad->nom_facultad); //NOMBRE DE LA FACULTAD
            $sheet->setCellValue('D'.$xfila, $faultad->status); //ESTADO
            $xfila++;
        }
    

		$writer = new Xlsx($spreadsheet);
		$writer->save('LISTADO_FACULTAD.xlsx');
	 	$file_path = public_path('LISTADO_FACULTAD.xlsx');
    	return response()->download($file_path);

    }

    //Lista de equipos

  public function lista_equipos(Request $request){
    $PrivUsuario = UsuarioPermiso::PrivUsuario();
        if(!in_array("admin_todo_laboratorio", $PrivUsuario)) {
            if($request->laboratorio_id!='' and  $request->laboratorio_id!=Auth::user()->laboratorio_id){
                return view('no_tiene_permiso');
            }
        }
        $x_laboratorio_id = Auth::user()->laboratorio_id;
        //$where_lab = "";
        $where = ''; 

        if($request->laboratorio_id==''){
            $request->laboratorio_id = $x_laboratorio_id;
            $where = " and tb_equipo.`laboratorio_id` = '".$x_laboratorio_id."' ";            
        }else if($request->laboratorio_id!='TODOS'){
            $where = " and tb_equipo.`laboratorio_id` = '".$request->laboratorio_id."' ";            
        }  


        
        if($request->responsable_id!=''){
            $where = " and `responsable_id` = '".$request->responsable_id."' ";       
        }
        if($request->responsable_id!=''){
            $wherex = " and `responsable_id` LIKE '%".$request->username."%' ";            
        }

        $grid = DB::table('tb_equipo')
                ->whereRaw("tipo_equipo_id=1 and IFNULL(estado_equipo,'') <> 'EL' and `nom_equipo` LIKE '%".$request->nom_equipo."%' ".$where)
                ->join('tb_unidad_medida', 'tb_equipo.unidad_medida_id', '=', 'tb_unidad_medida.id')
                ->join('tb_laboratorio', 'tb_equipo.laboratorio_id', '=', 'tb_laboratorio.id')
                ->join('tb_persona', 'tb_equipo.responsable_id', '=', 'tb_persona.id')
                ->leftjoin('tb_proveedor', 'tb_equipo.proveedor_id', '=', 'tb_proveedor.id')

                ->select('tb_equipo.*', 'tb_unidad_medida.unidad_medida', 'tb_laboratorio.nombre_lab','tb_persona.nombres','tb_persona.apellidos','tb_proveedor.proveedor')
                // selectRaw('select * ()')
                ->get();
 
 

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  
  if($request->laboratorio_id!='TODOS'){
    $infolab=Laboratorio::find($request->laboratorio_id);
    $sheet->setCellValue('A1','FACULTAD: ');   
    $sheet->setCellValue('B1',$infolab->nombre_lab);
  }else{
    $sheet->setCellValue('B1','--TODA LAS FACULTADES--');
  }
  
  $spreadsheet
    ->getProperties()
    ->setCreator("UNILAB")
    ->setTitle('Lista de equipos');
    $styleArray = array(
      'font' => array(
        'bold' => true,
        'color' => [ 'rgb' => 'FFFFFF']
      ),

      'alignment' => array(
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ),
    );
    
    $letrafinal = 'G';
    $spreadsheet->getActiveSheet()->getStyle('A2:'.$letrafinal.'2')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('A2:'.$letrafinal.'2')->getFill()->applyFromArray( [ 'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => [ 'rgb' => '0063AE']] );
 
    // auto fit column to content
foreach(range('A', $letrafinal) as $columnID) {
      $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    }
// set the names of header cells
    $x=2;

$data = array(
  'CODSISTEMA',  'Cod. patrimonial', 'Nombre Equipo',  'Ubicación',  'Responsable',  'Proveedor', 'Estado'
        );

$spreadsheet->getActiveSheet()->fromArray($data, null, 'A2');

    // Add some data
    $x = 3;
    $i = 0;
    if($grid){
  foreach($grid as $fila){   
     $i++; 
   //$i
      $data = array(
        $fila->id, 
        ' '.$fila->cod_patrimonio,
        $fila->nom_equipo,
        $fila->ubicacion,
        $fila->nombres.' '.$fila->nombres,
        $fila->proveedor,
        estado($fila->estado_equipo) 
      );

      $spreadsheet->getActiveSheet()->fromArray($data, null, 'A'.$x,true);
      
     
        
      $x++;
    }
  }

    $styleBold = array(
      'font' => array(
        'bold' => true,
        //'color' => [ 'rgb' => 'FFFFFF']
      ),
    );
 
    $spreadsheet->getActiveSheet()->getStyle('A'.$x.':'.$letrafinal.$x.'')->applyFromArray($styleBold);
    //El total en negrita
    //$spreadsheet->getActiveSheet()->getStyle('H2:H'.$x.'')->applyFromArray($styleBold);

    $sheet->setCellValue('A'.$x,'CANT. EQUIPO:');
    $sheet->setCellValue('B'.$x,$i);
   // $sheet->setCellValue('T'.$x,$sumatotalventa);
    


  $writer = new Xlsx($spreadsheet);
  $aleat = date('dHis');
  $filename = 'Lista-Equipos'.'_'.$aleat.'.xlsx';
  
 
    $writer = new Xlsx($spreadsheet);
    
    $file_path = public_path("files/excel/".$filename);

    $writer->save($file_path);        
    return response()->download($file_path);
     
    }


}
