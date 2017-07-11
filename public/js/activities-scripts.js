$(document).ready(function(){

    //Opening and closing mobile filter modal
    var filtersModal = $(".filters-modal");
    $(".btn-open-filters").click(function(e){
        e.preventDefault();
        filtersModal.show();
        $('body').css('overflow-y', 'hidden');
    });

    $(".btn-cancel-filters").click(function(e){
       e.preventDefault();
        filtersModal.hide();
        $('body').css('overflow-y', 'auto');
    });


    //Filters functionality


    function collectData(){
        var filterData = [];
        $(".filter-item input[type=checkbox]").each(function(){
            filterData.push({
                name: $(this).val(),
                value: $(this).is(":checked")
            });
        });
        filterData.push({
            name: 'Price range',
            value: $("#slider-range").slider('values', 0)+', '+ $("#slider-range").slider('values', 1)
        });
        $.ajax({
            type: "POST",
            url: "/activities/filters",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                data: JSON.stringify(filterData)
            },
            success: function(){
                console.log('ok');
            }
        })
    }

    $(".filter-item input[type=checkbox]").on('change', function(){
        collectData();
    });

    $( "#slider-range" ).slider({
        range: true,
        min: 10000,
        max: 300000,
        step: 100,
        values: [ 10000, 300000 ],
        slide: function( event, ui ) {
            $( ".slider-range-output" ).val( "$ " + ui.values[ 0 ] + " - $ " + ui.values[ 1 ] );
        },
        change: function( event, ui ) {
           collectData();
        }
    });
    $( ".slider-range-output" ).val( "$ " + $( "#slider-range" ).slider( "values", 0 ) +
        " - $ " + $( "#slider-range" ).slider( "values", 1 ) );
});