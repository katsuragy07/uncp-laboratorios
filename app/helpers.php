<?php 
	function fechaHoraUsuBR($datetime) {
        if ($datetime) {
            $datetime = date_create($datetime);
            $fecha = date_format($datetime,"d/m/Y");
            $hora = date_format($datetime,"H:i:s");
            return $fecha.'<br>'.$hora;
        } else {
            return '00/00/0000<br>00:00:00';
        }
    }

    function fechaHoraUsu($datetime) {
        if ($datetime) {
            $datetime = date_create($datetime);
            $datetime = date_format($datetime,"d/m/Y H:i:s");
            return $datetime;
        } else {
            return '';
        }
    }

    function fechaUsu($date) {
        if ($date) {
            $date = date_create($date);
            $date = date_format($date,"d/m/Y");
            return $date;
        } else {
            return '';
        }
    }
	
	function estado($estado){
		switch ($estado) {            
		    case 'BU':$resultado = 'Bueno';
		            break;
		    case 'NU':$resultado = 'Nuevo';
		            break;
		    case 'RE':$resultado = 'Regular';   
		    		break;
		    case 'ML':$resultado = 'Malo';   
		    		break; 
		    case 'MN':$resultado = 'Mantenimiento';   
		    		break;                   
		    case 'BJ':$resultado = 'Baja';
		    		break;

		    case 'AC':$resultado = 'ACTIVO';
		    		break;
		    case 'SP':$resultado = 'SUSPENDIDO';
		    		break;
		    case 'AC':$resultado = 'ELIMINADO';
		    		break;
		    default:
		           $resultado =  '-';
		}
		return $resultado;
	}

	function signo_cant_mov($cantidad,$tipo_movimiento){
		/*
		1 INVENTARIO INICIAL
2 REGULARIZACIÓN DEL ALMACEN
3 INGRESO POR COMPRA
4 SALIDA POR ATENCION
5 SALIDA POR ANULACION DE COMPRA
6 INGRESO POR ANULACION DE VENTA
7 SALIDA POR ANULACION DE LOTE
8 INGRESO POR REQUERIMIENTO
		*/
		switch ($tipo_movimiento) {            
		    case 1:$resultado = $cantidad;
		            break;
		    case 2:$resultado = $cantidad*1;
		            break;
		    case 3:$resultado = $cantidad;
		    		break;
		    case 4:$resultado = $cantidad*(-1);
		    		break; 
		    case 5:$resultado = $cantidad*(-1);
		    		break;                   
		    case 6:$resultado = $cantidad;
		    		break;
		    case 7:$resultado = $cantidad*(-1);
		    		break;
		    case 8:$resultado = $cantidad;
		    		break;
		    case 9:$resultado = $cantidad;
		    		break;
		    default:
		           $resultado =  '*';
		}
		return $resultado;
	}
 ?>