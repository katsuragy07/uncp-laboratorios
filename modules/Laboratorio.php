<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    use HasFactory;

    protected $table='tb_laboratorio';// tabla
    public $timestamps=true;
    protected $fillable=[
            'cod_sunedu',
            'nombre_lab',
            'decripcion_lab',
            'observaciones_lab',
            'tipos_de_ensenanza',
            'ubicacion',
            'num_aula',
            'piso',
            'pabellon',
            'horario_atencion',
            'aforo',
            'area_total',
            'area_libre',
            'area_ocupada',
            'foto_laboratorio',
            'organigrama',
            'status',
            'facultad_id',
            'resolucion_creacion',
            'flg_internet',
            'flg_tacho_peligroso',
            'flg_tacho_biocont',
            'flg_recipiente_rl',
            'tipo_almacen_id',
            'categoria_lab',
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
