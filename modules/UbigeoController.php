<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ubigeo;
use DB;

class UbigeoController extends Controller
{

    public function index(Request $request)
    {      
        $lista = DB::table('tb_ubigeo')
                ->where("ubigeo","LIKE",'%'.$request->ubigeo.'%')
                ->select('*')
                ->orderBy('ubigeo')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_ubigeo',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Ubigeo::find($request->id);
            $dt->ubigeo=$request->ubigeo;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Ubigeo();
            $dt->ubigeo=$request->ubigeo;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.ubigeo');
    }

    public function destroy(Request $request)
    {
       Ubigeo::findOrFail($request->id)->delete();
       return redirect()->route('listar.ubigeo');
    }

}

