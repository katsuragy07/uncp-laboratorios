<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table='tb_horario';// tabla
    public $timestamps=false;
    protected $fillable=[
            'dia_semana',
            'hora',
            'hora_fin', 
            'info_academica_id',
            
        ];
    protected $guarded=['id'];

}
?>
