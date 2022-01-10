<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rations extends Model
{
    use HasFactory;

    protected $table='migrations';// tabla
    public $timestamps=true;
    protected $fillable=[
            'migration',
            'batch',
            
        ];
    protected $guarded=['id'];

}
?>
