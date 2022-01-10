<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado_equipo extends Model
{
    use HasFactory;

    protected $table='tb_estado_equipo';// tabla
    public $timestamps=true;
    protected $fillable=[
            'equipo_id',
            'comentario',
            'proveedor_id',
            'resp_incidente_id',
            'resp_baja_id',
            'doc_sustento',
            'fch_posiblemant',
            'flg_salidauncp',
            'estado',
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
