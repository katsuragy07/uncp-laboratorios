<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario_archivo extends Model
{
    use HasFactory;

    protected $table='tb_horario_archivo';// tabla
    public $timestamps=true;
    protected $fillable=[
            'nombre',
            'archivo',
            'laboratorio_id',
            'id_usuarioreg',
            'id_usuariomod',
            'deleted_at',
            'id_usuarioelim',
            'motivo_elim',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
