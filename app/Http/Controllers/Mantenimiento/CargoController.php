<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cargo;
use DB;

class CargoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index(Request $request)
    {      
        $lista = DB::table('tb_cargo')
                ->where("cargo","LIKE",'%'.$request->cargo.'%')
                ->select('*')
                ->orderBy('id')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_cargo',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Cargo::find($request->id);
            $dt->cargo=$request->cargo;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Cargo();
            $dt->cargo=$request->cargo;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.cargo');
    }

    public function destroy(Request $request)
    {
       Cargo::findOrFail($request->id)->delete();
       return redirect()->route('listar.cargo');
    }

}

