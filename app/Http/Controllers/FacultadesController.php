<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Facultad;
use Illuminate\Support\Facades\Storage;
use DB;

class FacultadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index (Request $request)
    {
       $lista = 'DB'::table('tb_facultad')
            ->select('tb_facultad.*')
            ->where('status','<>','EL')
            ->where('nom_facultad','LIKE','%'.$request->nombre_facultad.'%')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('facultades.lista_facultades',['listafacultades'=>$lista,'databusqueda'=>$request]);

    }

    public function store(Request $request)
    {
        
        if ($request->id_facultad!='') {
            $dtFacultad=Facultad::find($request->id_facultad);
            $dtFacultad->nom_facultad=$request->nom_facultad;
            if($request->hasfile('organigrama')){
                $organigrama=$request->file('organigrama');
                $organigrama->move(public_path().'/files/facultad/',$organigrama->getClientOriginalName());
                $dtFacultad->organigrama=$organigrama->getClientOriginalName();
            } 
          
            $dtFacultad->save();  
        
        }else{
            $dtFacultad=new Facultad();
            $dtFacultad->nom_facultad=$request->nom_facultad; 
            if($request->hasfile('organigrama')){
                $organigrama=$request->file('organigrama');
                $organigrama->move(public_path().'/files/facultad/',$organigrama->getClientOriginalName());
                $dtFacultad->organigrama=$organigrama->getClientOriginalName();
            } 
            $dtFacultad->save();            
        }

        return redirect()->route('listar.facultades');
    }
    

    





    public function destroy(Request $request)
    {
         
        $dtFacultad=Facultad::find($request->id);
        $dtFacultad->id_usuarioelim=Auth::id();
        $dtFacultad->motivo_elim=$request->motivo;
        $dtFacultad->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $dtFacultad->status='EL';
        
        //  $dtFacultad=Facultad::findOrFail($request->organigrama);

      //  if(Storage::delete('/imagenes/facultades'.$dtFacultad->organigrama)){

         //   Facultad::destroy($request->organigrama);); 

     //   }   

        $dtFacultad->save(); 
        return redirect()->route('listar.facultades');
    }
}
