<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $table='tb_periodo';// tabla
    public $timestamps=false;
    protected $fillable=[
            'periodo',
            
        ];
    protected $guarded=['id'];

}
?>
