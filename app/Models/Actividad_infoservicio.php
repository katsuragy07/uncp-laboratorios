<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad_infoservicio extends Model
{
    use HasFactory;

    protected $table='tb_actividad_infoservicio';// tabla
    public $timestamps=false;
    protected $fillable=[
            'info_servicio_id',
            'tipo_equipo_id',
            'descripcion',
            'cantidad',            
        ];
    protected $guarded=['id'];

}
?>
