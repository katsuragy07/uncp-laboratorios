<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info_servicio extends Model
{
    use HasFactory;

    protected $table='tb_info_servicio';// tabla
    public $timestamps=true;
    protected $fillable=[
            'laboratoriodet_id',
            'solicitante_id',
            'representante_id',
            'personal_contacto_id',
            'producto',
            'servicio_solicitado_id',
            'otro_servicio',
            'marca',
            'ds_marca',
            'ie_marca',
            'presentacion',
            'cantidad_muestra',
            'cantidad_lote',
            'identificacion',
            'fecha_produccion',
            'ds_fecha_produccion',
            'ie_fecha_produccion',
            'observacion',
            'punto_muestreo',
            'coordenadas',
            'ubigeo',
            'lugar',
            'fuente_origen',
            'persona_muestreo_id',
            'fecha_muestreo',
            'hora_muestreo',
            'tipo_envase',
            'id_usuarioreg',
            'id_usuariomod',
            'deleted_at',
            'id_usuarioelim',
            'motivo_elim',
            'conservacion',
            'preservacion',
            'tipo_muestra',
            'descripcion_servicio',
            'tipo_comprobante_id',
            'precio',
            'retencion',
            'fecha_entrega',
            'hora_entrega',
            'doc_resultado',
            'responsable_atencion_id',
            'observacion_resultado',
            'status',
            'periodo_id',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
