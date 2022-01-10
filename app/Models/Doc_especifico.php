<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc_especifico extends Model
{
    use HasFactory;

    protected $table='tb_doc_especifico';// tabla
    public $timestamps=true;
    protected $fillable=[
            'nombre',
            'archivo',
            'laboratoriodet_id',
            'tipo_documento_id',
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
