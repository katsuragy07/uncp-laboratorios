<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table='tb_persona';// tabla
    public $timestamps=true;
    protected $fillable=[
            'tipo_documento_id',
            'num_doc',
            'nombres',
            'apellidos',
            'correo',
            'celular',
            'fch_nacimiento',
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
