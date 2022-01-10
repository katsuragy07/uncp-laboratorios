<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table='tb_equipo';// tabla
    public $timestamps=true;
    protected $fillable=[
            'tipo_equipo_id',
            'cod_patrimonio',
            'nom_equipo',
            'ficha_equipo',
            'proveedor_id',
            'marca',
            'modelo',
            'serie',
            'concentracion',
            'especificacion',
            'unidad_medida_id',
            'unidad_med_min_id',
            'cantidad_min',
            'laboratorio_id',
            'responsable_id',
            'ubicacion',
            'estado_equipo',
            'foto_equipo',
            'so',
            'antivirus',
            'flg_devolucion',
            'id_usuarioreg',
            'id_usuariomod',
            'deleted_at',
            'id_usuarioelim',
            'motivo_elim',
            'tipo_fiscalizado_id',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
