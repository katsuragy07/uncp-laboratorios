<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tipo_doc_especifico;
use DB;

class Tipo_doc_especificoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {      
        $lista = DB::table('tb_tipo_doc_especifico')
                ->where("tipo_doc_especifico","LIKE",'%'.$request->tipo_doc_especifico.'%')
                ->select('*')
                ->orderBy('tipo_doc_especifico')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_tipo_doc_especifico',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Tipo_doc_especifico::find($request->id);
            $dt->tipo_doc_especifico=$request->tipo_doc_especifico;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Tipo_doc_especifico();
            $dt->tipo_doc_especifico=$request->tipo_doc_especifico;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.tipo_doc_especifico');
    }

    public function destroy(Request $request)
    {
       Tipo_doc_especifico::findOrFail($request->id)->delete();
       return redirect()->route('listar.tipo_doc_especifico');
    }

}

