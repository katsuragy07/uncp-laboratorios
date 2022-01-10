<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio_det extends Model
{
    use HasFactory;

    protected $table='tb_laboratorio_det';// tabla
    public $timestamps=true;
    protected $fillable=[
            'laboratorio_id',
            'tipolaboratorio_id',
            'id_usuarioreg',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
