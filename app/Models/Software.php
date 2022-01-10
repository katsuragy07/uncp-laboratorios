<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;

    protected $table='tb_software';// tabla
    public $timestamps=true;
    protected $fillable=[
            'nom_software',
            'version',
            'anio_adquisicion',
            'compatibilidad_so',
            'fch_ini_vigencia',
            'fch_fin_vigencia',
            'cant_maquina',
            'personal_capacitado',
            'carta_garantia',
            'manual_usuario',
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
