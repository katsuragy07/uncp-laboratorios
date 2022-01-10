<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento_equipo extends Model
{
    use HasFactory;

    protected $table='tb_documento_equipo';// tabla
    public $timestamps=true;
    protected $fillable=[
            'equipo_id',
            'nombre_doc',
            'archivo_doc',
            'tipo_doc_equipo_id',
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
