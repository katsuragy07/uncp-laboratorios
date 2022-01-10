<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ubigeo;
use DB;

class UbigeoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {      
        $lista = DB::table('tb_ubigeo')
                ->where("ubigeo","LIKE",'%'.$request->ubigeo.'%')
                ->orwhere("distrito","LIKE",'%'.$request->ubigeo.'%')
                ->orwhere("provincia","LIKE",'%'.$request->ubigeo.'%')
                ->orwhere("departamento","LIKE",'%'.$request->ubigeo.'%')
                ->select('*')
                ->orderBy('ubigeo')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_ubigeo',['lista'=>$lista,'databusqueda'=>$request]);
    }
 
    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Ubigeo::find($request->id);
            $dt->distrito=$request->distrito;
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

    public function select2_ubigeo(Request $request)
    { 
        //and laboratorio_id=".$request->laboratorio_id."
        $lista = DB::table('tb_ubigeo')
                ->whereRaw("ubigeo LIKE '%".$request->term."%' or distrito LIKE '%".$request->term."%' or provincia LIKE '%".$request->term."%' or departamento LIKE '%".$request->term."%' ")
               
                -> selectRaw("ubigeo as id ,CONCAT_WS(' ',ubigeo,'|' , distrito,'-' ,provincia,'-', departamento) as text")
                ->orderBy('ubigeo','ASC')->get();

        echo json_encode($lista);
    }



    public function destroy(Request $request)
    {
       Ubigeo::findOrFail($request->id)->delete();
       return redirect()->route('listar.ubigeo');
    }

}

