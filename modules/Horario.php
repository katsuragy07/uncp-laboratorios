<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table='tb_horario';// tabla
    public $timestamps=true;
    protected $fillable=[
            'dia_semana',
            'hora',
            'info_academica_id',
            'hora_fin',
            
        ];
    protected $guarded=['id'];

}
?>
