<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Atencion;
use App\Models\Detalle_atencion;
use App\Models\Movimiento;
use App\Models\Lote_equipo;
use App\Models\Recepcion;
use App\Models\Detalle_recepcion;
use App\Models\Devolucion;
use App\Models\Detalle_devolucion;


use App\Models\Requerimiento;
use App\Models\Detalle_requerimiento;
use App\Models\UsuarioPermiso;
use Illuminate\Support\Str;
use DB;
use File;

class AtencionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
    }

    public function lista_atencion(Request $request)
    {   
       /* $PrivUsuario = UsuarioPermiso::PrivUsuario();
        if(!in_array("admin_todo_laboratorio", $PrivUsuario)) {
            if($request->laboratorio_id!='' and  $request->laboratorio_id!=Auth::user()->laboratorio_id){
                return view('no_tiene_permiso');
            }
        }*/

        $x_laboratorio_id = Auth::user()->laboratorio_id;
        $where_lab = "";
        if($request->laboratorio_dest_id!=''){
            $where_lab = " and tb_atencion.`laboratorio_dest_id` = '".$request->laboratorio_dest_id."' ";            
        }
 
        $fch_entrega_desde = $request->fch_entrega_desde;
        if($request->fch_entrega_desde==''){
            $fch_entrega_desde = date('Y-m-d');
            $request->fch_entrega_desde = $fch_entrega_desde;
        }
        $fch_entrega_hasta = $request->fch_entrega_hasta;
        if($request->fch_entrega_hasta==''){
            $fch_entrega_hasta = date('Y-m-d');
            $request->fch_entrega_hasta = $fch_entrega_hasta;
        }
        

        $lista = DB::table('tb_atencion')
                ->join('tb_laboratorio', 'tb_atencion.laboratorio_dest_id', '=', 'tb_laboratorio.id')
                ->join('tb_persona', 'tb_atencion.encargado_lab_id', '=', 'tb_persona.id')
                ->join('tb_persona as r', 'tb_atencion.recibido_id', '=', 'r.id')
                ->selectRaw("tb_atencion.* , tb_laboratorio.nombre_lab , CONCAT(tb_persona.nombres,' ', tb_persona.apellidos) as encargado, CONCAT(r.nombres,' ', r.apellidos) as responsable")
                
                ->whereRaw("tb_atencion.status_atencion='AC' and tb_atencion.`laboratorio_origen_id` = '".$x_laboratorio_id."' and `fch_entrega` >= '".$fch_entrega_desde."' and `fch_entrega` <= '".$fch_entrega_hasta."' ".$where_lab)
                ->orderBy('tb_atencion.id','DESC')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('atencion.lista_atencion',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Atencion::find($request->id);
            $dt->fch_pedido=$request->fch_pedido;
            $dt->hora_pedido=$request->hora_pedido;
            $dt->fch_entrega=$request->fch_entrega;
            $dt->hora_entrega=$request->hora_entrega;
            $dt->laboratorio_origen_id=$request->laboratorio_origen_id;
            $dt->laboratorio_dest_id=$request->laboratorio_dest_id;
            $dt->solicitado_id=$request->solicitado_id;
            $dt->cargo_solicitado=$request->cargo_solicitado;
            $dt->numdoc_solicitado=$request->numdoc_solicitado;
            $dt->autorizado_id=$request->autorizado_id;
            $dt->cargo_autorizado=$request->cargo_autorizado;
            $dt->numdoc_autorizado=$request->numdoc_autorizado;
            $dt->recibido_id=$request->recibido_id;
            $dt->encargado_lab_id=$request->encargado_lab_id;
            $dt->resp_atencion_id=$request->resp_atencion_id;
            
            $dt->id_usuariomod=Auth::id();
            $dt->save();
 

        }else{
            $dt=new Atencion();
            $dt->fch_pedido=$request->fch_pedido;
            $dt->hora_pedido=$request->hora_pedido;
            $dt->fch_entrega=$request->fch_entrega;
            $dt->hora_entrega=$request->hora_entrega;
            $dt->laboratorio_origen_id=$request->laboratorio_origen_id;
            $dt->laboratorio_dest_id=$request->laboratorio_dest_id;
            $dt->solicitado_id=$request->solicitado_id;
            $dt->cargo_solicitado=$request->cargo_solicitado;
            $dt->numdoc_solicitado=$request->numdoc_solicitado;
            $dt->autorizado_id=$request->autorizado_id;
            $dt->cargo_autorizado=$request->cargo_autorizado;
            $dt->numdoc_autorizado=$request->numdoc_autorizado;
            $dt->recibido_id=$request->recibido_id;
            $dt->encargado_lab_id=$request->encargado_lab_id;
            $dt->resp_atencion_id=$request->resp_atencion_id;

            $dt->id_usuarioreg=Auth::id();
            $dt->save();   

            $data = Atencion::latest('id')->first();
            $atencion_id = $data->id;
  

            if(isset($request->equipo_id )){

                foreach ($request->equipo_id as $fila) {
                    $equipo_id[] = $fila;
                }
                foreach ($request->unidad_med_min_id as $fila) {
                    $unidad_med_min_id[] = $fila;
                }
                foreach ($request->cantidad_equivalencia as $fila) {
                    $cantidad_equivalencia[] = $fila;
                }
                foreach ($request->cantidad_atencion_min as $fila) {
                    $cantidad_atencion_min[] = $fila;
                }
                foreach ($request->lote_equipo_id as $fila) {
                    $lote_equipo_id[] = $fila;
                }

            $nro_registros = count($equipo_id);  
            for ($i = 0; $i < $nro_registros; $i++) {
                //Registrar detalle
                $cantidad_atencion = round($cantidad_atencion_min[$i] / $cantidad_equivalencia[$i],3);
                $dtd=new Detalle_atencion();
                $dtd->equipo_id = $equipo_id[$i];
             //   $dtd->unidad_med_min_id = $unidad_med_min_id[$i];
                $dtd->cantidad_equivalencia = $cantidad_equivalencia[$i];
                $dtd->cantidad_atencion = $cantidad_atencion;
                $dtd->cantidad_atencion_min = $cantidad_atencion_min[$i];
                $dtd->lote_equipo_id = $lote_equipo_id[$i];
                $dtd->atencion_id = $atencion_id;
                
                //$dtd->id_usuarioreg=Auth::id();
                $dtd->save(); 

                $datad = Detalle_atencion::latest('id')->first();
                $detalle_atencion_id = $datad->id;

                //Descontar Stock del lote
                $info_LoteE = Lote_equipo::find($lote_equipo_id[$i]);
                $cantidad_lote = $info_LoteE->cantidad_lote;
                $cantidad_lote_min = $info_LoteE->cantidad_lote_min;

                $stock_cantidad_lote = $cantidad_lote - $cantidad_atencion;
                $stock_cantidad_lote_min = $cantidad_lote_min - $cantidad_atencion_min[$i];
                //actualizar stock               
                $info_LoteE->cantidad_lote = $stock_cantidad_lote;
                $info_LoteE->cantidad_lote_min = $stock_cantidad_lote_min;
                $info_LoteE->id_usuariomod=Auth::id();
                $info_LoteE->save();



                //Registrar movimiento
                $infoProdCant = DB::table('tb_lote_equipo as l')
                        ->whereRaw("l.equipo_id=".$equipo_id[$i]." and l.laboratorio_id=".$request->laboratorio_origen_id."  and status_lote!='EL'")
                        -> selectRaw("SUM(cantidad_lote) AS cantidad_equipo_lab")
                        ->first(); 
                    $cantidad_equipo_lab = $infoProdCant->cantidad_equipo_lab;// - $cantidad_atencion;                    

                $dtm=new Movimiento();
                $dtm->equipo_id=$equipo_id[$i];
                $dtm->lote_equipo_id = $lote_equipo_id[$i];
                $dtm->laboratorio_id=$request->laboratorio_origen_id;
                $dtm->tipo_movimiento_id= 4;//SALIDA POR ATENCION

                $dtm->cantidad_movimiento=$cantidad_atencion;
                $dtm->cantidad_min_movimiento=$cantidad_atencion_min[$i];
                $dtm->stock_lote=$stock_cantidad_lote;
                $dtm->stock_equipo_lab=$cantidad_equipo_lab;
                
                $dtm->detalle_atencion_id=$detalle_atencion_id ;
                $dtm->atencion_id=$atencion_id;

                $dtm->id_usuarioreg=Auth::id();
                $dtm->save();

            }
        }       
        }

        return redirect()->route('listar.atencion');
    }

    public function lista_recepcion(Request $request)
    {
        $laboratorio_id = Auth::user()->laboratorio_id;
        
        $fch_recepcion_desde = $request->fch_recepcion_desde;
        if($request->fch_recepcion_desde==''){
            $fch_recepcion_desde = date('Y-m-d');
            $request->fch_recepcion_desde = $fch_recepcion_desde;
        }
        $fch_recepcion_hasta = $request->fch_recepcion_hasta;
        if($request->fch_recepcion_hasta==''){
            $fch_recepcion_hasta = date('Y-m-d');
            $request->fch_recepcion_hasta = $fch_recepcion_hasta;
        }
 

        $lista = DB::table('tb_recepcion  as rc')
               ->leftjoin('tb_atencion as a', 'a.id', '=', 'rc.atencion_id')
                ->join('tb_laboratorio', 'rc.laboratorio_id', '=', 'tb_laboratorio.id')
                ->leftjoin('tb_proveedor as pr', 'rc.proveedor_id', '=', 'pr.id')
                ->leftjoin('tb_persona', 'rc.resp_recepcion_id', '=', 'tb_persona.id')

                ->selectRaw("rc.*, a.fch_pedido , tb_laboratorio.nombre_lab , CONCAT(tb_persona.nombres,' ', tb_persona.apellidos) as resp_recepcion, pr.proveedor, pr.ruc as ruc_proveedor")
                 ->whereRaw("rc.`laboratorio_id` = '".$laboratorio_id."' and `fecha_recepcion` >= '".$fch_recepcion_desde."' and `fecha_recepcion` <= '".$fch_recepcion_hasta."'")
                ->orderBy('rc.id','DESC')
                ->Paginate(10)->appends($request->except(['page','_token']));

        $listaPendiente = DB::table('tb_atencion as a')
                ->leftjoin('tb_recepcion as rc', 'a.id', '=', 'rc.atencion_id')
                ->join('tb_laboratorio', 'a.laboratorio_origen_id', '=', 'tb_laboratorio.id')
                ->join('tb_persona', 'a.resp_atencion_id', '=', 'tb_persona.id')
                ->join('tb_persona as r', 'a.solicitado_id', '=', 'r.id')

                ->whereRaw("a.`laboratorio_dest_id` = '".$laboratorio_id."' and rc.atencion_id is null")
                ->selectRaw("a.* , rc.id as recepcion_id, tb_laboratorio.nombre_lab , CONCAT(tb_persona.nombres,' ', tb_persona.apellidos) as resp_atencion, CONCAT(r.nombres,' ', r.apellidos) as resp_recibir")

                // selectRaw('select * ()')
                ->orderBy('a.id','desc')
                ->get();

        return view('atencion.lista_recepcion',['lista'=>$lista,'listapendiente'=>$listaPendiente,'databusqueda'=>$request]);
    }

    
    public function aceptar_recepcion(Request $request)
    {       
        $atencion_id = $request->atencion_id; 
        if ($atencion_id!='') {
            $atencion=Atencion::find($atencion_id);

            $dt=new Recepcion();
            $dt->atencion_id=$atencion_id;
            $dt->laboratorio_id=$atencion->laboratorio_dest_id;
            $dt->fecha_solicitud=$atencion->fecha_pedido;
            $dt->fecha_recepcion=$atencion->fch_entrega;
            $dt->resp_recepcion_id=$request->recibido_id;
                        
            //$dt->doc_sustento=$request->solicitado_id;
           
            $dt->id_usuarioreg=Auth::id();
            $dt->save();   
            $recepcion_id = $dt->id;
 

            $det_atencion = Detalle_atencion::where('atencion_id', $atencion_id)->get();
            foreach ($det_atencion as $fila) {

               

                $lote =Lote_equipo::find($fila->lote_equipo_id);


                $dtl=new Lote_equipo();
                $dtl->fch_fabricacion = $lote->fch_fabricacion;
                $dtl->fch_vencimiento = $lote->fch_vencimiento;
                $dtl->lote = $lote->lote;
                $dtl->cantidad_lote = $fila->cantidad_atencion;
                $dtl->cantidad_lote_min = $fila->cantidad_atencion_min;
                $dtl->equipo_id =$fila->equipo_id;
                $dtl->laboratorio_id = $atencion->laboratorio_dest_id;

                $dtl->id_usuarioreg=Auth::id();
                $dtl->save(); 
                $lote_equipo_id = $dtl->id;


                //Registrar detalle
                $dtd=new Detalle_recepcion();
                $dtd->equipo_id = $fila->equipo_id;
                $dtd->cantidad_equivalencia = $fila->cantidad_equivalencia;
                $dtd->cantidad_recepcion = $fila->cantidad_atencion;
                $dtd->cantidad_recepcion_min = $fila->cantidad_atencion_min;
                $dtd->lote_equipo_id = $lote_equipo_id;
                $dtd->recepcion_id = $recepcion_id;
                $dtd->detalle_atencion_id = $fila->id;
                $dtd->save(); 
                $detalle_recepcion_id = $dtd->id;
              
                //Sumar Stock del lote                
                $infoProdCant = DB::table('tb_lote_equipo as l')
                        ->whereRaw("l.equipo_id=".$fila->equipo_id." and l.laboratorio_id=".$atencion->laboratorio_dest_id." and status_lote!='EL'")
                        -> selectRaw("SUM(cantidad_lote) AS cantidad_equipo_lab")
                        ->first(); 
                $cantidad_equipo_lab = $infoProdCant->cantidad_equipo_lab + $fila->cantidad_atencion;                    

                $dtm=new Movimiento();
                $dtm->equipo_id=$fila->equipo_id;
                $dtm->lote_equipo_id = $lote_equipo_id;
                $dtm->laboratorio_id=$atencion->laboratorio_dest_id;
                $dtm->tipo_movimiento_id= 8;//8 INGRESO POR ATENCIÓN

                $dtm->cantidad_movimiento=$fila->cantidad_atencion;
                $dtm->cantidad_min_movimiento=$fila->cantidad_atencion_min;
                $dtm->stock_lote=$fila->cantidad_atencion;
                $dtm->stock_equipo_lab=$cantidad_equipo_lab;
                
                $dtm->detalle_recepcion_id=$detalle_recepcion_id ;
                $dtm->recepcion_id=$recepcion_id;

                $dtm->id_usuarioreg=Auth::id();
                $dtm->save();
                
            }            
        }
         return redirect()->route('listar.recepcion');
    }

