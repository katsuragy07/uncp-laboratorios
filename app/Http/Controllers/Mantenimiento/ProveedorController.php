<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Proveedor;
use DB;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {      
        $lista = DB::table('tb_proveedor')
                ->where("proveedor","LIKE",'%'.$request->proveedor.'%')
                ->select('*')
                ->orderBy('proveedor')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_proveedor',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Proveedor::find($request->id);
            $dt->ruc=$request->ruc;
            $dt->proveedor=$request->proveedor;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Proveedor();
            $dt->ruc=$request->ruc;
            $dt->proveedor=$request->proveedor;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.proveedor');
    }

    public function destroy(Request $request)
    {
       Proveedor::findOrFail($request->id)->delete();
       return redirect()->route('listar.proveedor');
    }

}

