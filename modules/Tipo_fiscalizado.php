<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_fiscalizado extends Model
{
    use HasFactory;

    protected $table='tb_tipo_fiscalizado';// tabla
    public $timestamps=true;
    protected $fillable=[
            'tipo_fiscalizado',
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
