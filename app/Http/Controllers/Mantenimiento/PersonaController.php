<?php
namespace App\Http\Controllers\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use DB;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {      
        $lista = DB::table('tb_persona')
                ->where("nombres","LIKE","%".$request->nombres."%")
                ->where("apellidos","LIKE","%".$request->apellidos."%")
                ->select('*')
                ->orderBy('nombres')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('mantenimiento.lista_persona',['lista'=>$lista,'databusqueda'=>$request]);
    }
 
    public function store(Request $request)
    {
        $id_rs = '';
        if ($request->id!='') {
            $dt=Persona::find($request->id);
           
            $dt->tipo_documento_id=$request->tipo_documento_id;
            $dt->num_doc=$request->num_doc;
            $dt->nombres=$request->nombres;
            $dt->apellidos=$request->apellidos;
            $dt->correo=$request->correo;
            $dt->celular=$request->celular;
            $dt->fch_nacimiento=$request->fch_nacimiento;
            $dt->id_usuariomod=Auth::id();

            $dt->save();   

            $id_rs = $request->id;

            
        }else{
            $tabla=new Persona($request->input());
            $tabla->save();
            $tabla->id;
            $id_rs = $tabla->id;
            /*$dt=new Persona();
            $dt->persona=$request->persona;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();            
            */
        }

        if($request->tipo=='json'){
            $option = '<option value="'.$id_rs.'">'.$request->num_doc.' - '.$request->nombres.' '.$request->apellidos.'</option>';
            echo ($option);
        }else{
            return redirect()->route('listar.persona');
        }
       
    }

    public function modal_form_persona(Request $request)
    {
        $dt=Persona::find($request->id);
        return view('mantenimiento.modal_form_persona',['info'=>$dt]);
    }

    public function select2_persona(Request $request)
    { 
        //and laboratorio_id=".$request->laboratorio_id."
        $lista = DB::table('tb_persona')
                ->whereRaw("num_doc LIKE '%".$request->term."%' or nombres LIKE '%".$request->term."%' or apellidos LIKE '%".$request->term."%' ")
               
                -> selectRaw("id, CONCAT_WS(' ',num_doc,'-' , nombres,apellidos) as text")
                ->orderBy('num_doc','ASC')->get();

        echo json_encode($lista);
    }


    public function destroy(Request $request)
    {
       Persona::findOrFail($request->id)->delete();
       return redirect()->route('listar.persona');
    }

}

