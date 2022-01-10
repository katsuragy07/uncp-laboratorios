<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuariopermiso extends Model
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

}
?>
