<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Periodo;
use DB;

class PeriodoController extends Controller
{

    public function index(Request $request)
    {      
        $lista = DB::table('tb_periodo')
                ->where("periodo","LIKE",'%'.$request->periodo.'%')
                ->select('*')
                ->orderBy('periodo')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_periodo',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Periodo::find($request->id);
            $dt->periodo=$request->periodo;
           // $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Periodo();
            $dt->periodo=$request->periodo;
          //  $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.periodo');
    }

    public function destroy(Request $request)
    {
       Periodo::findOrFail($request->id)->delete();
       return redirect()->route('listar.periodo');
    }

}

