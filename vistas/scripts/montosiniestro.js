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
    $.post("../ajax/montosiniestro.php?op=selectCliente", function (r) {
        $("#idcliente").html(r);
        $('#idcliente').selectpicker('refresh');
    });

    // Mostrar siniestro a automáticamente al seleccionar cliente
    $("#idcliente").change(function () {
        var siniestro = $(this).find('option:selected').data('siniestro');
        $("#siniestro").val(siniestro); // Campo no editable para mostrar siniestro
      });
	   //$('#mAlmacen').addClass("treeview active");
    $('#lSiniestros').addClass("active");
}

function limpiar() {

    $("#idcliente").val(""); // Limpia el campo siniestro
    $("#monto").val("");
    $("#obervamonto").val("");
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
					   url: '../ajax/montosiniestro.php?op=listar',
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
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({

		url: "../ajax/montosiniestro.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idcliente)
{
	$.post("../ajax/montosiniestro.php?op=mostrar",{idcliente : idcliente}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idcliente").val(data.idcliente);
		$("#monto").val(data.monto);
 		$("#obervamonto").val(data.obervamonto);

 	})
}
 
init();