<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componentes_computo extends Model
{
    use HasFactory;

    protected $table='tb_componentes_computo';// tabla
    public $timestamps=true;
    protected $fillable=[
            'equipo_id',
            'nom_componente',
            'marca',
            'capacidad',
            'descripcion',
            'flg_original',
            'created_at',
            'id_usuarioreg',
            'updated_at',
            'id_usuariomod',
            'deleted_at',
            'id_usuarioelim',
            'motivo_elim',
            'status',
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
