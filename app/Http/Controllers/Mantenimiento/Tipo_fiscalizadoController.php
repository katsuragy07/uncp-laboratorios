<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tipo_fiscalizado;
use DB;

class Tipo_fiscalizadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {      
        $lista = DB::table('tb_tipo_fiscalizado')
                ->where("tipo_fiscalizado","LIKE",'%'.$request->tipo_fiscalizado.'%')
                ->select('*')
                ->orderBy('tipo_fiscalizado')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_tipo_fiscalizado',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Tipo_fiscalizado::find($request->id);
            $dt->tipo_fiscalizado=$request->tipo_fiscalizado;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Tipo_fiscalizado();
            $dt->tipo_fiscalizado=$request->tipo_fiscalizado;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.tipo_fiscalizado');
    }

    public function destroy(Request $request)
    {
       Tipo_fiscalizado::findOrFail($request->id)->delete();
       return redirect()->route('listar.tipo_fiscalizado');
    }

}

