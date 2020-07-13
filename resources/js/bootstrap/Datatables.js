//DataTables
window.datatables    = require('datatables.net');
//datatables(window, $);

//DataTables Bootstrap
window.datatables_bs = require('datatables.net-bs');
//datatables_bs(window, $);

//DataTables Responsive
require('datatables.net-responsive');

//DataTables Responsive Bootstrap
require('datatables.net-responsive-bs');

//datatables.Responsive.defaults = {
//    orthogonal: 'responsive',
//};

//datatables.Responsive.defaults.orthogonal = 'responsive'

datatables.defaults.oLanguage = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
};

