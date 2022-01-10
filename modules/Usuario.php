<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table='tb_usuario';// tabla
    public $timestamps=true;
    protected $fillable=[
            'nombre_usuario',
            'email',
            'email_verified_at',
            'username',
            'password',
            'remember_token',
            'sts_usuario',
            'id_usuarioelim',
            'motivo_elim',
            'deleted_at',
            'laboratorio_id',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
