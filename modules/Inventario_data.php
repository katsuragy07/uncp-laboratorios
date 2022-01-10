<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario_data extends Model
{
    use HasFactory;

    protected $table='tb_inventario_data';// tabla
    public $timestamps=true;
    protected $fillable=[
            'ID',
            'item',
            'RUC_ENTIDAD',
            'NOMBRE_LOCAL',
            'DEPARTAMENTO',
            'PROVINCIA',
            'DISTRITO',
            'NOMBRE_AREA',
            'NOMBRE_OFICINA',
            'TIPO_DOC_IDENTIDAD',
            'NRO_DOC_IDENT_PERSONAL',
            'APELLIDO_PATERNO',
            'APELLIDO_MATERNO',
            'NOMBRES',
            'CODIGO_PATRIMONIAL',
            'DENOMINACION_BIEN',
            'NRO_DOC_ADQUISICION',
            'FECHA_ADQUISICION',
            'bien_valor_adquisicion',
            'FECHA_DEPRECIACION',
            'VALOR_NETO',
            'ESTADO_BIEN',
            'MARCA',
            'MODELO',
            'TIPO',
            'COLOR',
            'SERIE',
            'ANIO_FABRICACION',
            'OTRAS_CARACT',
            'CAUSAL_BAJA',
            'NRO_RESOLUCION_BAJA',
            'FECHA_BAJA',
            
        ];
    protected $guarded=['id'];

}
?>
