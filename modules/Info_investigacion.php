<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info_investigacion extends Model
{
    use HasFactory;

    protected $table='tb_info_investigacion';// tabla
    public $timestamps=true;
    protected $fillable=[
            'laboratoriodet_id',
            'cod_proyecto',
            'nom_proyecto',
            'responsables',
            'fuente_finan',
            'resultado_inv',
            'horario_inv',
            'centro_inv',
            'linea_inv',
            'monto_otorgar',
            'aseg_calidad',
            'id_usuarioreg',
            'id_usuariomod',
            'deleted_at',
            'id_usuarioelim',
            'motivo_elim',
            'solicitante_id',
            'status',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
