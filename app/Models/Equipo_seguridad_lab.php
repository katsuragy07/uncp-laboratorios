<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo_seguridad_lab extends Model
{
    use HasFactory;

    protected $table='tb_equipo_seguridad_lab';// tabla
    public $timestamps=true;
    protected $fillable=[
            'equipo_seguridad_id',
            'fch_vencimiento',
            'laboratorio_id',
            'id_usuarioreg',
            'id_usuariomod',
            'deleted_at',
            'id_usuarioelim',
            'motivo_elim',
            'cantidad',
            'estado',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
