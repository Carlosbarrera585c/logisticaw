$(document).ready(function() {
	listar();

		function addCommas(nStr) { 
    nStr += ''; 
    var x = nStr.split('.'); 
    var x1 = x[0]; 
    var x2 = x.length > 1 ? '.' + x[1] : ''; 
    var rgx = /(\d+)(\d{3})/; 
    while (rgx.test(x1)) { 
     x1 = x1.replace(rgx, '$1' + ',' + '$2'); 
    } 
    return x1 + x2; 
} ;

	$('#btnAgregar').on('click', function(){
		$('#modalConfirmacion').modal();

		$('#tituloModal').html('Agregar Confirmación de Vehículo')
	//listo transportadoras
		$.ajax({
			url: 'inc/logistica_transportadoras_list.php',
			type: 'GET',
			
			success: function(datos){
				//console.log(datos);
				var transportadoras = JSON.parse(datos);
				let combo = '<option value =0>Seleccione</option>';
				
				transportadoras.forEach(transportadora => {
          combo += `
                   <option  value=${transportadora.id}>${transportadora.Transportadora}</option>
                `          
        });
        $('#cmbTransportadora').html(combo);       
      },	

		}); //hasta aqui

		//listar Tipo Envio
		$.ajax({
			url: 'inc/logistica_tipoEnvio_list.php',
			type: 'GET',
			
			success: function(datos){
				//console.log(datos);
				var tipos = JSON.parse(datos);
				let combo = '<option  value=0>Seleccione</option>';
				
				tipos.forEach(tipo => {
          combo += `
                  <option  value=${tipo.id}>${tipo.TipoEnvio}</option>
                `          
        });
        $('#cmbTipoEnvio').html(combo);       
      },	

		});

		//hasta Aqui
		//listar Ciudades
		$.ajax({
			url: 'inc/logistica_ciudades_list.php',
			type: 'GET',
			
			success: function(datos){
				//console.log(datos);
				var ciudades = JSON.parse(datos);
				let combo = '<option  value=0>Seleccione</option>';
				
				ciudades.forEach(ciudad => {
          combo += `
                  <option  value=${ciudad.id}>${ciudad.Ciudad}</option>
                `          
        });
        $('#cmbOrigen').html(combo);  
        $('#cmbDestino').html(combo);       
      },	

		});
		//hasta 
		//
		$.ajax({
			url: 'inc/logistica_conductores_list.php',
			type: 'GET',
			
			success: function(datos){
				//console.log(datos);
				var conductores = JSON.parse(datos);
				let combo = '<option  value=0>Seleccione</option>';
				
				conductores.forEach(conductor => {
          combo += `
                  <option  value=${conductor.id}>${conductor.Nombre} ${conductor.Apellidos}</option>
                `          
        });
        $('#cmbConductor').html(combo);       
      },	

		});

		//
		//Listar Vehiculos
		$.ajax({
			url: 'inc/logistica_vehiculos_list.php',
			type: 'GET',
			
			success: function(datos){
				//console.log(datos);
				var vehiculos = JSON.parse(datos);
				let combo = '<option  value=0>Seleccione</option>';
				let tipo = '';
				
				vehiculos.forEach(vehiculo => {
          combo += `
                  <option  value=${vehiculo.id}>${vehiculo.placa}</option>
                `
                 
        });
        $('#cmbPlaca').html(combo); 
        
              
      },	

		});		
		//Hasta Aqui
		
	});
	//Obtener datos vehiculo Seleccionado
	$('#cmbPlaca').change(function(){
		 id = $(this).val();		
		$.post("inc/logistica_tipoVehiculos_get.php",{id:id}, function(datos){
			
			let tiposb = JSON.parse(datos);
			console.log(tiposb);
			let tipoV = '';
			let vencSoat = '';
			let vencTecno = '';
			tiposb.forEach(tipob =>{
				tipoV += `${tipob.tipo}`
				vencSoat += `${tipob.fechaSoat}`
				vencTecno += `${tipob.fechaTecno}`
			});
			console.log(tipoV);
			$('#txtTipoVehiculo').val(tipoV);
			$('#txtVencSoat').val(vencSoat);
			$('#txtVencTecno').val(vencTecno);
		});
	}); //Hasta aqui



	//Obtener datos Conductor Seleccionado
	$('#cmbConductor').change(function(){
		 id = $(this).val();		
		$.post("inc/logistica_conductores_get.php",{id:id}, function(datos){
			
			let conductores = JSON.parse(datos);
			console.log(conductores);
			
			let vencLic = '';
			let vMulta = '';
			let cedula = '';
			conductores.forEach(conductor =>{
				vencLic += `${conductor.fecha}`
				vMulta += `${conductor.valor_multas}`
				cedula += `${conductor.cedula}`
				
			});		
			$('#txtVigLic').val(vencLic);
			$('#txtValMulta').val(addCommas(vMulta));
			$('#txtCedula').val(addCommas(cedula));
			
		});
	}); //Hasta aqui


	function listar(){
		$.ajax({
			url: 'inc/logistica_confirmacion_list.php',
			type: 'GET',
			
			success: function(datos){
				//console.log(datos);
				var confirmaciones = JSON.parse(datos);
				let tabla = '';
				
				confirmaciones.forEach(confirmacion => {
          tabla += `
                 <tr>
                  <td style="display:none;">${confirmacion.id}</td>
                  <td>${confirmacion.Transportadora}</td>
                  <td>${confirmacion.TipoEnvio}</td>
                  <td>${confirmacion.CiudadOr}</td>
                  <td>${confirmacion.CiudadDe}</td>
                  <td>${confirmacion.Ruta}</td>
                  <td><a href="#" class="placa">
                    ${confirmacion.placa} 
                  </a></td>
                  <td>${confirmacion.TipoVehiculo}</td>
                  <td>${confirmacion.Conductor}</td>                   
                  <td>${confirmacion.horaEstimada}</td>
                  <td>${confirmacion.valorFlete}</td>
                  <td>${confirmacion.MotivoMod}</td>
                  <td>${confirmacion.horaAprob_Aseguradora}</td>
                  <td>
                    <button class="task-delete btn btn-danger">
                     Delete 
                    </button>
                  </td>
                 </tr>
                `
          
        });
        $('#tabla').html(tabla);
       
      },

		

		});


		

	}

	$(document).on('click', '.placa', (e) => {
		$('#modalConfirmacion').modal();

		$('#tituloModal').html('Actualizar Confirmación de Vehículo')
		$('btnProcesar').value('Actualizar');
	//listo transportadoras

	})

	
});
