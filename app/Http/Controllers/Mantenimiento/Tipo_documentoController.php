<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tipo_documento;
use DB;

class Tipo_documentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {      
        $lista = DB::table('tb_tipo_documento')
                ->where("tipo_documento","LIKE",'%'.$request->tipo_documento.'%')
                ->select('*')
                ->orderBy('tipo_documento')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_tipo_documento',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Tipo_documento::find($request->id);
            $dt->tipo_documento=$request->tipo_documento;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Tipo_documento();
            $dt->tipo_documento=$request->tipo_documento;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.tipo_documento');
    }

    public function destroy(Request $request)
    {
       Tipo_documento::findOrFail($request->id)->delete();
       return redirect()->route('listar.tipo_documento');
    }

}

