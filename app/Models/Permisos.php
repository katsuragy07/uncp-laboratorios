<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory;
    protected $table='tb_permiso';// tabla
    public $timestamps=true;

    protected $fillable=['cod_permiso','nom_permiso','id_usuarioreg','id_usuariomod']; // campos

    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
