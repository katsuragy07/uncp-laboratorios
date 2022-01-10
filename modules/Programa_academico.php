<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa_academico extends Model
{
    use HasFactory;

    protected $table='tb_programa_academico';// tabla
    public $timestamps=true;
    protected $fillable=[
            'programa_academico',
            'tb_laboratorio_id',
            
        ];
    protected $guarded=['id'];

}
?>
