<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $table='tb_personal';// tabla
    public $timestamps=true;
    protected $fillable=[
            'persona_id',
            'laboratorio_id',
            'tipopersonal_id',
            'cargo_id',
            'fch_ingreso',
            'fch_cese',
            'hoja_vida',
            'resolucion',
            'especialidad',
            'id_usuarioreg',
            'id_usuariomod',
            'deleted_at',
            'id_usuarioelim',
            'motivo_elim',
            'status',
            'periodo_id',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
