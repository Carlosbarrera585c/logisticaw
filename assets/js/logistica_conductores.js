$(document).ready(function() {

  	 $.ajax({
    url: "inc/logistica_conductores_list.php",
    type: "GET",
  
      
     success: function(datos) {
      	console.log(datos);
      	
      	/*$.each(nombres, function(index, obj){
      		$("info")obj.Nombre + " " +index.Nombre; 
      	});*/

      	
      	
      	/*$.each(datos, function(index, obj){
      		$("#info").append(obj.Nombre);

      	});*/
      	
     
      
      }
  });
})