<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipo;
use App\Models\Equipo_seguridad_lab;
use App\Models\Lote_equipo;
use App\Models\Movimiento;
use App\Models\Laboratorio;
use App\Models\Inventario_data;//Cargado excel del control patrimonial
use App\Models\UsuarioPermiso;
use Illuminate\Support\Str;
use DB;
use File;



class EquipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    }
    public function lista_equipos(Request $request)
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
            $where = " and tb_equipo.`laboratorio_id` = '".$x_laboratorio_id."' ";            
        }else if($request->laboratorio_id!='TODOS'){
            $where = " and tb_equipo.`laboratorio_id` = '".$request->laboratorio_id."' ";            
        }  


        
        if($request->responsable_id!=''){
            $where = " and `responsable_id` = '".$request->responsable_id."' ";       
        }
        if($request->responsable_id!=''){
            $wherex = " and `responsable_id` LIKE '%".$request->username."%' ";            
        }

        $lista = DB::table('tb_equipo')
                ->whereRaw("tipo_equipo_id=1 and IFNULL(estado_equipo,'') <> 'EL' and `nom_equipo` LIKE '%".$request->nom_equipo."%' ".$where)
                ->join('tb_unidad_medida', 'tb_equipo.unidad_medida_id', '=', 'tb_unidad_medida.id')
                ->join('tb_laboratorio', 'tb_equipo.laboratorio_id', '=', 'tb_laboratorio.id')
                ->join('tb_persona', 'tb_equipo.responsable_id', '=', 'tb_persona.id')
                ->leftjoin('tb_proveedor', 'tb_equipo.proveedor_id', '=', 'tb_proveedor.id')

                ->select('tb_equipo.*', 'tb_unidad_medida.unidad_medida', 'tb_laboratorio.nombre_lab','tb_persona.nombres','tb_persona.apellidos','tb_proveedor.proveedor')
                // selectRaw('select * ()')
                ->orderBy('tb_equipo.id','ASC')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('equipos.lista_equipos',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function lista_material(Request $request)
    {
        $PrivUsuario = UsuarioPermiso::PrivUsuario();
        if(!in_array("admin_todo_laboratorio", $PrivUsuario)) {
            if($request->laboratorio_id!='' and  $request->laboratorio_id!=Auth::user()->laboratorio_id){
                return view('no_tiene_permiso');
            }
        }
        $x_laboratorio_id = Auth::user()->laboratorio_id;
        $where_lab = "";
        $where_cant_lab = "";
        if($request->laboratorio_id==''){
            $request->laboratorio_id = $x_laboratorio_id;
            $where_lab = " and leq.`laboratorio_id` = '".$x_laboratorio_id."' ";            
            $where_cant_lab = " AND le.laboratorio_id = '".$x_laboratorio_id."'";
        }else if($request->laboratorio_id!='TODOS'){
            $where_lab = " and leq.`laboratorio_id` = '".$request->laboratorio_id."' ";            
            $where_cant_lab = " AND le.laboratorio_id = '".$x_laboratorio_id."'";
        }            
          
        $where = '';
        if($request->marca!=''){
            $where .= " and `marca` LIKE '%".$request->marca."%' ";       
        }
        if($request->serie!=''){
            $where .= " and `serie` LIKE '%".$request->serie."%' ";            
        }

        if($request->stock!=''){
            if($request->stock=='consk'){
                $where .= "and (SELECT SUM(cantidad_lote) AS cantidad_lote FROM `tb_lote_equipo` le WHERE le.equipo_id = tb_equipo.id AND le.laboratorio_id = tb_equipo.laboratorio_id and status_lote != 'EL') > 0";    
            }else if($request->stock=='sk0'){
                $where .= "and (SELECT SUM(cantidad_lote) AS cantidad_lote FROM `tb_lote_equipo` le WHERE le.equipo_id = tb_equipo.id AND le.laboratorio_id = tb_equipo.laboratorio_id and status_lote != 'EL') = 0";    
            }else if($request->stock=='skneg'){
                $where .= "and (SELECT SUM(cantidad_lote) AS cantidad_lote FROM `tb_lote_equipo` le WHERE le.equipo_id = tb_equipo.id AND le.laboratorio_id = tb_equipo.laboratorio_id and status_lote != 'EL') < 0";    
            }else if($request->stock=='skmin'){
                $where .= "and (SELECT SUM(cantidad_lote) AS cantidad_lote FROM `tb_lote_equipo` le WHERE le.equipo_id = tb_equipo.id AND le.laboratorio_id = tb_equipo.laboratorio_id and status_lote != 'EL') <= tb_equipo.stock_minimo";    
            }

                       
        }

        
       

        $lista = DB::table('tb_equipo')
                ->join('tb_unidad_medida', 'tb_equipo.unidad_medida_id', '=', 'tb_unidad_medida.id')
                ->join('tb_tipo_fiscalizado as f', 'tb_equipo.tipo_fiscalizado_id', '=', 'f.id')

                ->selectRaw("tb_equipo.*,tb_unidad_medida.unidad_medida, f.tipo_fiscalizado, (SELECT SUM(cantidad_lote) AS cantidad_lote FROM `tb_lote_equipo` le WHERE le.equipo_id = tb_equipo.id ".$where_cant_lab." and status_lote != 'EL') as cantidad_lote 
                    ")
                ->whereRaw(" tipo_equipo_id=2 and IFNULL(estado_equipo,'') <> 'EL' and `nom_equipo` LIKE '%".$request->nom_equipo."%' and exists (
    SELECT 1 FROM `tb_lote_equipo` leq where leq.`equipo_id` = tb_equipo.id ".$where_lab."
) ".$where)
                
                ->orderBy('tb_equipo.nom_equipo','ASC')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('equipos.lista_material',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function lista_insumos(Request $request)
    {
        $PrivUsuario = UsuarioPermiso::PrivUsuario();
        if(!in_array("admin_todo_laboratorio", $PrivUsuario)) {
            if($request->laboratorio_id!='' and  $request->laboratorio_id!=Auth::user()->laboratorio_id){
                return view('no_tiene_permiso');
            }
        }
        $x_laboratorio_id = Auth::user()->laboratorio_id;
        $where_lab = "";
        if($request->laboratorio_id==''){
            $request->laboratorio_id = $x_laboratorio_id;
            $where_lab = " and leq.`laboratorio_id` = '".$x_laboratorio_id."' ";            
        }else if($request->laboratorio_id!='TODOS'){
            $where_lab = " and leq.`laboratorio_id` = '".$request->laboratorio_id."' ";            
        }            
          
        $where = '';
        if($request->marca!=''){
            $where .= " and `marca` LIKE '%".$request->marca."%' ";       
        }
        if($request->serie!=''){
            $where .= " and `serie` LIKE '%".$request->serie."%' ";            
        }
        if($request->tipo_fiscalizado_id!=''){
            $where .= " and `tipo_fiscalizado_id` = '".$request->tipo_fiscalizado_id."' ";
        }

        $lista = DB::table('tb_equipo')
                ->join('tb_unidad_medida', 'tb_equipo.unidad_medida_id', '=', 'tb_unidad_medida.id')
                ->join('tb_tipo_fiscalizado as f', 'tb_equipo.tipo_fiscalizado_id', '=', 'f.id')

                ->selectRaw("tb_equipo.*,tb_unidad_medida.unidad_medida, f.tipo_fiscalizado, (SELECT SUM(cantidad_lote) AS cantidad_lote FROM `tb_lote_equipo` le WHERE le.equipo_id = tb_equipo.id AND le.laboratorio_id = tb_equipo.laboratorio_id and status_lote != 'EL') as cantidad_lote 
                    ")
                ->whereRaw(" tipo_equipo_id=3 and IFNULL(estado_equipo,'') <> 'EL' and `nom_equipo` LIKE '%".$request->nom_equipo."%' and exists (
    SELECT 1 FROM `tb_lote_equipo` leq where leq.`equipo_id` = tb_equipo.id ".$where_lab."
) ".$where)
                
                ->orderBy('tb_equipo.nom_equipo','ASC')
                ->Paginate(10)->appends($request->except(['page','_token']));

        return view('equipos.lista_insumos',['lista'=>$lista,'databusqueda'=>$request]);
    }


    public function store(Request $request)
    {        
        $equipo_id = 0;
        
        // Subir archivo
        $url_plan_mantenimiento = $request->f_plan_mantenimiento;
        if ($request->file('plan_mantenimiento')) {
                $url_plan_mantenimiento='Plan_Mantenimiento_'.Str::random(10).time().'.pdf';
                $path=public_path().'/files/plan_mantenimiento';
                $request->file('plan_mantenimiento')->move($path,$url_plan_mantenimiento);
        }

        if($request->equipo_id>0 and $request->accion=='solo_agregar_lote'){
            $equipo_id = $request->equipo_id;
        }else if ($request->id!='') {
            $dt=Equipo::find($request->id);
           // var_dump($dt);
            $dt->tipo_equipo_id=$request->tipo_equipo_id;
            $dt->cod_patrimonio=$request->cod_patrimonio;
            $dt->nom_equipo=$request->nom_equipo;
            $dt->proveedor_id=$request->proveedor_id;
            $dt->unidad_medida_id=$request->unidad_medida_id;
            $dt->laboratorio_id=$request->laboratorio_id;
            $dt->responsable_id=$request->responsable_id;
            $dt->estado_equipo=$request->estado_equipo;

            $dt->marca=$request->marca;
            $dt->ubicacion=$request->ubicacion;
            //$dt->ubicacion=$request->ubicacion;
            //$dt->ubicacion=$request->ubicacion;
            
         
            $dt->serie=$request->serie;
            $dt->especificacion=$request->especificacion;
            $dt->concentracion=$request->concentracion;
            $dt->unidad_med_min_id=$request->unidad_med_min_id;
            $dt->cantidad_min=$request->cantidad_min;
            if($request->unidad_med_min_id==''){
                $dt->unidad_med_min_id=$request->unidad_medida_id;
                $dt->cantidad_min=1;//$request->cantidad_min;
            }

            $dt->tipo_fiscalizado_id = $request->tipo_fiscalizado_id;

           // if($url_plan_mantenimiento!=''){
                $dt->plan_mantenimiento=$url_plan_mantenimiento;
           // }

            $dt->fecha_ult_mantenimiento = $request->fecha_ult_mantenimiento;
            $dt->fecha_prox_mantenimiento = $request->fecha_prox_mantenimiento;
            $dt->stock_minimo = $request->stock_minimo;

            $dt->fch_ini_garantia = $request->fch_ini_garantia;
            $dt->fch_fin_garantia = $request->fch_fin_garantia;


            $dt->id_usuariomod=Auth::id();
          //  $dt->id_usuarioelim=Auth::id();
            $dt->save();  
            $equipo_id = $request->id;


            //Editar stock de materiales
                 //Actualizar
            if($dt->tipo_equipo_id==2){//Materiales



                //Actualizar por que si es igual a 0 No va a funcionar
                 DB::table('tb_lote_equipo')
                    ->where('equipo_id', $equipo_id)
                    ->where('laboratorio_id', $request->laboratorio_id)
                    ->where('cantidad_lote_min','>', 0)
                    ->update(array('cantidad_lote' => $request->cantidad_lote,'cantidad_lote_min' => $request->cantidad_lote));  
                
                $infoLoteM = DB::table('tb_lote_equipo as le')
               // ->selectRaw("SUM(cantidad_lote) AS cantidad_lote                     ")
                ->whereRaw(" le.equipo_id = $equipo_id AND le.laboratorio_id = $request->laboratorio_id and status_lote != 'EL'")
                ->first();

                 
                $dtm=new Movimiento();
                $dtm->equipo_id=$equipo_id;
                $dtm->lote_equipo_id = $infoLoteM->id;
                $dtm->laboratorio_id=$request->laboratorio_id;
                $dtm->tipo_movimiento_id= 2;//2 REGULARIZACIÓN DEL ALMACEN

                $dtm->cantidad_movimiento=$request->cantidad_lote;
                $dtm->cantidad_min_movimiento=$request->cantidad_lote;
            
                $dtm->stock_lote=$request->cantidad_lote;
                $dtm->stock_equipo_lab=$request->cantidad_lote;
                $dtm->id_usuarioreg=Auth::id(); 
                $dtm->save();
            }




        }else{ 
            $dt=new Equipo();

            $dt->tipo_equipo_id=$request->tipo_equipo_id;
            //$dt->laboratorio_id=$request->laboratorio_id;
            $dt->cod_patrimonio=$request->cod_patrimonio;
            $dt->nom_equipo=$request->nom_equipo;
            $dt->proveedor_id=$request->proveedor_id;
            $dt->unidad_medida_id=$request->unidad_medida_id;
            $dt->laboratorio_id=$request->laboratorio_id;
            $dt->responsable_id=$request->responsable_id;
            $dt->estado_equipo=$request->estado_equipo;

            $dt->marca=$request->marca;
            $dt->ubicacion=$request->ubicacion;
            
            $dt->serie=$request->serie;
            $dt->especificacion=$request->especificacion;
            $dt->concentracion=$request->concentracion;

            $dt->unidad_med_min_id=$request->unidad_med_min_id;
            $dt->cantidad_min=$request->cantidad_min;
            if($request->unidad_med_min_id==''){
                $dt->unidad_med_min_id=$request->unidad_medida_id;
                $dt->cantidad_min=1;
            }


            $dt->tipo_fiscalizado_id = $request->tipo_fiscalizado_id;

            if($url_plan_mantenimiento!=''){
                $dt->plan_mantenimiento=$url_plan_mantenimiento;
            }
            
            $dt->fecha_ult_mantenimiento = $request->fecha_ult_mantenimiento;
            $dt->fecha_prox_mantenimiento = $request->fecha_prox_mantenimiento;
            $dt->stock_minimo = $request->stock_minimo;

            $dt->fch_ini_garantia = $request->fch_ini_garantia;
            $dt->fch_fin_garantia = $request->fch_fin_garantia;
            
            $dt->id_usuarioreg=Auth::id();
            $dt->save(); 

            $data = Equipo::latest('id')->first();
            $equipo_id = $data->id;


        }

    

            if(isset($request->fch_fabricacion )){


                foreach ($request->fch_fabricacion as $fila) {
                    $fch_fabricacion[] = $fila;
                }
                foreach ($request->fch_vencimiento as $fila) {
                    $fch_vencimiento[] = $fila;
                }
                foreach ($request->lote as $fila) {
                    $lote[] = $fila;
                }
                foreach ($request->cantidad_lote as $fila) {
                    $cantidad_lote[] = $fila;
                }
                foreach ($request->cantidad_lote_min as $fila) {
                    $cantidad_lote_min[] = $fila;
                }

                $nro_registros = count($fch_fabricacion);
                $suma_stock = 0;
                for ($i = 0; $i < $nro_registros; $i++) {
                    $dtd=new Lote_equipo();
                    $dtd->fch_fabricacion = $fch_fabricacion[$i];
                    $dtd->fch_vencimiento = $fch_vencimiento[$i];
                    $dtd->lote = $lote[$i];
                    $dtd->cantidad_lote = $cantidad_lote[$i];
                    $dtd->cantidad_lote_min = $cantidad_lote_min[$i];
                    $dtd->equipo_id =$equipo_id;
                    $dtd->laboratorio_id = $request->laboratorio_id;

                    $dtd->id_usuarioreg=Auth::id();
                    $dtd->save(); 

                    $datal = Lote_equipo::latest('id')->first();
                    $lote_equipo_id = $datal->id;
                    $suma_stock += $cantidad_lote[$i]; 

                    $dtm=new Movimiento();
                    $dtm->equipo_id=$equipo_id;
                    $dtm->lote_equipo_id = $lote_equipo_id;
                    $dtm->laboratorio_id=$request->laboratorio_id;
                    $dtm->tipo_movimiento_id= 1;//1 REGISTRO INICIAL

                    $dtm->cantidad_movimiento=$cantidad_lote[$i];
                    $dtm->cantidad_min_movimiento=$cantidad_lote_min[$i];
                
                    $dtm->stock_lote=$cantidad_lote[$i];
                    $dtm->stock_equipo_lab=$suma_stock;
                    
                   // $dtm->detalle_atencion_id=$detalle_atencion_id ;
                    //$dtm->atencion_id=$atencion_id;

                    $dtm->id_usuarioreg=Auth::id();
                    $dtm->save();

                }
            }
        

       

        if($request->tipo_equipo_id==1){
            return redirect()->route('listar.equipos','laboratorio_id='.$request->laboratorio_id);
        }else if($request->tipo_equipo_id==2){
            return redirect()->route('listar.material','laboratorio_id='.$request->laboratorio_id);
        }else{
           return redirect()->route('listar.insumos','laboratorio_id='.$request->laboratorio_id);
        }

            
    }

    public function guardar_stock_insumos(Request $request)
    {        
        $equipo_id = 0;        
        if ($request->equipo_id!='') {
            $equipo_id = $request->equipo_id;
            $laboratorio_id = $request->laboratorio_id;

            if(isset($request->fch_fabricacion )){

                foreach ($request->lote_equipo_id as $fila) {
                    $lote_equipo_id[] = $fila;
                }

                foreach ($request->fch_fabricacion as $fila) {
                    $fch_fabricacion[] = $fila;
                }
                foreach ($request->fch_vencimiento as $fila) {
                    $fch_vencimiento[] = $fila;
                }
                foreach ($request->lote as $fila) {
                    $lote[] = $fila;
                }
                foreach ($request->cantidad_lote as $fila) {
                    $cantidad_lote[] = $fila;
                }
                foreach ($request->cantidad_lote_min as $fila) {
                    $cantidad_lote_min[] = $fila;
                }

                //Eliminar lotes que se han quitado
                //Obtener todo los lotes para comparar cuales han sido quitado o eliminado 
                $loteanterior = DB::table('tb_lote_equipo')
                    ->where('equipo_id', '=',$equipo_id)
                    ->where('laboratorio_id', '=', $laboratorio_id)
                    ->where('cantidad_lote_min', '>', 0)
                    ->where('status_lote', '=', 'AC')
                    ->select('id')
                    ->get();
                foreach ($loteanterior as $fila) {
                     $lote_equipo_id_BD[] = $fila->id;
                }
                $lotes_eliminado = array_diff($lote_equipo_id_BD, $lote_equipo_id);
                foreach ($lotes_eliminado as $lote_id) {
                    $Lote_El = Lote_equipo::find($lote_id);
                    $Lote_El->status_lote=  'EL';
                    $Lote_El->id_usuarioelim=Auth::id();
                    $Lote_El->deleted_at= date('Y-m-d H:i:s');
                    $Lote_El->save();

                    $dtm=new Movimiento();
                    $dtm->equipo_id=$equipo_id;
                    $dtm->lote_equipo_id = $lote_id;
                    $dtm->laboratorio_id=$laboratorio_id;
                    $dtm->tipo_movimiento_id= 7;//7 ANULACION DE LOTE POR REG. DE STOCK

                    $dtm->cantidad_movimiento=0;
                    $dtm->cantidad_min_movimiento=0;
                
                    $dtm->stock_lote=0;
                    $dtm->stock_equipo_lab=0;
                    
                   // $dtm->detalle_atencion_id=$detalle_atencion_id ;
                    //$dtm->atencion_id=$atencion_id;

                    $dtm->id_usuarioreg=Auth::id(); 
                    $dtm->save();
                }
                 

                //Insertar o actualizar los lotes
                $nro_registros = count($fch_fabricacion);
                $suma_stock = 0;
                for ($i = 0; $i < $nro_registros; $i++){
                    $suma_stock += $cantidad_lote[$i];

                    if($lote_equipo_id[$i]>0){
                        //Actualizar
                        $info_LoteE = Lote_equipo::find($lote_equipo_id[$i]); 
                        $info_LoteE->fch_fabricacion = $fch_fabricacion[$i];
                        $info_LoteE->fch_vencimiento = $fch_vencimiento[$i];
                        $info_LoteE->lote = $lote[$i];

                        $info_LoteE->cantidad_lote = $cantidad_lote[$i];
                        $info_LoteE->cantidad_lote_min = $cantidad_lote_min[$i];
                        $info_LoteE->status_lote=  'AC';
                        $info_LoteE->id_usuariomod=Auth::id();
                        $info_LoteE->save();

                        $dtm=new Movimiento();
                        $dtm->equipo_id=$equipo_id;
                        $dtm->lote_equipo_id = $lote_equipo_id[$i];
                        $dtm->laboratorio_id=$laboratorio_id;
                        $dtm->tipo_movimiento_id= 2;//2 REGULARIZACIÓN DEL ALMACEN

                        $dtm->cantidad_movimiento=$cantidad_lote[$i];
                        $dtm->cantidad_min_movimiento=$cantidad_lote_min[$i];
                    
                        $dtm->stock_lote=$cantidad_lote[$i];
                        $dtm->stock_equipo_lab=$suma_stock;
                        
                       // $dtm->detalle_atencion_id=$detalle_atencion_id ;
                        //$dtm->atencion_id=$atencion_id;

                        $dtm->id_usuarioreg=Auth::id(); 
                        $dtm->save();


                    }else{
                        //Nuevo
                    $dtd=new Lote_equipo();
                    $dtd->fch_fabricacion = $fch_fabricacion[$i];
                    $dtd->fch_vencimiento = $fch_vencimiento[$i];
                    $dtd->lote = $lote[$i];
                    $dtd->cantidad_lote = $cantidad_lote[$i];
                    $dtd->cantidad_lote_min = $cantidad_lote_min[$i];
                    $dtd->equipo_id =$equipo_id;
                    $dtd->laboratorio_id = $laboratorio_id;

                    $dtd->id_usuarioreg=Auth::id();
                    $dtd->save(); 

                    $datal = Lote_equipo::latest('id')->first();
                    $lote_equipo_id = $datal->id;
 

                    $dtm=new Movimiento();
                    $dtm->equipo_id=$equipo_id;
                    $dtm->lote_equipo_id = $lote_equipo_id;
                    $dtm->laboratorio_id=$laboratorio_id;
                    $dtm->tipo_movimiento_id= 1;//1 REGISTRO INICIAL

                    $dtm->cantidad_movimiento=$cantidad_lote[$i];
                    $dtm->cantidad_min_movimiento=$cantidad_lote_min[$i];
                
                    $dtm->stock_lote=$cantidad_lote[$i];
                    $dtm->stock_equipo_lab=$suma_stock;
                    
                   // $dtm->detalle_atencion_id=$detalle_atencion_id ;
                    //$dtm->atencion_id=$atencion_id;

                    $dtm->id_usuarioreg=Auth::id();
                    $dtm->save();

                    }
                }
            }

            //Fin
        }

        if($request->tipo_equipo_id==1){
            return redirect()->route('listar.equipos','laboratorio_id='.$request->laboratorio_id);
        }else if($request->tipo_equipo_id==2){
            return redirect()->route('listar.material','laboratorio_id='.$request->laboratorio_id);
        }else{
           return redirect()->route('listar.insumos','laboratorio_id='.$request->laboratorio_id);
        }
    }

    public function destroy(Request $request)
    {
       
        $dt=Equipo::find($request->id);
        
        if($request->estado_equipo!=''){
            $dt->estado_equipo=$request->estado_equipo;
        }else{
            $dt->estado_equipo='EL';
        }

        $dt->id_usuarioelim=Auth::id();
        $dt->motivo_elim=$request->motivo;
        $dt->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dt->save(); 

        if($request->tipo_equipo_id==1){
            return redirect()->route('listar.equipos');
        }else if($request->tipo_equipo_id==2){
            return redirect()->route('listar.material');
        }else{
            return redirect()->route('listar.insumos');
        }
    }

    public function modal_form_equipos(Request $request)
    {
        $dt=Equipo::find($request->id);
        return view('equipos.modal_form_equipos',['info'=>$dt]);
    }

    public function modal_form_material(Request $request)
    {
        $dt=Equipo::find($request->id);
        return view('equipos.modal_form_material',['info'=>$dt]);
    }

    public function modal_form_insumos(Request $request)
    {
        $dt=Equipo::find($request->id); 
        $lt = Lote_equipo::where('equipo_id', $request->id)
                            ->where('laboratorio_id', $request->laboratorio_id)
                            ->where('status_lote', 'AC')->get();
        
        return view('equipos.modal_form_insumos',['info'=>$dt,'lote_equipo'=>$lt]);
    }

    public function modal_form_agregar_insumo_lab(Request $request)
    {
        return view('equipos.modal_form_agregar_insumo_lab',[]);
    }


    public function modal_form_stock_insumos(Request $request)
    {
       // $dt=Equipo::find($request->id); 
        $info = DB::table('tb_equipo as e')
                ->whereRaw("e.id=".$request->id)
                ->join('tb_unidad_medida as um', 'e.unidad_medida_id', '=', 'um.id')
                ->join('tb_unidad_medida as ummin', 'e.unidad_med_min_id', '=', 'ummin.id')
                ->join('tb_tipo_fiscalizado as f', 'e.tipo_fiscalizado_id', '=', 'f.id')

                //->select('tb_equipo.*', 'tb_unidad_medida.unidad_medida', 'tb_laboratorio.nombre_lab')
                -> selectRaw('e.*,um.unidad_medida,ummin.unidad_medida as unidad_med_min, f.tipo_fiscalizado')
                ->first();
        $lt = DB::table('tb_lote_equipo as le')
                ->whereRaw("le.equipo_id=".$request->id." and le.laboratorio_id=".$request->laboratorio_id." AND  status_lote != 'EL'")
                -> selectRaw("le.*, (SELECT COUNT(id) FROM `tb_movimiento` m 
WHERE m.lote_equipo_id = le.id AND m.tipo_movimiento_id NOT IN(1,2,7)) as cant_movimiento")
                ->get();
                //1 Registro, 2 Modificacion, 7 Anulacion esos no han sido movimientos por atencion

       // $lt = Lote_equipo::where('equipo_id', $request->id)->where('laboratorio_id', $request->laboratorio_id)->get();
        $infolab=Laboratorio::find($request->laboratorio_id); 
        
        return view('equipos.modal_form_stock_insumos',['info'=>$info,'infolab'=>$infolab,'lote_equipo'=>$lt]);
    }


    //Equipo de seguridad
    public function form_equipo_seguridad_lab(Request $request)
    { 
        
        $lista = DB::table('tb_equipo_seguridad as es')
              //  ->leftjoin('tb_equipo_seguridad_lab as esl', 'es.id', '=', 'esl.equipo_seguridad_id')
                ->leftjoin('tb_equipo_seguridad_lab as esl', 'es.id','=', 
                    DB::raw("esl.equipo_seguridad_id AND esl.laboratorio_id = '" . $request->laboratorio_id."'"))

              // ->where('laboratorio_id',$request->laboratorio_id)
                //->whereRaw("tipo_equipo_id=2 and estado_equipo <> 'EL' and `nom_equipo` LIKE '%".$request->nom_equipo."%' ".$where)
              //  ->join('tb_laboratorio', 'tb_equipo.laboratorio_id', '=', 'tb_laboratorio.id')

                ->select('es.*', 'esl.id as equipo_seguridad_lab_id', 'esl.cantidad', 'esl.estado', 'esl.motivo_elim')
                // selectRaw('select * ()')
                ->orderBy('es.equipo_seguridad','ASC')
                ->get();
                 
        return view('equipos.mant_equipo_seguridad_lab',['lista'=>$lista,'databusqueda'=>$request]);
    }

    public function mant_equipo_seguridad_lab(Request $request)
    {   

        /*
        if ($request->estado==1) {
            $dt=new Equipo_seguridad_lab();
            $dt->equipo_seguridad_id=$request->equipo_seguridad_id;
            $dt->laboratorio_id=$request->laboratorio_id;
            $dt->id_usuarioreg=Auth::id();
            $dt->save(); 
            echo json_encode('Activado');
        }else{
            DB::table('tb_equipo_seguridad_lab')
                ->where('equipo_seguridad_id', '=', $request->equipo_seguridad_id)
                ->where('laboratorio_id', '=', $request->laboratorio_id)
                ->delete(); 
            echo json_encode('Deshabilitado');         
        }*/

        DB::table('tb_equipo_seguridad_lab')
              //  ->where('equipo_seguridad_id', '=', $request->equipo_seguridad_id)
                ->where('laboratorio_id', '=', $request->laboratorio_id)
                ->delete();

        //Registrar

            $equipo_id=$request->get('equipo_id');
            $i=0; 
            if($equipo_id){
                while($i < count($equipo_id)){
                    $id_equipo_seg = $equipo_id[$i];

                    $dtl=new Equipo_seguridad_lab();
                    $dtl->equipo_seguridad_id = $id_equipo_seg;
                    $dtl->laboratorio_id = $request->laboratorio_id;
                    $dtl->cantidad = $request->get('cantidad'.$id_equipo_seg);
                    $dtl->estado = $request->get('estado'.$id_equipo_seg);
                    $dtl->motivo_elim = $request->get('motivo_elim'.$id_equipo_seg);
                    
                    $dtl->id_usuarioreg=Auth::id();
                    $dtl->save(); 
                    $i+= 1;
                }
            }
     
             return redirect()->route('listar.equipo_seguridad_lab','laboratorio_id='.$request->laboratorio_id);
    }

    public function select2_producto_laboratorio(Request $request)
    { 
        //and laboratorio_id=".$request->laboratorio_id."
        //tipo_equipo_id=".$request->tipo_equipo_id." and 
        $lista = DB::table('tb_equipo as eq')
                ->whereRaw("IFNULL(estado_equipo,'') <> 'EL' and `nom_equipo` LIKE '%".$request->consulta."%' ")
                ->join('tb_unidad_medida', 'eq.unidad_medida_id', '=', 'tb_unidad_medida.id')
                ->join('tb_laboratorio', 'eq.laboratorio_id', '=', 'tb_laboratorio.id')

                //->select('tb_equipo.*', 'tb_unidad_medida.unidad_medida', 'tb_laboratorio.nombre_lab')
                -> selectRaw("eq.id ,CONCAT_WS(' ',eq.nom_equipo, eq.marca, eq.concentracion, eq.especificacion,'(' ,(SELECT SUM(cantidad_lote) AS cantidad_lote FROM `tb_lote_equipo` le WHERE le.equipo_id = eq.id AND le.laboratorio_id = eq.laboratorio_id and le.status_lote ='AC'), tb_unidad_medida.unidad_medida,')') as text")
                ->orderBy('eq.id','ASC')->get();

        echo json_encode($lista);
    }

    public function json_info_producto(Request $request)
    {
        $laboratorio_id = $request->laboratorio_id;
        $select_lab = '';
        if($laboratorio_id!=''){
            $select_lab = ", ( SELECT GROUP_CONCAT('<option value=\"',l.`id`,'\" cantidad_lote=\"',l.`cantidad_lote`,'\" cantidad_lote_min=\"',l.`cantidad_lote_min`,'\">V:',IFNULL(DATE_FORMAT(l.fch_vencimiento, \"%d/%m/%Y\"),''),' L:', IFNULL(l.lote,''),' (', cantidad_lote_min,')</option>' SEPARATOR '')
  FROM `tb_lote_equipo` l WHERE l.equipo_id = ".$request->id." AND l.laboratorio_id = ".$laboratorio_id." AND  l.status_lote!='EL' and cantidad_lote>0) as combo_lote";
        }

        $info = DB::table('tb_equipo as eq')
                ->whereRaw("eq.id=".$request->id." ")
                ->join('tb_unidad_medida as um', 'eq.unidad_medida_id', '=', 'um.id')
                ->join('tb_unidad_medida as umin', 'eq.unidad_med_min_id', '=', 'umin.id')
                ->join('tb_tipo_fiscalizado as f', 'eq.tipo_fiscalizado_id', '=', 'f.id')
                //->join('tb_laboratorio', 'eq.laboratorio_id', '=', 'tb_laboratorio.id')

               // ->select('tb_equipo.*', 'umin.unidad_medida as unidad_medida_min')
                -> selectRaw("eq.*, um.unidad_medida, umin.unidad_medida as unidad_med_min, f.tipo_fiscalizado ".$select_lab)
                ->first(); 
       echo json_encode($info);
    }

    public function json_info_inventario_data(Request $request)
    { 

        $lista = DB::table('tb_inventario_data')
           // ->select('tb_facultad.*')
            ->where('CODIGO_PATRIMONIAL','=',$request->cod_patrimonio)
           
            ->first();
       echo json_encode($lista);
    }
    


}

