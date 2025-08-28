$(document).ready(function() {
	var consecutivo = 0;
	 xProgramar();
	 enProceso();   

	inicial();
	
     
      

      

      //planilla
      $('#PlanillaVehiculo').DataTable( {
      	'destroy':true,
      	'responsive':true,
      	'searching': false,
      	language: {
            'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
        },

        scrollY:        '40vh',
        "scrollX": true,
        scrollCollapse: true,
        paging:         false,
        //scrollCollapse: true,
   

    } );
         

 });
/*var obtener_data_eliminar=function(tbody,table){
	$(tbody).on("click", "button.eliminar", function(){
		var data = table.row($this.parents("tr")).data();
		console.log(data);
	}); 
}*/
$('#btnBuscar').on('click', function (event) {
	event.preventDefault();

	inicial();
	consecutivo = $('#txtNroProg').val();
	document.getElementById("cmbTransportadora").disabled=true;
	document.getElementById("txtNroProg").disabled=false;


	

})
$('#btnAgregar').on('click', function(event){
	event.preventDefault();
	if ($('select[id=cmbDestino]').val()!=0) {
		
		let destino = $('select[id=cmbDestino]').val();
		let nroProg = $('#txtNroProg').val();
		let idTrans = $('#cmbTransportadora').val();
		let placa = $('select[id=cmbPlaca] option:selected').text();
		let tipoVehiculo = $('#cmbTipoVehiculo').val();
		let tipoEnvio = $('#cmbTipoEnvio').val();
		let conductor = $('#cmbConductor').val();
		
		//Bloqueo transportadora y placa
		document.getElementById("cmbTransportadora").disabled=true;
		document.getElementById("cmbPlaca").disabled=true;
		document.getElementById("txtNroProg").disabled=true;

		$('#PlanillaVehiculo').DataTable( {

      	"destroy":true,      
      	'responsive':true,
      	'searching': false,

      	language: {
            'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
        },
        scrollY:        '40vh',
        //"scrollX": true,
        scrollCollapse: true,
        paging:         false,
        //scrollCollapse: true,
      	
         "ajax": {
            "url": "inc/logistica_docxdestino_insert.php",
            "data":{destino:destino, nroProg:nroProg, idTrans:idTrans, placa:placa, tipoVehiculo:tipoVehiculo, tipoEnvio:tipoEnvio, conductor:conductor},
            "type": "POST"
        },

        "columns": [
            { "data": "Documento" },
            {"data": "Cliente"},
            { "data": "Destino" },
            { "data": "Direccion" },
            { "data": "Observacion" },
            { "data": "Cantidad" },
            { "data": "Valorizado" }
            //{"defaultContent":"<button type='button' class='btn btn-danger'><i class='eliminar fa fa-trash-o'></i></button>"}
            
        ] 






    } );
		listarDestinos();
		xProgramar();
		enProceso();



	} else{
		alert("No Seleccionaste nada!")
	}

	
});
//Buscar Planilla
var input = document.getElementById("txtNroProg");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
  	event.preventDefault();
  	 var nroProg = $('#txtNroProg').val();
  	if (nroProg<consecutivo) {
  		llenarBusqueda();
   
   
  // alert(nroProg);
   //

   $('#PlanillaVehiculo').DataTable( {

      	"destroy":true,      
      	'responsive':true,
      	'searching': false,

      	language: {
            'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
        },
        scrollY:        '40vh',
        //"scrollX": true,
        scrollCollapse: true,
        paging:         false,
        //scrollCollapse: true,
      	
         "ajax": {
            "url": "inc/logistica_docxdestino_get.php",
            "data":{nroProg:nroProg},
            "type": "POST",

           
        },

        "columns": [
            { "data": "Documento" },
            {"data": "Cliente"},
            { "data": "Destino" },
            { "data": "Direccion" },
            { "data": "Observacion" },
            { "data": "Cantidad" },
            { "data": "Valorizado" }
            //{"defaultContent":"<button type='button' class='btn btn-danger'><i class='eliminar fa fa-trash-o'></i></button>"}
            
        ] 






    } );
} else {
	alert("Registro no Existe");
	inicial();
}
  	 

  }
});

function enProceso() {
	$('#PenProceso').DataTable( {
      	'destroy':'true',
      	//'responsive':'true',
      	'searching': false,
      	language: {
            'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
        },
   
        scrollY:        '30vh',
        //"scrollX": true,
        scrollCollapse: true,
        paging:         false,
         "ajax": {
            "url": "inc/logistica_enProceso_list.php",
            "type": "POST"
        },
        "columns": [
            { "data": "Nro" },
            {"data": "Vehiculo"},
            { "data": "Ruta" },
           // { "data": "Dctos" },
            { "data": "total" }
        ]




    } );
}

