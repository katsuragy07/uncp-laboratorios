<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $table='tb_movimiento';// tabla
    public $timestamps=true;
    protected $fillable=[
            'equipo_id',
            'lote_equipo_id',
            'laboratorio_id',
            'tipo_movimiento_id',
            'cantidad_movimiento',
            'cantidad_min_movimiento',
            'stock_lote',
            'stock_equipo_lab',
            'atencion_id',
            'detalle_atencion_id',
            'recepcion_id',
            'detalle_recepcion_id',
            'id_usuarioreg',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
