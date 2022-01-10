<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitudes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use DB;
use File;

class SolicitudesController extends Controller
{
    public function index(Request $request)
    {        
       $lista = DB::table('tb_solicitud')
            ->where('sts_solicitud','<>','EL')
            ->where('nom_solicitante','LIKE','%'.$request->buscar.'%')
            ->where('num_documento','LIKE','%'.$request->buscar.'%')
            ->where('asunto','LIKE','%'.$request->buscar.'%')
            ->join('tb_tiposolicitud', 'tb_solicitud.tiposolictud_id', '=', 'tb_tiposolicitud.id')
            ->select('tb_solicitud.*', 'tb_tiposolicitud.nombre')
            ->orderBy('tb_solicitud.id')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('solicitudes.lista_solicitudes',['listasolicitudes'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {
        $txt_descrip='';
        $archivo=Str::random(10).time().Str::random(5).'.pdf';

        if ($request->descripcion!='') { $descripcion=$request->descripcion; }

        if ($request->id_solicitud!='') {
            $dtSolicitud=Solicitudes::find($request->id_solicitud);
            if ($request->file('adjunto')) {
                Storage::disk('public')->delete('solicitudes/'.$dtSolicitud->doc_adjunto);
                Storage::disk('public')->put('solicitudes/'.$archivo,  File::get($request->file('adjunto')));
                $dtSolicitud->doc_adjunto=$archivo;
            }
            $dtSolicitud->num_documento=$request->num_documento;
            $dtSolicitud->nom_solicitante=$request->nom_solicitante;
            $dtSolicitud->asunto=$request->asunto;
            $dtSolicitud->tiposolictud_id=$request->tiposolictud_id;
            $dtSolicitud->descripcion=$txt_descrip;
            $dtSolicitud->id_usuariomod=Auth::id();
            $dtSolicitud->save();
        }else{
            Storage::disk('public')->put('solicitudes/'.$archivo,  File::get($request->file('adjunto')));
            $dtSolicitud=new Solicitudes($request->all());
            $dtSolicitud->descripcion=$txt_descrip;
            $dtSolicitud->doc_adjunto=$archivo;
            $dtSolicitud->id_usuarioreg=Auth::id();
            $dtSolicitud->save();
        }

       return redirect()->route('listar.solicitudes');
    }


    public function validarNumDocumento(Request $request)
    {
      if ($request->ajax()) {
            // recibir del ajax
            $num_documento=$request->get('num_documento');
            $ya_existe=0;
            $dtbuscar=Solicitudes::where('num_documento',$num_documento)->count('id');
            if ($dtbuscar>0) { $ya_existe=1; }
            $data=array('existe' => $ya_existe);  
            echo json_encode($data);
        }
    }


    public function destroy(Request $request)
    {
        $dtSolicitud=Solicitudes::find($request->id_solicitud);
        $dtSolicitud->sts_solicitud='EL';
        $dtSolicitud->id_usuarioelim=Auth::id();
        $dtSolicitud->motivo_elim=$request->motivo;
        $dtSolicitud->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dtSolicitud->save(); 
        return redirect()->route('listar.solicitudes');
    }

}
