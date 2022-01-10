<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_atencion extends Model
{
    use HasFactory;

    protected $table='tb_detalle_atencion';// tabla
    public $timestamps=false;
    protected $fillable=[
            'atencion_id',
            'equipo_id',
            'lote_equipo_id',
            'lote',
            'fch_vencimiento',
            'cantidad_equivalencia',
            'cantidad_atencion',
            'cantidad_atencion_min',
            'flg_devolucion_at',
            'detalle_requerimiento_id',
            
        ];
    protected $guarded=['id'];

}
?>
