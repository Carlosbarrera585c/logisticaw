//include('/lib/data-table/datatables-init.js');
$(document).ready(function() {
	$('#bootstrap-data-table').DataTable({
	'destroy':true,
      	'responsive':true,
      	'searching': true,
      	language: {
            'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
        },

        scrollY:        '50vh',
        "scrollX": true,
        scrollCollapse: true,
        paging:         false,
        //scrollCollapse: true,
   

    } );

			
			});
     
	$('#btnProcesar').on('click', function(){

		var empresa, fecha, hora, dcto, nit, cliente, bodega, producto, cantidad, vlrUnitario, total, encabezado, detalle, destino, direccion, tipo;
		//var data = $('#bootstrap-data-table').rows(),data();
		alert("boton presionado");


		$('#bootstrap-data-table tr').each(function(idx, fila){

			id = fila.children[0].innerHTML;		
			empresa = fila.children[1].innerHTML;
			fecha=fila.children[2].innerHTML;
			hora=fila.children[3].innerHTML;
			dcto=fila.children[4].innerHTML;
			nit=fila.children[5].innerHTML;
			cliente=fila.children[6].innerHTML;
			bodega=fila.children[7].innerHTML;
			producto=fila.children[8].innerHTML;
			cantidad=fila.children[9].innerHTML;
			vlrUnitario=fila.children[10].innerHTML;
			total=fila.children[11].innerHTML;
			encabezado=fila.children[12].innerHTML;  
			detalle=fila.children[13].innerHTML;
			destino=fila.children[14].innerHTML;
			direccion=fila.children[15].innerHTML;
			tipo=fila.children[16].innerHTML;



			//let 
			//console.log(empresa + fecha + hora + dcto + nit + cliente + bodega + producto + cantidad + vlr_Unitario + total );

				$.ajax({
                data:  {id:id, empresa:empresa, fecha:fecha, hora:hora, dcto:dcto, nit:nit,cliente:cliente, bodega:bodega, producto:producto,cantidad:cantidad, vlrUnitario:vlrUnitario, total:total, encabezado:encabezado, detalle:detalle, destino:destino, direccion:direccion, tipo:tipo} , //datos que se envian a traves de ajax
                url:   'inc/logistica_corte_insert.php', //archivo que recibe la peticion
                type:  'POST', //método de envio
                //dataType: 'json',
              
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        console.log(response);                      
                }
        });
				

			
		});	
		//alert("termino each");

		
	});
	
	

	 function listar(){
		var table = $('#bootstrap-data-table').DataTable();
				table.destroy();

				table = $('#bootstrap-data-table').DataTable({


					"pageLength": -1,

        order: [ typeof idColumnaOrden === 'undefined' ? 0 : idColumnaOrden, 'desc' ],
        dom: 'Bfrtip',
        lengthMenu: [

            [ 10, 25, 50, -1 ],
            [ '10 registros', '25 registros', '50 registros', 'Todos' ]
        ],
        buttons: [
            'pageLength',
            {
                extend: 'excelHtml5',
                action: function ( e, dt, node, config ) {
                   // $('#preloader').show();
                    //$('#status').show();
                    var that = this;
                    setTimeout(function () {
                        $.fn.dataTable.ext.buttons.excelHtml5.action.call(that,e, dt, node, config);
                        $('#preloader').hide();
                        $('#status').hide();
                    },500);
                },
                className: 'btn btn-success btnExcel',
                text: '<i class="fa fa-file-excel-o" style="font-size: 1.2em;"></i>&nbsp;&nbsp;<span class="btnText">Exportar a Excel</span></div>',
                filename: typeof nombreListado === 'undefined' ? '' : nombreListado,
                init: function (api, node, config) {
                    $(node).removeClass('dt-button')
                }
            },
        ],
     
        


					'ajax':{
						'method':'GET',
						'url': 'inc/logistica_corte_list.php'
					},
					'columns':[
					{'data':'id'},
					{'data':'EMPRESA'},
					{'data':'Fecha_Dcto'},
					{'data':'HORA'},
					{'data':'NumeroDocumento'},
					{'data':'NIT'},
					{'data':'Nombre_Cliente'},
					{'data':'BODEGA'},
					{'data':'Nombre_Producto_Mvto'},
					{'data':'Cantidad'},
					{'data':'Vlr_Unitario'},
					{'data':'Total_Prod'},
					{'data':'Nota_Encabezado'},
					{'data':'Nota_Detalle'},
					{'data':'CIUDADCLI'},
					{'data':'DIR'},
					{'data':'TIPO'}
					]


				});


		

	}




	