//
function xProgramar() {
	$('#PsinProgramar').DataTable({
     	'destroy':'true',
     	//'responsive': 'true',
     	 'searching': false,




      	language: {
            'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
        },
   
        scrollY:        '30vh',
        //"scrollX": true,
        scrollCollapse: true,
        paging:         false,
         "ajax": {
            "url": "inc/logistica_xprogramar_list.php",
            "type": "POST"
        },
        "columns": [
            
            { "data": "destino" },
            { "data": "dctos" },
            { "data": "total" }
        ]
     });

}
function llenarBusqueda() {
	   //Lleno campos de formulario
	   var nroProg = $('#txtNroProg').val();

	   $.post("inc/logistica_programacionCabecera_get.php",{nroProg:nroProg}, function(datos){
	   	console.log(datos);	
	   

	   	var buscar = JSON.parse(datos);
	   	

	   	let cmbTrans = '';
	   	let cmbPlaca = '';
	   	let cmbTveh = '';
	   	let cmbTenv = '';
	   	let cmbConductor = '';
	   	let ruta = '';
	   	let estado ='';


	   	buscar.forEach(busca => {
	   		cmbTrans += `<option value=${busca.nit}>${busca.Transportadora}</option>`
	   		cmbPlaca += `<option value=${busca.idVehiculo}>${busca.Vehiculo}</option>`
	   		cmbTveh += `<option value=${busca.idTipoVehiculo}>${busca.TipoVehiculo}</option>`
	   		cmbTenv += `<option value=${busca.idTipoEnvio}>${busca.TipoEnvio}</option>`
	   		cmbConductor += `<option value=${busca.cedula}>${busca.Conductor}</option>`
	   		ruta += `${busca.Ruta}`
	   		estado += `${busca.idEstado}`         

	   	});

	   	$('#cmbConductor').html(cmbConductor);
	   	$('#txtRuta').val(ruta);
	   	$('#cmbTipoEnvio').html(cmbTenv);
	   	$('#cmbTipoVehiculo').html(cmbTveh);
	   	$('#cmbTransportadora').html(cmbTrans);
	   	$('#cmbPlaca').html(cmbPlaca);
	   	document.getElementById("txtNroProg").disabled=true;
        	//document.getElementById("cmbTransportadora").disabled=true;
        	//document.getElementById("cmbPlaca").disabled=true;

        });
	}

function inicial(){
	//Consecutivo Programacion
$.ajax({
			url: 'inc/logistica_consecutivo_programacion.php',
			type: 'GET',
			
			success: function(datos){
				//console.log(datos);
				var consecutivos = JSON.parse(datos);
				let nro = '';
				
				consecutivos.forEach(consecutivo => {
          nro +=  `${consecutivo.NroProg}`
                          
        });
        $('#txtNroProg').val(nro);       
      },	

		}); //hasta aqui

	//listar transportadoras
$.ajax({
			url: 'inc/logistica_confirmacionTrans_list.php',
			type: 'GET',
			
			success: function(datos){
				//console.log(datos);
				var transportadoras = JSON.parse(datos);
				let combo = '<option value =0>Seleccione</option>';
				
				transportadoras.forEach(transportadora => {
          combo += `
                   <option  value=${transportadora.nit}>${transportadora.Transportadora}</option>
                `          
        });
        $('#cmbTransportadora').html(combo);       
      },	

		}); //hasta aqui
//Obtener Vehiculos Confirmados x Transportadora
$('#cmbTransportadora').change(function(){
		var nit = $(this).val();

		$.post("inc/logistica_confirmacionVehiculo_get.php",{nit:nit}, function(datos){
			
			let vehiculos = JSON.parse(datos);
			let comboVehiculo = '<option  value=0>Seleccione</option>';
				
				
				vehiculos.forEach(vehiculo => {
          comboVehiculo += `
                  <option  value=${vehiculo.idVehiculo}>${vehiculo.placa}</option>
                `
         
                 
        });
        $('#cmbPlaca').html(comboVehiculo); 
        document.getElementById("cmbPlaca").disabled=false;
			
		});
	}); //Hasta aqui
	
	listarDestinos();

}
function listarDestinos() {
	//listar destinos x programar
	$.ajax({
			url: 'inc/logistica_destinosxprogramar_list.php',
			type: 'GET',
			
			success: function(datos){
				//console.log(datos);
				var destinos = JSON.parse(datos);
				let comboDest = '<option  value=0>Seleccione</option>';
				
				
				destinos.forEach(destino => {
          comboDest += `
                  <option value=${destino.Destino}>${destino.Destino}</option>`         
                 
        });
        
        $('#cmbDestino').html(comboDest);        
              
      },	

		});

	//hasta aqui
}

//Obtener Datos de Vehiculo
$('#cmbPlaca').change(function(){
		 var placa = $('select[id=cmbPlaca] option:selected').text();
		 var nit = $('#cmbTransportadora').val();
		 //alert(placa + ' ' + nit);
		 

		$.post("inc/logistica_confirmacionVehiculoDatos_get.php",{placa:placa, nit:nit}, function(datos){
			
			var tiposb = JSON.parse(datos);
			console.log(tiposb);
			let conductor = '';
			let ruta = '';
			let tipoVehiculo = '';
			let tipoEnvio = '';
			
			tiposb.forEach(tipob =>{
				conductor += `<option value=${tipob.cedula}>${tipob.Conductor}</option>`
				ruta += `${tipob.Ruta}`
				tipoVehiculo += `<option value=${tipob.idTipoVehiculo}>${tipob.TipoVehiculo}</option>`
				tipoEnvio += `<option value=${tipob.idTipoEnvio}>${tipob.TipoEnvio}</option>`
				
			});
			
			$('#cmbConductor').html(conductor);
			$('#txtRuta').val(ruta);
			$('#cmbTipoEnvio').html(tipoEnvio);
			$('#cmbTipoVehiculo').html(tipoVehiculo);
			
		});
	}); //Hasta aqui



//hasta aqui
     