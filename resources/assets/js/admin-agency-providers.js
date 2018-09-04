require('./admin-agency-common');
window.select2 = require('select2');
window.toastr = require('toastr');

require("datatables.net");
require("datatables.net-bs");
window.JSZip = require("jszip");
require("datatables.net-buttons");
require("datatables.net-buttons-bs");
require( 'datatables.net-buttons/js/buttons.html5' );

require( 'country-select-js' );


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
let providersTable;

$(document).ready(function(){

    set_toastr_options();

    const ProvidersTable = function(dbdata) {
        const table = $('<table  class="table display cell-border"></table>');
        $('#providersTable').empty().append(table);
         providersTable = table.DataTable({
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
                    "class": 'identityHr',
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return `<div class="identityDiv">${data}</div>`;
                    }
                },
                {
                    "data": 'phone',
                    "title": 'Teléfono',
                    "class": 'text-right phoneHr',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return `<div class="phoneDiv">${data}</div>`;
                    }
                },
                {
                    "data": 'email',
                    "title": 'Email',
                    "orderable": true,
                    "class": ' emailHr',
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return `<div class="emailDiv">${data}</div>`;
                    }
                },
                {
                    "data": '',
                    "title": 'Actividad',
                    "class": 'text-left activitiesHr',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        let html = '';
                        $.each(row.activities, function (i, v) {
                           html += `<div class="activityNameDiv">${v.name}</div> <hr>`;
                        });
                        return html;
                    }
                },
                {
                    "data": '',
                    "title": 'Valor Servicio',
                    "class": 'text-right',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        let html = '';
                        $.each(row.activities, function (i, v) {
                            html += `$ ${ parseFloat(v.pivot.price).format(0, 3, '.', ',')} <hr>`;
                        });
                        return html;
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
                $('.addProviderDiv').html('<button class="btn btn-success addProviderBtn">Adicionar Proveedores</button>');
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

    const providerTypesDivHeight = $('.providerTypes').height();
    $('.download-excel').height(providerTypesDivHeight + 50);
    $('.providerTypes').css('margin-top', -providerTypesDivHeight - 33);


    $('.providerTypes').on("click", ".deleteProviderTypeBtn", function () {
        const providerTypeId = $(this).attr('provider-type-id');
        $.ajax({
            type: 'POST',
            url: `/admin/agency/deleteProviderType`,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'provider_type_id': providerTypeId
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

    $(document.body).undelegate('.addProviderDiv .addProviderBtn', 'click')
        .delegate('.addProviderDiv .addProviderBtn', "click", function(ev) {
            $('#addProviderModal').modal('show');
    });


    $("#country").countrySelect({
        'defaultCountry': 'br',
        });
    const countryData = $("#country").countrySelect("getSelectedCountryData");
    $("#country").countrySelect("selectCountry", "br");


    $(document.body).undelegate('.glyphicon-plus-sign', 'click')
        .delegate(".glyphicon-plus-sign", "click", function(ev){
            let html = `<div class="row activity">
                          <div class="col-sm-4">
                            <select name="activities[]" class="activity form-control">`;
            $.each(activities, function (key, item) {
                html +=      `<option value="${item.id}">
                                    ${item.name}
                              </option>`
            });
            html +=        `</select>
                          </div>
                          <div class="col-sm-2">
                                <input type="text"  class="form-control priceString" placeholder="Valor">
                                <input type="hidden" name="prices[]" class="form-control price" >
                          </div>
                          <div class="col-sm-2">
                              <div class="operations">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                <span class="glyphicon glyphicon-remove"></span>
                              </div>
                          </div>
                        </div>`;
            const element = $(this).parent().parent().parent();
            $(html).insertAfter(element);
        });


    $(document.body).undelegate('.glyphicon-remove', 'click')
        .delegate(".glyphicon-remove", "click", function(ev){
            const element = $(this).parent().parent().parent();
            element.fadeOut().remove();
    });


    $('#addProviderModal').on("click", ".addProviderBtn", function () {
        const formData = $('.addProviderForm, .providerActivitiesForm').serialize();
        const countryData = $("#addProviderModal #country").countrySelect("getSelectedCountryData");
        const country = countryData.iso2;
        $.ajax({
            type: 'POST',
            url: `/admin/agency/addProvider`,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'formData': formData,
                'country': country
            },
            success: function(res){
                let response = JSON.parse(res);
                if(response.success){
                    providersTable.row.add(response.provider).draw();
                    $('#addProviderModal').modal('hide');
                    toastr.success('success');
                    $('.addProviderForm, .providerActivitiesForm').trigger("reset");
                }
                if(response.errorMessages){
                    $.each(response.errorMessages, function (i, value) {
                        toastr.error(value, '');
                    });
                }
            }
        });
    });


    $('#providersTable .dataTables_scrollBody .table tbody').on( 'click', ' tr', function () {
        const tr = $(this);
        $('#providersTable tr.selected').removeClass('selected');
        tr.addClass('selected');
        const row_data = providersTable.row(tr).data();

        $('#deleteProviderOkModal .deleteProviderOkBtn').attr('provider_id', row_data.id);
        $('#deleteProviderOkModal #providerNameSpan').html( row_data.name);
        $.ajax({
            type: 'POST',
            url: `/admin/agency/getProvider`,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'provider_id': row_data.id
            },
            success: function(res){
                $('.editProviderModal').html(res);
                const inputPriceString = $('#editProviderModal .priceString');
                inputPriceString.each(function(i, obj) {
                    $(obj).val(window.numberWithDots($(obj).next().val()));
                });
                $('#editProviderModal').modal('show');
                $("#editProviderModal #country").countrySelect();
                const countryCode = $("#editProviderModal #country").attr('valueCode');
                $("#editProviderModal #country").countrySelect("selectCountry", countryCode);
            }
        });
    });


    $(document.body).undelegate('#editProviderModal .editProviderBtn', 'click')
        .delegate("#editProviderModal .editProviderBtn", "click", function(ev){

        const formData = $('.editProviderForm, .providerActivitiesEditForm').serialize();
        const countryData = $("#editProviderModal #country").countrySelect("getSelectedCountryData");
        const country = countryData.iso2;
        const provider_id = $(this).attr('provider_id');

        $.ajax({
            type: 'POST',
            url: `/admin/agency/editProvider`,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'formData': formData,
                'country': country,
                'provider_id': provider_id,
            },
            success: function(res){
                let response = JSON.parse(res);
                if(response.success){
                    $('#editProviderModal').modal('hide');
                    const tr = $('#providersTable tr.selected');
                    providersTable.row(tr).data(response.provider).draw();
                    toastr.success('success');
                }
                if(response.errorMessages){
                    $.each(response.errorMessages, function (i, value) {
                        toastr.error(value, '');
                    });
                }
            }
        });
    });


    $(document.body).undelegate('#editProviderModal .deleteProviderBtn', 'click')
        .delegate('#editProviderModal .deleteProviderBtn', "click", function(ev) {
            const provider_id = $(this).attr('provider_id');
             $('#editProviderModal').modal('hide');
             $('#deleteProviderOkModal').modal('show');

    });


    $(document.body).undelegate('#deleteProviderOkModal .deleteProviderOkBtn', 'click')
        .delegate('#deleteProviderOkModal .deleteProviderOkBtn', "click", function(ev) {
            const provider_id = $(this).attr('provider_id');
            $.ajax({
                type: 'POST',
                url: `/admin/agency/deleteProvider`,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'provider_id': provider_id
                },
                success: function(res){
                    let response = JSON.parse(res);
                    if(response.success){
                        $('#deleteProviderOkModal').modal('hide');
                        const tr = $('#providersTable tr.selected');
                        providersTable.row(tr).remove().draw();
                        toastr.success('success');
                    }
                    if(response.errorMessages){
                        $.each(response.errorMessages, function (i, value) {
                            toastr.error(value, '');
                        });
                    }
                }
            });
    });




    $(document.body).undelegate('.priceString, ', 'keyup keypress')
        .delegate('.priceString', 'keyup keypress', function(ev) {
            let price = $(this).val();
            price = price.replace(/,|\D/g, "");
            if ($(this).val() != '') {
                $(this).val(window.numberWithDots(price));
            }
            const priceNumber = price.replace(/,|\./g, "");
            $(this).next().val(priceNumber);

    });





});