<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    use HasFactory;

    protected $table='tb_atencion';// tabla
    public $timestamps=true;
    protected $fillable=[
            'requerimiento_id',
            'fch_pedido',
            'hora_pedido',
            'fch_entrega',
            'hora_entrega',
            'laboratorio_origen_id',
            'laboratorio_dest_id',
            'servicio_id',
            'academico_id',
            'investigacion_id',
            'encargado_lab_id',
            'solicitado_id',
            'cargo_solicitado',
            'numdoc_solicitado',
            'autorizado_id',
            'cargo_autorizado',
            'numdoc_autorizado',
            'recibido_id',
            'resp_atencion_id',
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
