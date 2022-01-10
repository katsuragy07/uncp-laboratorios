<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Proyectos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use File;

class ProyectosController extends Controller
{
    public function index(Request $request)
    {
       $lista = DB::table('tb_proyecto_transferido')
            ->where('nom_proyecto','LIKE','%'.$request->buscar.'%')
            ->orwhere('descripcion','LIKE','%'.$request->buscar.'%')
            ->orwhere('publico_objetivo','LIKE','%'.$request->buscar.'%')
            ->select('tb_proyecto_transferido.*')
            ->orderBy('tb_proyecto_transferido.id')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('proyectos.lista_proyectos',['listadatos'=>$lista,'databusqueda'=>$request]);
    }

    public function store(Request $request)
    {

        $txtdescrip='';
    	$txtpublico='';
    	$txtcontrato='';
    	$txtadjunto='';
    	if ($request->descripcion!='') { $txtdescrip=$request->descripcion; }

    	if ($request->id_tipo=='Proyecto' && $request->id_proyecto=='') {
	        if ($request->file('doc_contrato')) {
	         	$txtcontrato=$request->id_tipo.'_'.Str::random(10).time().Str::random(5).'.pdf';
	            Storage::disk('public')->put('proyectos/'.$txtcontrato,  File::get($request->file('doc_contrato')));
	        }
    	}else{
    		$txtpublico=$request->publico_objetivo;
    	}


        if ($request->id_proyecto=='') {

            if ($request->file('doc_adjunto')) {
                $txtadjunto='ad_'.$request->id_tipo.'_'.Str::random(10).time().Str::random(5).'.pdf';
                Storage::disk('public')->put('proyectos/'.$txtadjunto,  File::get($request->file('doc_adjunto')));
            }

            $dtProyecto=new Proyectos();
            $dtProyecto->nom_proyecto=$request->nom_proyecto;
            $dtProyecto->descripcion=$txtdescrip;
            $dtProyecto->fch_inicio=$request->fch_inicio;
            $dtProyecto->fch_finalizacion=$request->fch_finalizacion;
            $dtProyecto->costo=$request->costo;
            $dtProyecto->contrato_intervencion_idi=$txtcontrato;
            $dtProyecto->id_usuarioreg=Auth::id();
            $dtProyecto->solicitud_id=$request->id_solicitud;
            $dtProyecto->publico_objetivo=$txtpublico;
            $dtProyecto->doc_adjunto=$txtadjunto;
            $dtProyecto->save();            
        }else{

            $dtProyecto=Proyectos::find($request->id_proyecto);

            if ($request->id_tipo=='Proyecto') {
                if ($request->file('doc_contrato')) {
                    $txtcontrato=$request->id_tipo.'_'.Str::random(10).time().Str::random(5).'.pdf';
                    Storage::disk('public')->delete('proyectos/'.$dtProyecto->contrato_intervencion_idi);
                    Storage::disk('public')->put('proyectos/'.$archivo,  File::get($request->file('doc_contrato')));
                    $dtProyecto->contrato_intervencion_idi=$txtcontrato;
                }               
            }

            if ($request->file('doc_adjunto')) {
                $txtadjunto='ad_'.$request->id_tipo.'_'.Str::random(10).time().Str::random(5).'.pdf';
                Storage::disk('public')->delete('proyectos/'.$dtProyecto->doc_adjunto);
                Storage::disk('public')->put('proyectos/'.$txtadjunto,  File::get($request->file('doc_adjunto')));
                $dtProyecto->doc_adjunto=$txtadjunto;
            }

            $dtProyecto->nom_proyecto=$request->nom_proyecto;
            $dtProyecto->descripcion=$txtdescrip;
            $dtProyecto->fch_inicio=$request->fch_inicio;
            $dtProyecto->fch_finalizacion=$request->fch_finalizacion;
            $dtProyecto->costo=$request->costo;
            $dtProyecto->id_usuariomod=Auth::id();
            $dtProyecto->publico_objetivo=$txtpublico;
            $dtProyecto->save(); 
        }

        return redirect()->route('listar.proyectos');
    }


    public function actividades($idproyecto)
    {
        if (is_numeric($idproyecto)) {
           $verifProy=Proyectos::where('id',$idproyecto)->count('id');
           if ($verifProy>0) {
                $dtProyecto = Proyectos::find($idproyecto);
                return view('proyectos.actividad_proyecto',['proyecto'=>$dtProyecto]); 
           }else{
                return redirect()->route('listar.proyectos');
           }
        }else{
            return redirect()->route('listar.proyectos');
        }
    }


}

