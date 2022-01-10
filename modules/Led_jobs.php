<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Led_jobs extends Model
{
    use HasFactory;

    protected $table='failed_jobs';// tabla
    public $timestamps=true;
    protected $fillable=[
            'uuid',
            'connection',
            'queue',
            'payload',
            'exception',
            'failed_at',
            
        ];
    protected $guarded=['id'];

}
?>
