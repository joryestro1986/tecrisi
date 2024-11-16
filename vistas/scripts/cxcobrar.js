var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});


    // Cargar clientes con siniestro al select
    $.post("../ajax/cxcobrar.php?op=selectCliente", function (r) {
        $("#idcliente").html(r);
        $('#idcliente').selectpicker('refresh');
    });

    // Mostrar siniestro y aseguradora automáticamente al seleccionar cliente
    $("#idcliente").change(function () {
        var siniestro = $(this).find('option:selected').data('siniestro');
        var aseguradora = $(this).find('option:selected').text().split('(')[1].replace(')', ''); // Obtiene la aseguradora del texto del option

        $("#siniestro").val(siniestro); // Campo no editable para mostrar siniestro
        $("#nombreseg").val(aseguradora); // Campo no editable para mostrar aseguradora
    });

}

//Función limpiar
function limpiar()
{

    $("#idventa").val("");
    $("#idcliente").val("");
    $("#siniestro").val(""); // Limpia el campo siniestro
    $("#nombreseg").val(""); // Limpia el campo aseguradora
    $("#fecha_hora").val("");
    $("#tipo_comprobante").val("");
    $("#serie_comprobante").val("");
    $("#num_comprobante").val("");
    $("#impuesto").val("");
    $("#total_venta").val("");
    $("#observaciones").val("");


	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha_hora').val(today);

    //Marcamos el primer tipo_documento
    $("#tipo_comprobante").val("Banorte");
	$("#tipo_comprobante").selectpicker('refresh');
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();

		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		//listarArticulos();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").show();
		detalles=0;
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					   url: '../ajax/cxcobrar.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"language": {
            "lengthMenu": "Mostrar : _MENU_ registros",
            "buttons": {
            "copyTitle": "Tabla Copiada",
            "copySuccess": {
                    _: '%d líneas copiadas',
                    1: '1 línea copiada'
                }
            }
        },
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

/*
//Función ListarArticulos
function listarArticulos()
{
	tabla=$('#tblarticulos').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            
		        ],
		"ajax":
				{
					url: '../ajax/venta.php?op=listarArticulosVenta',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
*/
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/cxcobrar.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          listar();
	    }

	});
	limpiar();
}

function mostrar(idventa)
{
/*	$.post("../ajax/venta.php?op=mostrar",{idventa : idventa}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idcliente").val(data.idcliente);
		$("#idcliente").selectpicker('refresh');
		$("#tipo_comprobante").val(data.tipo_comprobante);
		$("#tipo_comprobante").selectpicker('refresh');
		$("#serie_comprobante").val(data.serie_comprobante);
		$("#num_comprobante").val(data.num_comprobante);
		$("#fecha_hora").val(data.fecha);
		$("#impuesto").val(data.impuesto);
		$("#idventa").val(data.idventa);

		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").hide();
 	});

	$.post("../ajax/venta.php?op=listarDetalle&id="+idventa,function(r){
	        $("#detalles").html(r);
	});
*/
	
}

init();