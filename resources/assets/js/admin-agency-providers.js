require('./common');
window.select2 = require('select2');
window.toastr = require('toastr');
require('datatables');



set_toastr_options = function(){
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
        providersTable = table.dataTable({
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
                        return data;
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
                    "data": 'id',
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
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return data
                    }
                },
                {
                    "data": 'email',
                    "title": 'Email',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return data
                    }
                },
                {
                    "data": 'service_price',
                    "title": 'Valor Servicio',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return data
                    }
                },


            ],
            "sDom": "<'row'<'col-xs-12 text-xs-center text-left filterDiv 'f><'col-x-12 col-sm-8 btn-group text-xs-center text-right  export_option 'B>><'ze_wrapper margin-top-10 't><'row margin-top-20'<'col-xs-6 units 'l><'col-xs-6'p>>",
            buttons: [

                {
                    extend: 'collection',
                    text: '<i class="fa fa-cog"></i>  ' + 'classroom_export_options' + '  <i class="fa fa-angle-down"></i>',
                    className: 'dt_buttons_drop btn-circle margin-bottom-0 ',

                    buttons: [
                        {
                            extend:    'copyHtml5',
                            text:      '<i class="fa fa-files-o"></i> Copy',
                            titleAttr: 'Copy'
                        },
                        {
                            extend:    'excelHtml5',
                            text:      '<i class="fa fa-file-excel-o"></i> Excel',
                            titleAttr: 'Excel'
                        },
                        {
                            extend:    'csvHtml5',
                            text:      '<i class="fa fa-file-text-o"></i> CSV',
                            titleAttr: 'CSV'
                        },
                        {
                            extend:    'pdfHtml5',
                            text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                            titleAttr: 'PDF'
                        },
                        {
                            extend:    'pdfHtml5',
                            text:      '<i class="fa fa-print"></i> Print',
                            titleAttr: 'PDF'
                        }
                    ],
                    fade: true
                }
            ],
            // "language": {
            //     "url": base_url + "app/lang/" + lang + '.json'
            // },
            "bLengthChange": true,
            "iDisplayLength": 25,
            "drawCallback": function( settings ) {
                // $('.dt-buttons').removeClass('btn-group');
                // $('.dt-buttons .buttons-pdf').attr('class', 'dt-button buttons-pdf buttons-html5 btn green btn-outline');
                // $('.dt-buttons .buttons-print').attr('class', 'dt-button buttons-print btn dark btn-outline');
                // $('.dt-buttons .buttons-csv').attr('class', 'dt-button buttons-csv buttons-html5 btn purple btn-outline');
                // $('.dataTables_filter').addClass('no-padding');
            },
            "bAutoWidth": true,
            "sPaginationType": "simple_numbers",
        });

    };

    ProvidersTable();



});