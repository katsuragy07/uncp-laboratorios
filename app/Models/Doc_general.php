<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc_general extends Model
{
    use HasFactory;

    protected $table='tb_doc_general';// tabla
    public $timestamps=false;
    protected $fillable=[
            'nombre',
            'archivo',
        ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
?>
