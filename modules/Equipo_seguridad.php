<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo_seguridad extends Model
{
    use HasFactory;

    protected $table='tb_equipo_seguridad';// tabla
    public $timestamps=true;
    protected $fillable=[
            'equipo_seguridad',
            'tipo',
            'id_usuarioreg',
            'id_usuariomod',
            'deleted_at',
            'id_usuarioelim',
            'motivo_elim',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
