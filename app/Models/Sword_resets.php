<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sword_resets extends Model
{
    use HasFactory;

    protected $table='password_resets';// tabla
    public $timestamps=true;
    protected $fillable=[
            'email',
            'token',
            
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
