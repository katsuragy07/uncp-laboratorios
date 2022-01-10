<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info_academica extends Model
{
    use HasFactory;

    protected $table='tb_info_academica';// tabla
    public $timestamps=true;
    protected $fillable=[
            'laboratoriodet_id',
            'docente_id',
            'hra_academica',
            'calendario_uso',
            'guia_manual',
            'fecha_inicio',
            'fecha_fin',
            'id_usuarioreg',
            'id_usuariomod',
            'deleted_at',
            'id_usuarioelim',
            'motivo_elim',
            'asignatura_id',
            'status',
            'aforo',
            'periodo_id',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
