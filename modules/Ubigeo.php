<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    use HasFactory;

    protected $table='tb_ubigeo';// tabla
    public $timestamps=true;
    protected $fillable=[
            'ubigeo',
            'distrito',
            'provincia',
            'departamento',
            'poblacion',
            'area',
            
        ];
    protected $guarded=['id'];

}
?>
