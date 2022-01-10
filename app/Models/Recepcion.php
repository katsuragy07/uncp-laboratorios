<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    use HasFactory;

    protected $table='tb_recepcion';// tabla
    public $timestamps=true;
    protected $fillable=[
            'atencion_id',
            'laboratorio_id',
            'proveedor_id',
            'resp_recepcion_id',
            'fecha_pedido_compra',
            'fecha_entrega',
            'numdoc_sustento',
            'doc_sustento',
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
