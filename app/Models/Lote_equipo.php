<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote_equipo extends Model
{
    use HasFactory;

    protected $table='tb_lote_equipo';// tabla
    public $timestamps=true;
    protected $fillable=[
            'lote',
            'fch_fabricacion',
            'fch_vencimiento',
            'cantidad_lote',
            'cantidad_lote_min',
            'equipo_id',
            'laboratorio_id',
            'id_usuarioreg',
            'id_usuariomod',
            'deleted_at',
            'id_usuarioelim',
            'motivo_elim',
            'status_lote',
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
