<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc_general extends Model
{
    use HasFactory;

    protected $table='tb_doc_general';// tabla
    public $timestamps=true;
    protected $fillable=[
            'nombre',
            'archivo',
            'motivo_elim',
            'status',
            
        ];
    protected $guarded=['id'];

}
?>
