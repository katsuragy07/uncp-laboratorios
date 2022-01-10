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
                ->where("nom_asignatura","LIKE",'%'.$request->asignatura.'%')
                ->select('*')
                ->orderBy('nom_asignatura')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_asignatura',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Asignatura::find($request->id);
            $dt->cod_asignatura=$request->cod_asignatura;
            $dt->nom_asignatura=$request->nom_asignatura;
            $dt->facultad_id=$request->facultad_id;
           // $dt->id_usuariomod=Auth::id();
            $dt->save();  
        }else{
            $dt=new Asignatura();
            $dt->cod_asignatura=$request->cod_asignatura;
            $dt->nom_asignatura=$request->nom_asignatura;
            $dt->facultad_id=$request->facultad_id;
           // $dt->id_usuarioreg=Auth::id();
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

