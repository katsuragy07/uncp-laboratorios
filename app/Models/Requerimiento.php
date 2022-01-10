<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{
    use HasFactory;

    protected $table='tb_requerimiento';// tabla
    public $timestamps=true;
    protected $fillable=[
            'laboratorio_origen_id',
            'laboratorio_dest_id',
            'investigacion_id',
            'encargado_lab_dest_id',
            'servicio_id',
            'academico_id',
            'solicitante_id',
            'fch_requerimiento',
            'hora_requerimiento',
            'id_usuarioreg',
            'id_usuariomod',
            'deleted_at',
            'id_usuarioelim',
            'motivo_elim',
            'nota_requerimiento',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
