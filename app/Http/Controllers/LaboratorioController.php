<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Laboratorio; 
use App\Models\Laboratorio_det;
use App\Models\Tipo_laboratorio;
use App\Models\UsuarioPermiso;
use DB;

class LaboratorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index(Request $request)
    {

        $where = '';
        if($request->facultad_id!=''){
            $where = " and `facultad_id` = '".$request->facultad_id."' ";            
        }

        $lista = DB::table('tb_laboratorio')
            ->whereRaw("(nombre_lab LIKE '%".$request->txtbuscar."%' or cod_sunedu LIKE '%".$request->txtbuscar."%') and status <> 'EL' ".$where)
            ->select('tb_laboratorio.*')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('laboratorio.lista_laboratorio',['listalaboratio'=>$lista,'databusqueda'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laboratorio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $laboratorios=new Laboratorio($request->input());
        $laboratorios->save();
        return redirect()->route('listar.laboratorios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laboratorios=Laboratorio::findOrFail($id);
        $horario_archivo=DB::table('tb_horario_archivo')
                        ->join('tb_laboratorio','tb_horario_archivo.laboratorio_id','=','tb_laboratorio.id')
                        ->select('tb_horario_archivo.*')
                        ->where('tb_horario_archivo.laboratorio_id','=',$id)
                        ->first();
        //echo 'hola mundo'; 
        //return;
        ($horario_archivo); //sirve para mostrar los datos extraidos 
       // return view('laboratorio.show',compact('laboratorios',"horario_archivo"=>$horario_archivo));
        return view("laboratorio.show",["laboratorios"=>$laboratorios,"horario_archivo"=>$horario_archivo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    public function edit($id)
    {
        $laboratorios=Laboratorio::findOrFail($id);
        //return $laboratorios;
        return view('laboratorio.edit',compact('laboratorios'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $laboratorios=Laboratorio::findOrFail($id);
        $laboratorios->cod_sunedu=$request->input('cod_sunedu');
        $laboratorios->nombre_lab=$request->input('nombre_lab');
        $laboratorios->decripcion_lab=$request->input('decripcion_lab');
        $laboratorios->facultad_id=$request->input('facultad_id');
        $laboratorios->pabellon=$request->input('pabellon');
        $laboratorios->num_aula=$request->input('num_aula');
        $laboratorios->piso=$request->input('piso');
        $laboratorios->aforo=$request->input('aforo');
        $laboratorios->area_total=$request->input('area_total');
        $laboratorios->area_libre=$request->input('area_libre');
        $laboratorios->area_ocupada=$request->input('area_ocupada');
        $laboratorios->flg_internet=$request->input('flg_internet');
        $laboratorios->flg_tacho_peligroso=$request->input('flg_tacho_peligroso');
        $laboratorios->flg_tacho_biocont=$request->input('flg_tacho_biocont');
        $laboratorios->flg_recipiente_rl=$request->input('flg_recipiente_rl');
        $laboratorios->ubicacion=$request->input('ubicacion');
        $laboratorios->tipos_de_ensenanza=$request->input('tipos_de_ensenanza');
        $laboratorios->observaciones_lab=$request->input('observaciones_lab');

        if($request->hasfile('foto_laboratorio')){
            $foto_laboratorio=$request->file('foto_laboratorio');
            $foto_laboratorio->move(public_path().'/files/laboratorio/',$foto_laboratorio->getClientOriginalName());
            $laboratorios->foto_laboratorio=$foto_laboratorio->getClientOriginalName();
        }else{
            $laboratorios->foto_laboratorio=$request->f_foto_laboratorio;
        } 

        if($request->hasfile('organigrama')){
            $organigrama=$request->file('organigrama');
            $organigrama->move(public_path().'/files/laboratorio/',$organigrama->getClientOriginalName());
            $laboratorios->organigrama=$organigrama->getClientOriginalName();
        } else{
            $laboratorios->organigrama=$request->f_organigrama;
        } 

        if($request->hasfile('resolucion_creacion')){
            $resolucion_creacion=$request->file('resolucion_creacion');
            $resolucion_creacion->move(public_path().'/files/laboratorio/',$resolucion_creacion->getClientOriginalName());
            $laboratorios->resolucion_creacion=$resolucion_creacion->getClientOriginalName();
        }else{
            $laboratorios->resolucion_creacion=$request->f_resolucion_creacion;
        }  

        if($request->hasfile('horario_atencion')){
            $horario_atencion=$request->file('horario_atencion');
            $horario_atencion->move(public_path().'/files/laboratorio/',$horario_atencion->getClientOriginalName());
            $laboratorios->horario_atencion=$horario_atencion->getClientOriginalName();
        }else{
            $laboratorios->horario_atencion=$request->f_horario_atencion;
        }  

        $laboratorios->id_usuariomod=Auth::id();
        $laboratorios->save(); 
        return redirect()->route('update.laboratorios',$id);
    }

  
    public function destroy(Request $request)
    {
        $dt=Laboratorio::find($request->id);
        $dt->status='EL';
        $dt->id_usuarioelim=Auth::id();
        $dt->motivo_elim=$request->motivo;
        $dt->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dt->save(); 
        return redirect()->route('listar.laboratorios');
    }

    public function permisos(Request $request)
    {
        $id_usuario=$request->id_usuario;
        UsuarioPermiso::where('id_usuario',$id_usuario)->delete();
        if (isset($request->permiso)) {
            foreach ($request->permiso as $id_permiso) {
               $dtUsuaPermiso=new UsuarioPermiso();
                $dtUsuaPermiso->id_usuario=$id_usuario;
                $dtUsuaPermiso->id_permiso=$id_permiso;
                $dtUsuaPermiso->id_usuarioreg=Auth::id();
                $dtUsuaPermiso->id_usuariomod=0;
               $dtUsuaPermiso->save();
            }
        }
        return redirect()->route('listar.usuarios');
    }


     //Tipo de Laboratorio Asignar Tipo
     public function form_tipo_laboratorio(Request $request)
     {
        $PrivUsuario = UsuarioPermiso::PrivUsuario();
        if(!in_array("admin_todo_laboratorio", $PrivUsuario)) {
            if($request->laboratorio_id!='' and  $request->laboratorio_id!=Auth::user()->laboratorio_id){
                return view('no_tiene_permiso');
            }
        }
        $x_laboratorio_id = Auth::user()->laboratorio_id;
        //$where_lab = "";
        $where = ''; 

        if($request->laboratorio_id==''){
            $request->laboratorio_id = $x_laboratorio_id;
            $where = " and `laboratorio_id` = '".$x_laboratorio_id."' ";            
        }else if($request->laboratorio_id!='TODOS'){
            $where = " and `laboratorio_id` = '".$request->laboratorio_id."' ";            
        }  


         $lista = DB::table('tb_tipo_laboratorio')->orderby('tipo_laboratorio','ASC')->get();
         $equipo_lab = DB::table('tb_laboratorio_det')->where('laboratorio_id',$request->laboratorio_id)->get();
         
         if(count($equipo_lab)>0){
             foreach ($equipo_lab as $fila) {
                 $tipo_laboratorio[]=$fila->tipolaboratorio_id;                  
             }
         }else{
             $tipo_laboratorio[] = 'Sin_privilegio';
         }
         return view('laboratorio.mant_tipo_laboratorio',['lista'=>$lista,'tipo_laboratorio'=> $tipo_laboratorio,'databusqueda'=>$request]);
     }
     
     public function mant_tipo_laboratorio(Request $request)
     {   
         if ($request->estado==1) {
             $dt=new Laboratorio_det();
             $dt->tipolaboratorio_id=$request->tipolaboratorio_id;
             $dt->laboratorio_id=$request->laboratorio_id;
             $dt->id_usuarioreg=Auth::id();
             $dt->save(); 
             echo json_encode('Activado');
         }else{
             DB::table('tb_laboratorio_det')
                 ->where('laboratorio_id', '=', $request->laboratorio_id)
                 ->where('tipolaboratorio_id', '=', $request->tipolaboratorio_id)
                 ->delete(); 
             echo json_encode('Deshabilitado');         
         }
 
     }

    
    public function verpermisos(Request $request)
    {
      if ($request->ajax()) {
            // recibir del ajax
            $id_usuario=$request->get('id_usuario');
            $lista_permisos='';
            // listar todos los permisos
            $permisos=Permisos::all();
            foreach ($permisos as $permiso) {
                // verificar si un permiso está asignado al usuario X
                $permiso_asigando=UsuarioPermiso::where('id_usuario',$id_usuario)
                                    ->where('id_permiso',$permiso->id)->count('id');
                if ($permiso_asigando>0) {
                    $lista_permisos.='
                    <label class="custom-control custom-checkbox" style="cursor: pointer;">
                        <input type="checkbox" class="custom-control-input" name="permiso[]" value="'.$permiso->id.'" checked="">
                        <span class="custom-control-label">'.$permiso->nom_permiso.'</span>
                    </label>'; 
                }else{
                    $lista_permisos.='
                    <label class="custom-control custom-checkbox" style="cursor: pointer;">
                        <input type="checkbox" class="custom-control-input" name="permiso[]" value="'.$permiso->id.'">
                        <span class="custom-control-label">'.$permiso->nom_permiso.'</span>
                    </label>';
                }
            }
            $data=array('permisos' => $lista_permisos);  
            echo json_encode($data);
        }
    }

}

