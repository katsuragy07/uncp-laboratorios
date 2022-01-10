<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_doc_equipo extends Model
{
    use HasFactory;

    protected $table='tb_tipo_doc_equipo';// tabla
    public $timestamps=true;
    protected $fillable=[
            'tipo_doc_equipo',
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
