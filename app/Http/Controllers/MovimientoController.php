<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movimiento;
use App\Models\UsuarioPermiso;
use DB;

class MovimientoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {     
        
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
            $where = " and m.`laboratorio_id` = '".$x_laboratorio_id."' ";            
        }else if($request->laboratorio_id!='TODOS'){
            $where = " and m.`laboratorio_id` = '".$request->laboratorio_id."' ";            
        }  


       
        $lista = DB::table('tb_movimiento as m')
                ->join('tb_equipo as e', 'e.id', '=', 'm.equipo_id')
                ->join('tb_laboratorio as l', 'l.id', '=', 'm.laboratorio_id')
                ->join('tb_tipo_movimiento as t', 't.id', '=', 'm.tipo_movimiento_id')
                ->join('tb_lote_equipo as le', 'le.id', '=', 'm.lote_equipo_id')
                ->leftjoin('tb_atencion as a', 'a.id', '=', 'm.atencion_id')
                ->leftjoin('tb_detalle_atencion as da', 'da.id', '=', 'm.detalle_atencion_id')
                ->leftjoin('tb_laboratorio as ld', 'ld.id', '=', 'a.laboratorio_dest_id')
                ->leftjoin('tb_persona as pr', 'pr.id', '=', 'a.recibido_id')
                ->leftjoin('tb_recepcion as rc', 'rc.id', '=', 'm.recepcion_id')

                ->selectRaw("l.nombre_lab as laboratorio_origen, ld.nombre_lab as laboratorio_destino, concat(pr.nombres, ' ', pr.apellidos) as persona_recibido , t.tipo_movimiento, rc.numdoc_sustento, e.*, a.id as num_atencion,le.fch_vencimiento, le.lote, m.*")
                 ->whereRaw(" e.nom_equipo LIKE '%".$request->nom_equipo."%' ".$where)
                ->orderBy('m.id', 'desc')
                ->Paginate(10)->appends($request->except(['page','_token']));


        return view('atencion.lista_movimiento',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Movimiento::find($request->id);
            $dt->movimiento=$request->movimiento;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Movimiento();
            $dt->movimiento=$request->movimiento;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.movimiento');
    }

    public function destroy(Request $request)
    {
       Movimiento::findOrFail($request->id)->delete();
       return redirect()->route('listar.movimiento');
    }

}

