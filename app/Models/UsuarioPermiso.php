<?php
namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioPermiso extends Model
{
    use HasFactory;

    protected $table='tb_usuariopermiso';// tabla
    public $timestamps=true;
    protected $fillable=[
            'id_usuario',
            'id_permiso',
            'id_usuarioreg',
            'id_usuariomod',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

    public function PrivUsuario()
    {
        $Privilegio=UsuarioPermiso::
            join('tb_permiso', 'tb_permiso.id', '=', 'tb_usuariopermiso.id_permiso')
            ->select('tb_permiso.cod_permiso')
            ->where('id_usuario',Auth::id())->get();

        $PrivUsuario = array();
        foreach ($Privilegio as $fila) {
            $PrivUsuario[] = $fila->cod_permiso;
        }
          
        
        return $PrivUsuario;
        
       
    }
}
?>
