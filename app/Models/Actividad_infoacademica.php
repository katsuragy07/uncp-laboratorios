<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad_infoacademica extends Model
{
    use HasFactory;

    protected $table='tb_actividad_infoacademica';// tabla
    public $timestamps=false;
    protected $fillable=[
            'info_academica_id',
            'tipo_equipo_id',
            'descripcion',
            'cantidad',            
        ];
    protected $guarded=['id'];

}
?>
