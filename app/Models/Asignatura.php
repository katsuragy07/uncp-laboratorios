<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $table='tb_asignatura';// tabla
    public $timestamps=false;
    protected $fillable=[
            'cod_asignatura',
            'nom_asignatura',
            'facultad_id',
            
        ];
    protected $guarded=['id'];

}
?>
