<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tipo_doc_equipo;
use DB;

class Tipo_doc_equipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {      
        $lista = DB::table('tb_tipo_doc_equipo')
                ->where("tipo_doc_equipo","LIKE",'%'.$request->tipo_doc_equipo.'%')
                ->select('*')
                ->orderBy('tipo_doc_equipo')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_tipo_doc_equipo',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Tipo_doc_equipo::find($request->id);
            $dt->tipo_doc_equipo=$request->tipo_doc_equipo;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Tipo_doc_equipo();
            $dt->tipo_doc_equipo=$request->tipo_doc_equipo;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.tipo_doc_equipo');
    }

    public function destroy(Request $request)
    {
       Tipo_doc_equipo::findOrFail($request->id)->delete();
       return redirect()->route('listar.tipo_doc_equipo');
    }

}

