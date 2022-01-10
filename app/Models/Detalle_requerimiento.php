<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_requerimiento extends Model
{
    use HasFactory;

    protected $table='tb_detalle_requerimiento';// tabla
    public $timestamps=false;
    protected $fillable=[
            'requerimiento_id',
            'equipo_id',
            'lote_equipo_id',
            'lote',
            'fch_vencimiento',
            'cantidad_equivalencia',
            'cantidad_requerimiento',
            'cantidad_requerimiento_min',
            'flg_devolucion_at',
            
        ];
    protected $guarded=['id'];
}
?>
