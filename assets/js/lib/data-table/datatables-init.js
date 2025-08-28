//** jccampoh - 27-03-2019: Traducción al español **/

(function ($) {
    //    "use strict";

    /*  Data Table
    -------------*/
    var table = $('#bootstrap-data-table').DataTable({
        "pageLength": 10,
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
                    $('#preloader').show();
                    $('#status').show();
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
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
            buttons: {
                pageLength: {
                    _: "Muestra %d registros",
                    '-1': "Todos"
                }
            }
        }
    });

    $('#bootstrap-data-table-export').DataTable({
        dom: 'lBfrtip',
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('#row-select').DataTable({
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var select = $('<select class="form-control"><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }
    });
})(jQuery);