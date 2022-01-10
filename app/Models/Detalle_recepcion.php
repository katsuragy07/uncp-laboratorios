<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_recepcion extends Model
{
    use HasFactory;

    protected $table='tb_detalle_recepcion';// tabla
    public $timestamps=false;
    protected $fillable=[
            'recepcion_id',
            'equipo_id',
            'lote_equipo_id',
            'detalle_atencion_id',
            'lote',
            'fch_vencimiento',
            'cantidad_equivalencia',
            'cantidad_recepcion',
            'cantidad_recepcion_min',
            
        ];
    protected $guarded=['id'];

}
?>
