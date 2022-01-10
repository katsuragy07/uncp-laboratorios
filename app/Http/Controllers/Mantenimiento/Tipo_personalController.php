<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tipo_personal;
use DB;

class Tipo_personalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {      
        $lista = DB::table('tb_tipopersonal')
                ->where("tipo_personal","LIKE",'%'.$request->tipo_personal.'%')
                ->select('*')
                ->orderBy('tipo_personal')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_tipo_personal',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Tipo_personal::find($request->id);
            $dt->tipo_personal=$request->tipo_personal;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Tipo_personal();
            $dt->tipo_personal=$request->tipo_personal;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.tipo_personal');
    }

    public function destroy(Request $request)
    {
       Tipo_personal::findOrFail($request->id)->delete();
       return redirect()->route('listar.tipo_personal');
    }

}

