<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_movimiento extends Model
{
    use HasFactory;

    protected $table='tb_tipo_movimiento';// tabla
    public $timestamps=true;
    protected $fillable=[
            'tipo_movimiento',
            
        ];
    protected $guarded=['id'];

}
?>
