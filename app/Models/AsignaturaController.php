<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asignatura;
use DB;

class AsignaturaController extends Controller
{

    public function index(Request $request)
    {      
        $lista = DB::table('tb_asignatura')
                ->where("asignatura","LIKE",'%'.$request->asignatura.'%')
                ->select('*')
                ->orderBy('asignatura')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_asignatura',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Asignatura::find($request->id);
            $dt->asignatura=$request->asignatura;
            $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Asignatura();
            $dt->asignatura=$request->asignatura;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
        }
        return redirect()->route('listar.asignatura');
    }

    public function destroy(Request $request)
    {
       Asignatura::findOrFail($request->id)->delete();
       return redirect()->route('listar.asignatura');
    }

}