public function borrar_atencion(Request $request)
    {
        $dt=Atencion::find($request->id);
        $dt->status_atencion='EL';
        $dt->id_usuarioelim=Auth::id();
        $dt->motivo_elim=$request->motivo;
        $dt->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dt->save(); 
        return redirect()->route('listar.atencion');
    }


    public function xxxxxxdestroy(Request $request)
    {
        $dt=User::find($request->id_usuario);
        $dt->sts_usuario='EL';
        $dt->id_usuarioelim=Auth::id();
        $dt->motivo_elim=$request->motivo;
        $dt->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dt->save(); 
        return redirect()->route('listar.usuarios');
    }

    public function modal_form_atencion(Request $request)
    {
        $dt=Atencion::find($request->id);
        return view('atencion.modal_form_atencion',['info'=>$dt]);
    }

    public function modal_form_recepcion(Request $request)
    {
        $dt=Recepcion::find($request->id);
        return view('atencion.modal_form_recepcion',['info'=>$dt]);
    }

    public function guardar_recepcion(Request $request)
    {    
        // Subir archivo
        $url_doc_sustento = '';
        if ($request->file('doc_sustento')) {
                $url_doc_sustento='Doc_Sustento'.Str::random(10).time().'.pdf';
                $path=public_path().'/files/doc_sustento';
                $request->file('doc_sustento')->move($path,$url_doc_sustento);
        }

        if ($request->id!='') {
            $dt=Recepcion::find($request->id);
            
            $dt->laboratorio_id=$request->laboratorio_id;
            $dt->proveedor_id=$request->proveedor_id;
            $dt->resp_recepcion_id=$request->resp_recepcion_id;
            $dt->fecha_solicitud=$request->fecha_solicitud;
            $dt->fecha_recepcion=$request->fecha_recepcion;
            $dt->numdoc_sustento=$request->numdoc_sustento;
            $dt->doc_sustento= $url_doc_sustento; 

            $dt->id_usuariomod=Auth::id();;
            $dt->save();  

            //$recepcion_id = $dt->id;

        }else{
            

            $dt=new Recepcion();
            $dt->laboratorio_id=$request->laboratorio_id;
            $dt->proveedor_id=$request->proveedor_id;
            $dt->resp_recepcion_id=$request->resp_recepcion_id;
            $dt->fecha_solicitud=$request->fecha_solicitud;
            $dt->fecha_recepcion=$request->fecha_recepcion;
            $dt->numdoc_sustento=$request->numdoc_sustento;
            $dt->doc_sustento= $url_doc_sustento;
            $dt->id_usuarioreg=Auth::id();
            $dt->save();   
            $recepcion_id = $dt->id;
 
            $equipo_id=$request->get('equipo_id');
            $fch_fabricacion=$request->get('fch_fabricacion');
            $fch_vencimiento=$request->get('fch_vencimiento');
            $lote=$request->get('lote');
            $cantidad_recepcion=$request->get('cantidad_recepcion');
            $cantidad_equivalencia=$request->get('cantidad_equivalencia');

            $i=0;
            while($i < count($equipo_id)){
                $cantidad_recepcion_min = $cantidad_recepcion[$i] * $cantidad_equivalencia[$i];

                $dtl=new Lote_equipo();
                $dtl->fch_fabricacion = $fch_fabricacion[$i];
                $dtl->fch_vencimiento = $fch_vencimiento[$i];
                $dtl->lote = $lote[$i];
                $dtl->cantidad_lote = $cantidad_recepcion[$i];
                $dtl->cantidad_lote_min = $cantidad_recepcion_min;
                $dtl->equipo_id =$equipo_id[$i];
                $dtl->laboratorio_id = $request->laboratorio_id;

                $dtl->id_usuarioreg=Auth::id();
                $dtl->save(); 
                $lote_equipo_id = $dtl->id;

                //Registrar detalle
                $dtd=new Detalle_recepcion();
                $dtd->equipo_id = $equipo_id[$i];
                $dtd->cantidad_equivalencia = $cantidad_equivalencia[$i];
                $dtd->cantidad_recepcion = $cantidad_recepcion[$i];
                $dtd->cantidad_recepcion_min = $cantidad_recepcion_min;
                $dtd->lote_equipo_id = $lote_equipo_id;
                $dtd->recepcion_id = $recepcion_id;
                //$dtd->detalle_atencion_id = $fila->id;
                $dtd->save(); 
                $detalle_recepcion_id = $dtd->id;

                //Sumar Stock del lote                
                $infoProdCant = DB::table('tb_lote_equipo as l')
                        ->whereRaw("l.equipo_id=".$equipo_id[$i]." and l.laboratorio_id=".$request->laboratorio_id." and status_lote!='EL'")
                        -> selectRaw("SUM(cantidad_lote) AS cantidad_equipo_lab")
                        ->first(); 
                $cantidad_equipo_lab = $infoProdCant->cantidad_equipo_lab + $cantidad_recepcion[$i];                    

                $dtm=new Movimiento();
                $dtm->equipo_id=$equipo_id[$i];
                $dtm->lote_equipo_id = $lote_equipo_id;
                $dtm->laboratorio_id=$request->laboratorio_id;
                $dtm->tipo_movimiento_id= 3;//3 INGRESO POR COMPRA

                $dtm->cantidad_movimiento=$cantidad_recepcion[$i];
                $dtm->cantidad_min_movimiento=$cantidad_recepcion_min;
                $dtm->stock_lote=$cantidad_recepcion[$i];
                $dtm->stock_equipo_lab=$cantidad_equipo_lab;
                
                $dtm->detalle_recepcion_id=$detalle_recepcion_id ;
                $dtm->recepcion_id=$recepcion_id;

                $dtm->id_usuarioreg=Auth::id();
                $dtm->save();


                $i+= 1;
            }
         
        }
        return redirect()->route('listar.recepcion');
    }

    //Requerimiento


    public function lista_requerimiento(Request $request)
    {   
       /* $PrivUsuario = UsuarioPermiso::PrivUsuario();
        if(!in_array("admin_todo_laboratorio", $PrivUsuario)) {
            if($request->laboratorio_id!='' and  $request->laboratorio_id!=Auth::user()->laboratorio_id){
                return view('no_tiene_permiso');
            }
        }*/

        $x_laboratorio_id = Auth::user()->laboratorio_id;
        $where_lab = "";
        if($request->laboratorio_dest_id!=''){
            $where_lab = " and rq.`laboratorio_dest_id` = '".$request->laboratorio_dest_id."' ";            
        }
 
        $fch_entrega_desde = $request->fch_entrega_desde;
        if($request->fch_entrega_desde==''){
            $fch_entrega_desde = date('Y-m-d');
            $request->fch_entrega_desde = $fch_entrega_desde;
        }
        $fch_entrega_hasta = $request->fch_entrega_hasta;
        if($request->fch_entrega_hasta==''){
            $fch_entrega_hasta = date('Y-m-d');
            $request->fch_entrega_hasta = $fch_entrega_hasta;
        }
        

        $lista = DB::table('tb_requerimiento as rq')
                ->join('tb_laboratorio', 'rq.laboratorio_dest_id', '=', 'tb_laboratorio.id')
                ->join('tb_persona', 'rq.encargado_lab_dest_id', '=', 'tb_persona.id')
                ->join('tb_persona as r', 'rq.solicitante_id', '=', 'r.id')
                ->leftjoin('tb_atencion as a', 'rq.id', '=', 'a.requerimiento_id')

                ->selectRaw("rq.*, a.id as atencion_id, a.fch_entrega, a.hora_entrega , tb_laboratorio.nombre_lab , CONCAT(tb_persona.nombres,' ', tb_persona.apellidos) as encargado, CONCAT(r.nombres,' ', r.apellidos) as resp_recibir, (SELECT SUM(dd.cantidad_devolucion) FROM `tb_detalle_atencion` AS da 
LEFT JOIN tb_detalle_devolucion dd ON da.`id` = dd.`detalle_atencion_id`
INNER JOIN `tb_equipo` eq ON da.`equipo_id` = eq.`id`
 WHERE da.`atencion_id` = a.id AND eq.tipo_equipo_id != 3) as cantDevuelto, (SELECT SUM(ad.cantidad_atencion) FROM `tb_detalle_atencion` AS ad 
INNER JOIN `tb_equipo` eq ON ad.`equipo_id` = eq.`id` WHERE ad.`atencion_id` = a.id AND eq.tipo_equipo_id != 3) as cantDevolver")
                
                ->whereRaw("IFNULL(rq.`id_usuarioelim`,0)=0 and rq.`laboratorio_origen_id` = '".$x_laboratorio_id."' and `fch_requerimiento` >= '".$fch_entrega_desde."' and `fch_requerimiento` <= '".$fch_entrega_hasta."' ".$where_lab)
                ->orderBy('rq.id','DESC')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('atencion.lista_requerimiento',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function modal_form_requerimiento(Request $request)
    {
        $dt=Requerimiento::find($request->id);
        return view('atencion.modal_form_requerimiento',['info'=>$dt]);
    }

      public function guardar_requerimiento(Request $request)
    {
        
        if ($request->id!='') {
            $dt=Requerimiento::find($request->id);
            
           
            $dt->laboratorio_origen_id=$request->laboratorio_origen_id;
            $dt->laboratorio_dest_id=$request->laboratorio_dest_id;
            $dt->encargado_lab_dest_id=$request->encargado_lab_dest_id;
            $dt->solicitante_id=$request->solicitante_id;
            $dt->nota_requerimiento=$request->nota_requerimiento;
            
            
            $dt->id_usuariomod=Auth::id();
            $dt->save();
 

        }else{
            $dt=new Requerimiento();
            $dt->fch_requerimiento=date('Y-m-d');
            $dt->hora_requerimiento=date('H:i:s');
            $dt->laboratorio_origen_id=$request->laboratorio_origen_id;
            $dt->laboratorio_dest_id=$request->laboratorio_dest_id;
            $dt->encargado_lab_dest_id=$request->encargado_lab_dest_id;
            $dt->solicitante_id=$request->solicitante_id;
            $dt->nota_requerimiento=$request->nota_requerimiento;

            $dt->id_usuarioreg=Auth::id();
            $dt->save();   
            $requerimiento_id = $dt->id;
  

            if(isset($request->equipo_id )){

                foreach ($request->equipo_id as $fila) {
                    $equipo_id[] = $fila;
                }
                foreach ($request->unidad_med_min_id as $fila) {
                    $unidad_med_min_id[] = $fila;
                }
                foreach ($request->cantidad_equivalencia as $fila) {
                    $cantidad_equivalencia[] = $fila;
                }
                foreach ($request->cantidad_requerimiento_min as $fila) {
                    $cantidad_requerimiento_min[] = $fila;
                }
                foreach ($request->lote_equipo_id as $fila) {
                    $lote_equipo_id[] = $fila;
                }

            $nro_registros = count($equipo_id);  
            for ($i = 0; $i < $nro_registros; $i++) {
                //Registrar detalle
                $cantidad_requerimiento = round($cantidad_requerimiento_min[$i] / $cantidad_equivalencia[$i],3);
                $dtd=new Detalle_requerimiento();
                $dtd->equipo_id = $equipo_id[$i];
             //   $dtd->unidad_med_min_id = $unidad_med_min_id[$i];
                $dtd->cantidad_equivalencia = $cantidad_equivalencia[$i];
                $dtd->cantidad_requerimiento = $cantidad_requerimiento;
                $dtd->cantidad_requerimiento_min = $cantidad_requerimiento_min[$i];
                $dtd->lote_equipo_id = $lote_equipo_id[$i];
                $dtd->requerimiento_id = $requerimiento_id;
                
                //$dtd->id_usuarioreg=Auth::id();
                $dtd->save(); 
            }
        }       
        }

        return redirect()->route('listar.requerimiento');
    }

    public function aceptar_requerimiento(Request $request)
    {       
        $requerimiento_id = $request->requerimiento_id; 
        if ($requerimiento_id!='') {
            $requerimiento=Requerimiento::find($requerimiento_id);

            $dt=new Atencion();
            $dt->requerimiento_id=$requerimiento_id;

            $dt->fch_pedido=$requerimiento->fch_requerimiento;
            $dt->hora_pedido=$requerimiento->hora_requerimiento;
            $dt->fch_entrega=date('Y-m-d');
            $dt->hora_entrega=date('H:i:s');
            $dt->laboratorio_origen_id=$requerimiento->laboratorio_origen_id;
            $dt->laboratorio_dest_id=$requerimiento->laboratorio_dest_id;
           /*
            $dt->solicitado_id=$request->solicitado_id;
            $dt->cargo_solicitado=$request->cargo_solicitado;
            $dt->numdoc_solicitado=$request->numdoc_solicitado;
            $dt->autorizado_id=$request->autorizado_id;
            $dt->cargo_autorizado=$request->cargo_autorizado;
            $dt->numdoc_autorizado=$request->numdoc_autorizado;
            
*/          $dt->encargado_lab_id=$requerimiento->encargado_lab_dest_id;
            $dt->recibido_id=$requerimiento->solicitante_id;
            $dt->resp_atencion_id=$request->resp_atencion_id;
 
            //$dt->doc_sustento=$request->solicitado_id;
           
            $dt->id_usuarioreg=Auth::id();
            $dt->save();   
            $atencion_id = $dt->id;
 

            $det_atencion = Detalle_requerimiento::where('requerimiento_id', $requerimiento_id)->get();
            foreach ($det_atencion as $fila) {

               $lote_equipo_id = NULL;
                $lote =Lote_equipo::find($fila->lote_equipo_id);
                //$dt->cantidad_lote=($lote->cantidad_lote_min/$fila->cantidad_equivalencia);//Creo eso es la mejor forma para disminuir exacto ya que aveces por decimales puede variar
                if($lote){
                    $lote->cantidad_lote= $lote->cantidad_lote-$fila->cantidad_requerimiento ;//Por ahora asi
                    $lote->cantidad_lote_min= $lote->cantidad_lote_min-$fila->cantidad_requerimiento_min;              
                    $lote->id_usuariomod=Auth::id();
                    $lote->save();

                    $dtl=new Lote_equipo();
                    $dtl->fch_fabricacion = $lote->fch_fabricacion;
                    $dtl->fch_vencimiento = $lote->fch_vencimiento;
                    $dtl->lote = $lote->lote;
                    $dtl->cantidad_lote = $fila->cantidad_requerimiento;
                    $dtl->cantidad_lote_min = $fila->cantidad_requerimiento_min;
                    $dtl->equipo_id =$fila->equipo_id;
                    $dtl->laboratorio_id = $requerimiento->laboratorio_dest_id;

                    $dtl->id_usuarioreg=Auth::id();
                    $dtl->save(); 
                    $lote_equipo_id = $dtl->id;
                }


                //Registrar detalle
                $dtd=new Detalle_atencion();
                $dtd->equipo_id = $fila->equipo_id;
                $dtd->cantidad_equivalencia = $fila->cantidad_equivalencia;
                $dtd->cantidad_atencion = $fila->cantidad_requerimiento;
                $dtd->cantidad_atencion_min = $fila->cantidad_requerimiento_min;
                $dtd->lote_equipo_id = $lote_equipo_id;
                $dtd->atencion_id = $atencion_id;
                $dtd->detalle_requerimiento_id = $fila->id;
                $dtd->save(); 
                $detalle_atencion_id = $dtd->id;
              
                //Sumar Stock del lote                
                $infoProdCant = DB::table('tb_lote_equipo as l')
                        ->whereRaw("l.equipo_id=".$fila->equipo_id." and l.laboratorio_id=".$requerimiento->laboratorio_origen_id." and status_lote!='EL'")
                        -> selectRaw("SUM(cantidad_lote) AS cantidad_equipo_lab")
                        ->first(); 
                $cantidad_equipo_lab = $infoProdCant->cantidad_equipo_lab;// - $fila->cantidad_requerimiento;                    

                $dtm=new Movimiento();
                $dtm->equipo_id=$fila->equipo_id;
                $dtm->lote_equipo_id = $lote_equipo_id;
                $dtm->laboratorio_id=$requerimiento->laboratorio_origen_id;
                $dtm->tipo_movimiento_id= 4;//4 SALIDA POR ATENCION

                $dtm->cantidad_movimiento=$fila->cantidad_requerimiento;
                $dtm->cantidad_min_movimiento=$fila->cantidad_requerimiento_min;
                $dtm->stock_lote=$fila->cantidad_requerimiento;
                $dtm->stock_equipo_lab=$cantidad_equipo_lab;
                
                $dtm->detalle_atencion_id=$detalle_atencion_id ;
                $dtm->atencion_id=$atencion_id;

                $dtm->id_usuarioreg=Auth::id();
                $dtm->save();
                
            }            
        }
         return redirect()->route('listar.requerimiento');
    }


    public function borrar_requerimiento(Request $request)
    {
       
        $dt=Requerimiento::find($request->id);
        
        
        //$dt->estado_equipo='EL'; 
        $dt->id_usuarioelim=Auth::id();
        $dt->motivo_elim=$request->motivo;
        $dt->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dt->save(); 

        return redirect()->route('listar.requerimiento');
    }
    
    public function modal_form_devolver(Request $request)
    {   $atencion_id = $request->atencion_id;
         $infoCab = DB::table('tb_atencion')
                ->join('tb_requerimiento', 'tb_atencion.requerimiento_id', '=', 'tb_requerimiento.id')
                ->join('tb_laboratorio', 'tb_atencion.laboratorio_dest_id', '=', 'tb_laboratorio.id')
                 ->join('tb_facultad', 'tb_laboratorio.facultad_id', '=', 'tb_facultad.id')       
                ->join('tb_persona', 'tb_atencion.encargado_lab_id', '=', 'tb_persona.id')
                ->join('tb_persona as r', 'tb_atencion.recibido_id', '=', 'r.id')
                ->selectRaw("tb_requerimiento.nota_requerimiento, tb_atencion.*,tb_atencion.id as atencion_id, tb_facultad.nom_facultad , tb_laboratorio.nombre_lab , CONCAT(tb_persona.nombres,' ', tb_persona.apellidos) as encargado, CONCAT(r.nombres,' ', r.apellidos) as responsable, r.num_doc as dni_responsable")                
                ->whereRaw("tb_atencion.id = ".$atencion_id)->first();


        $gridDet = DB::table('tb_detalle_atencion as da')
                ->join('tb_equipo as e', 'da.equipo_id', '=', 'e.id')
                ->join('tb_unidad_medida as um', 'e.unidad_medida_id', '=', 'um.id')
                ->join('tb_unidad_medida as umm', 'e.unidad_med_min_id', '=', 'umm.id')
                ->join('tb_lote_equipo as le', 'da.lote_equipo_id', '=', 'le.id')
                //->join('tb_persona as r', 'tb_atencion.recibido_id', '=', 'r.id')
                ->selectRaw("e.*, da.*,da.id as detalle_atencion_id, um.unidad_medida,umm.unidad_medida as unidad_med_min, le.lote, le.fch_vencimiento, (SELECT SUM(cantidad_devolucion) FROM `tb_detalle_devolucion` AS dd WHERE dd.`detalle_atencion_id` = da.id) as cantidad_devolucion")                
                ->whereRaw("da.atencion_id = ".$atencion_id)->get();

        return view('atencion.modal_form_devolucion',['infoCab'=>$infoCab,'gridDet'=>$gridDet]);
    }

      public function guardar_devolucion(Request $request)
    {       

        $atencion_id = $request->atencion_id; 
        $x_laboratorio = Auth::user()->laboratorio_id;
        if ($atencion_id!='') {
         
            $dt=new Devolucion();
            $dt->atencion_id=$atencion_id;            
           
            $dt->id_usuarioreg=Auth::id();
            $dt->save();   
            $devolucion_id = $dt->id;
 
            $equipo_id=$request->get('equipo_id');
            $detalle_atencion_id=$request->get('detalle_atencion_id');
            $cantidad_devolucion=$request->get('cantidad_devolucion');
            $tipo_equipo_id=$request->get('tipo_equipo_id');
            $x_lote_equipo_id=$request->get('lote_equipo_id');
            
              
            $i=0;
            while($i < count($equipo_id)){
               //
                if($cantidad_devolucion[$i]>0){
                
 
                $lote_equipo_id = NULL;

                if($x_lote_equipo_id[$i]>0){

                    $lote =Lote_equipo::find($x_lote_equipo_id[$i]);
                    //$dt->cantidad_lote=($lote->cantidad_lote_min/$fila->cantidad_equivalencia);//Creo eso es la mejor forma para disminuir exacto ya que aveces por decimales puede variar
                    if($lote){
                        $lote->cantidad_lote= $lote->cantidad_lote-$cantidad_devolucion[$i] ;//Por ahora asi
                        $lote->cantidad_lote_min= $lote->cantidad_lote_min-$cantidad_devolucion[$i];              
                        $lote->id_usuariomod=Auth::id();
                        $lote->save();

                        $dtl=new Lote_equipo();
                        $dtl->fch_fabricacion = $lote->fch_fabricacion;
                        $dtl->fch_vencimiento = $lote->fch_vencimiento;
                        $dtl->lote = $lote->lote;
                        $dtl->cantidad_lote = $cantidad_devolucion[$i];
                        $dtl->cantidad_lote_min = $cantidad_devolucion[$i];
                        $dtl->equipo_id =$equipo_id[$i];
                        $dtl->laboratorio_id = $x_laboratorio;

                        $dtl->id_usuarioreg=Auth::id();
                        $dtl->save(); 
                        $lote_equipo_id = $dtl->id;
                    }
                }



                //Registrar detalle
                $dtd=new Detalle_devolucion();
                $dtd->equipo_id = $equipo_id[$i];
                $dtd->cantidad_devolucion = $cantidad_devolucion[$i];                
                $dtd->lote_equipo_id = $lote_equipo_id;
                $dtd->devolucion_id = $devolucion_id;
                $dtd->detalle_atencion_id = $detalle_atencion_id[$i];
                $dtd->save(); 
                $detalle_devolucion_id = $dtd->id;
            
                 if($tipo_equipo_id[$i]>1){//No es equipo
                    //Sumar Stock del lote                
                    $infoProdCant = DB::table('tb_lote_equipo as l')
                            ->whereRaw("l.equipo_id=".$equipo_id[$i]." and l.laboratorio_id=".$x_laboratorio." and status_lote!='EL'")
                            -> selectRaw("SUM(cantidad_lote) AS cantidad_equipo_lab")
                            ->first(); 
                    $cantidad_equipo_lab = $infoProdCant->cantidad_equipo_lab + $cantidad_devolucion[$i];                    

                    $dtm=new Movimiento();
                    $dtm->equipo_id=$equipo_id[$i];
                    $dtm->lote_equipo_id = $lote_equipo_id;
                    $dtm->laboratorio_id=$x_laboratorio;
                    $dtm->tipo_movimiento_id= 9;//9 INGRESO POR DEVOLUCIÓN

                    $dtm->cantidad_movimiento=$cantidad_devolucion[$i];
                    $dtm->cantidad_min_movimiento=$cantidad_devolucion[$i];
                    $dtm->stock_lote=$cantidad_devolucion[$i];
                    $dtm->stock_equipo_lab=$cantidad_equipo_lab;
                    
                    $dtm->detalle_devolucion_id=$detalle_devolucion_id ;
                    $dtm->devolucion_id=$devolucion_id;

                    $dtm->id_usuarioreg=Auth::id();
                    $dtm->save();
                }
                }
                $i++;
            }            
        }
         return redirect()->route('listar.requerimiento');
    }



    
}