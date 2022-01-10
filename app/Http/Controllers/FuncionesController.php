<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\UsuarioPermiso;
use App\Models\Lote_equipo;
use App\Models\Persona;
use App\Models\Facultad;
use Illuminate\Support\Facades\Auth;

class FuncionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //
    public function Cargo_Usuarioxxxxxxxxxx($id_cargo)
    {
    	// buscar cargo por el id
    	$row_cargo=DB::table('tb_cargo')->where('id',$id_cargo)->first();
    	// obtener nombre del cargo
    	return $row_cargo->cargo;
    }

    public function Nombre_Laboratorio($laboratorio_id)
    {
    	$row=DB::table('tb_laboratorio')->where('id',$laboratorio_id)->first();    	 
        if($row){
    	   return $row->nombre_lab;
        }else{
           return '';
        }
    }

    public function Nombre_Facultad($laboratorio_id)
    {
        $infoFac = DB::table('tb_facultad')
            ->join('tb_laboratorio', 'tb_facultad.id', '=', 'tb_laboratorio.facultad_id')
            ->select('tb_facultad.nom_facultad')
            ->where('tb_laboratorio.id',$laboratorio_id)->first();

         
        if($infoFac){
           return $infoFac->nom_facultad;
        }else{
           return '';
        }
    }

    public function PrivUsuario()
    {
        $Privilegio=UsuarioPermiso::
        join('tb_permiso', 'tb_permiso.id', '=', 'tb_usuariopermiso.id_permiso')
        ->select('tb_permiso.cod_permiso')
        ->where('id_usuario',Auth::id())->get();

        $PrivUsuario = array();
        foreach ($Privilegio as $fila) {
            $PrivUsuario[] = $fila->cod_permiso;
        }
          
        
        return $PrivUsuario;
        
    }

    public function cantidad_lote($equipo_id=0, $laboratorio_id=0)
    {
        $row = DB::table('tb_lote_equipo as le')
                ->selectRaw("SUM(cantidad_lote) AS cantidad_lote 
                    ")
                ->whereRaw(" le.equipo_id = '$equipo_id' AND le.laboratorio_id = '$laboratorio_id' and status_lote != 'EL'")
                ->first();     
        if($row){
           return $row->cantidad_lote;
        }else{
           return 0;
        }
    }

    public function categoria_laboratorio($laboratorio_id)
    {
        $row=DB::table('tb_laboratorio')->where('id',$laboratorio_id)->first();      
        if($row){
           return $row->categoria_lab;
        }else{
           return '';
        }
    }

    public function existe_tipo_laboratorio($laboratorio_id, $tipolaboratorio_id)
    {
        $row=DB::table('tb_laboratorio_det')->where('laboratorio_id',$laboratorio_id)
        ->where('tipolaboratorio_id',$tipolaboratorio_id)->first();      
        if($row){
           return $row->id;
        }else{
           return '';
        }
    }

    public function info_persona($id)
    {
        $row=DB::table('tb_persona')->where('id',$id)->first();      
        if($row){
           return $row->num_doc.'-'.$row->nombres.' '.$row->apellidos;
        }else{
           return '';
        }
    }

    public function info_ubigeo($ubigeo)
    {
        $row=DB::table('tb_ubigeo')->where('ubigeo',$ubigeo)->first();      
        if($row){
           return $row->ubigeo.' | '.$row->distrito.' - '.$row->provincia.' - '.$row->departamento;
        }else{
           return '';
        }
    }
 
}
