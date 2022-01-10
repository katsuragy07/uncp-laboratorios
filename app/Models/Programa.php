<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $table='tb_programa';// tabla
    public $timestamps=false;
    protected $fillable=[
            'nom_programa',
            'cod_programa',
            'info_academica_id',
            
        ];
    protected $guarded=['id'];

}
?>
