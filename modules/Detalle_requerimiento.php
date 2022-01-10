<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_requerimiento extends Model
{
    use HasFactory;

    protected $table='tb_detalle_requerimiento';// tabla
    public $timestamps=true;
    protected $fillable=[
            'requerimiento_id',
            'equipo_id',
            'cantidad_equivalencia',
            'cantidad_requerimiento',
            'cantidad_requerimiento_min',
            'lote_equipo_id',
            
        ];
    protected $guarded=['id'];

}
?>
