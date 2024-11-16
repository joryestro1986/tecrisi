<?php 
 
require_once "../modelos/Montosiniestro.php";

$montosiniestro = new Montosiniestro();


$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$monto=isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$obervamonto=isset($_POST["obervamonto"])? limpiarCadena($_POST["obervamonto"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idcliente)){
			$rspta=$montosiniestro->insertar($monto,$obervamonto);
			echo $rspta ? "monto siniestro registrada" : "monto siniestro no se pudo registrar";
		}
		else {
			$rspta=$montosiniestro->editar($idcliente,$monto,$obervamonto);
			echo $rspta ? "monto siniestro actualizada" : "monto siniestro no se pudo actualizar";
		}
	break;
	
	case 'selectCliente':
        $rspta = $montosiniestro->listarConSiniestro();
        echo '<option value="">Seleccione SINIESTROS</option>';
        while ($reg = $rspta->fetch_object()) {
            // Solo muestra el nombre de la monto siniestro
            echo '<option value="' . $reg->idmovint . '">' . $reg->siniestro . '</option>';
        }
        break;
		

	case 'desactivar':
		$rspta=$montosiniestro->desactivar($idcliente);
 		echo $rspta ? "monto siniestro Desactivada" : "monto siniestro no se puede desactivar";
	break;

	case 'activar':
		$rspta=$montosiniestro->activar($idcliente);
 		echo $rspta ? "monto siniestro activada" : "monto siniestro no se puede activar";
	break;

	case 'mostrar':
		$rspta=$montosiniestro->mostrar($idcliente);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

    case 'listar':
        $rspta = $montosiniestro->listar();
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '<button class="btn btn-warning" onclick="mostrar(' . $reg->idsiniestro . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-danger" onclick="anular(' . $reg->idsiniestro . ')"><i class="fa fa-close"></i></button>',
                "1" => $reg->siniestro,
                "2" => $reg->monto,
				"3" => $reg->debe
                
            );
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
	break;
}

 
?>