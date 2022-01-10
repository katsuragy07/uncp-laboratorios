<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use Illuminate\Http\Doc_especifico;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->flg_cambiarclave=='1'){
            return redirect()->route('cambiar.clave');  
        }else{

            $laboratorio_id = Auth::user()->laboratorio_id;


             $cantDoc = DB::table('tb_doc_especifico as d')
                ->leftjoin('tb_laboratorio_det as ld', 'ld.id', '=', 'd.laboratoriodet_id')
                ->selectRaw("COUNT(d.id) AS cantidaddoc")
                ->whereRaw(" ld.laboratorio_id = '$laboratorio_id' and d.status ='AC'")
                ->first();

            $cantPersonal = DB::table('tb_personal as p')
                //->leftjoin('tb_laboratorio_det as ld', 'ld.id', '=', 'd.laboratoriodet_id')
                ->selectRaw("COUNT(p.id) AS cantidadpersonal")
                ->whereRaw(" p.laboratorio_id = '$laboratorio_id' and p.status ='AC'")
                ->first();

            $cantEquipo = DB::table('tb_equipo as e')
              //  ->leftjoin('tb_laboratorio_det as ld', 'ld.id', '=', 'd.laboratoriodet_id')
                ->selectRaw("COUNT(e.id) AS cantidadequipo")
                ->whereRaw(" e.laboratorio_id = '$laboratorio_id' and e.motivo_elim !=''")
                ->first();

             
            return view('dashboard',['cantDoc'=>$cantDoc,'cantPersonal'=>$cantPersonal,'cantEquipo'=>$cantEquipo]);



        }

        //return view('home');
        
    }

    public function plantilla()
    {
        return view('layouts.principal');
    }
 

}
