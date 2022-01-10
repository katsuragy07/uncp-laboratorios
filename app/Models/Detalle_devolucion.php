<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_devolucion extends Model
{
    use HasFactory;

    protected $table='tb_detalle_devolucion';// tabla
    public $timestamps=false;
    protected $fillable=[
            'detalle_atencion_id',
            'cantidad_devolucion',
            'devolucion_id',
            'equipo_id',
            'lote_equipo_id',
            
        ];
    protected $guarded=['id'];

}
?>
