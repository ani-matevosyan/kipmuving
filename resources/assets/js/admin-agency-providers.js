require('./common');
window.select2 = require('select2');
window.toastr = require('toastr');

require("datatables.net");
require("datatables.net-bs");
window.JSZip = require("jszip");
require("datatables.net-buttons");
require("datatables.net-buttons-bs");
require( 'datatables.net-buttons/js/buttons.html5' );


const set_toastr_options = function(){
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-center",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "4000",
        "extendedTimeOut": "0",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
};


$(document).ready(function(){

    set_toastr_options();

    const ProvidersTable = function(dbdata) {
        const table = $('<table  class="table display cell-border"></table>');
        $('#providersTable').empty().append(table);
        const providersTable = table.dataTable({
            data: providersTableData,
            "ordering": true,
            "searchable": true,
            columns: [
                {
                    "data": 'id',
                    "title": '',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return row.id;
                    }
                },
                {
                    "data": 'first_name',
                    "title": 'Nombre',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return `${row.first_name} ${row.last_name}`;
                    }
                },
                {
                    "data": 'type',
                    "title": 'Tipo',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return row.provider_type.name;
                    }
                },
                {
                    "data": 'address',
                    "title": 'Dirección',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return data;
                    }
                },
                {
                    "data": 'identity',
                    "title": 'ID',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return data;
                    }
                },
                {
                    "data": 'phone',
                    "title": 'Teléfono',
                    "class": 'text-right',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return data;
                    }
                },
                {
                    "data": 'email',
                    "title": 'Email',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return data;
                    }
                },
                {
                    "data": 'service_price',
                    "title": 'Valor Servicio',
                    "class": 'text-right',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return `$ ${data}`;
                    }
                },
            ],
            "sDom": "<'row'<'col-xs-12 text-xs-center text-right filterDiv '<'addProviderDiv'>f>><'ze_wrapper margin-top-10 't><'row margin-top-20'<'col-xs-6 units 'l><'col-xs-6'p>><'bottom download-excel text-right'B>",
            buttons: [
                {
                    extend: 'excel',
                    text: '<span class="glyphicon glyphicon-download-alt"></span> <u>Download Excel</u> ',
                }
            ],
            "sScrollX": "100%",
            "sScrollXInner": "100%",
            "language": {
                "search": "",
                searchPlaceholder: "Buscar"
            },
            "bLengthChange": false,
            "iDisplayLength": 25,
            "drawCallback": function( settings ) {
                $('.addProviderDiv').html('<button class="btn btn-success addProvidersBtn">Adicionar Proveedores</button>');
            },
            "bAutoWidth": true,
            "paging": false,
            "sPaginationType": "simple_numbers",
        });

    };

    ProvidersTable();


    $('.providerTypes').on("click", ".addProviderType", function () {
        $('#addProviderTypeModal').modal('show');
    });
    $('#addProviderTypeModal').on("click", ".addProviderTypeBtn", function () {
       const providerType = $('input[name=provider_type]').val();
        $.ajax({
            type: 'POST',
            url: `/admin/agency/addProviderType`,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'provider_type': providerType
            },
            success: function(res){
                let response = JSON.parse(res);
                if(response.success){
                    window.location.reload();
                }
                if(response.errorMessages){
                    $.each(response.errorMessages, function (i, value) {
                        toastr.error(value, '');
                    });
                }
            }
        });
    });



});