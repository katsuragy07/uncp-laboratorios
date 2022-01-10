<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tipo_laboratorio;
use DB;

class Tipo_laboratorioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {      
        $lista = DB::table('tb_tipo_laboratorio')
                ->where("tipo_laboratorio","LIKE",'%'.$request->tipo_laboratorio.'%')
                ->select('*')
                ->orderBy('tipo_laboratorio')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_tipo_laboratorio',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Tipo_laboratorio::find($request->id);
            $dt->tipo_laboratorio=$request->tipo_laboratorio;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Tipo_laboratorio();
            $dt->tipo_laboratorio=$request->tipo_laboratorio;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.tipo_laboratorio');
    }

    public function destroy(Request $request)
    {
       Tipo_laboratorio::findOrFail($request->id)->delete();
       return redirect()->route('listar.tipo_laboratorio');
    }

}

