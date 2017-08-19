
$(window).load(function(){

    var isDesctop = $(window).width() > 767;

    $(window).resize(function () {
        isDesctop = $(window).width() > 767;
    });

    if (typeof(Storage) !== "undefined" && isDesctop) {
        if (window.location.pathname === '/home' || window.location.pathname === '/') {
            if(localStorage.hometour !== "visited"){
                homeTour();
           }
           $(".info-tour").show();
        }
        if (window.location.pathname.indexOf('/activity/') === 0) {
            if(localStorage.activitytour !== "visited") {
                activitytour();
            }
            $(".info-tour").show();
        }
        if (window.location.pathname === '/reserve') {
            if(localStorage.reservationtour !== "visited"){
                reservationtour();
            }
            $(".info-tour").show();
        }
    }

    function homeTour(){
        var productTour_home = new ProductTour({
            overlay: true
        });
        productTour_home.steps([{
            element: '#activity-form',
            title: 'Busque su actividad',
            content: 'Busque las actividades que quiere hacer y seleccione la fecha que estará en Pucón.',
            image: 'images/tour/home-tour-1.jpg'
        },{
            element: '#guia',
            title: 'Guia de Pucón',
            content: 'Preparamos una guia completa de Pucón con las actividades más buscadas y también tours gratuitos que puede hacer.',
            image: 'images/tour/home-tour-3.jpg'
        }]);
        productTour_home.startTour();
        localStorage.hometour = "visited";
    }

    function activitytour(){
        var productTour_activity = new ProductTour({
            overlay: true
        });
        productTour_activity.steps([{
            element: '.jcf-select-persona',
            title: 'Elija la cantidad de Personas',
            content: 'Para cada actividad, seleccione la cantidad de personas',
            image: '../images/tour/activity-tour-1.jpg'
        }, {
            element: '.jcf-select-hours',
            title: 'Los horarios',
            content: 'Algunas actividades poseen dos horarios distintos, elija aquel que más le acomode',
            image: '../images/tour/activity-tour-2.jpg'
        }, {
            element: '.btn-reserve',
            title: 'La fecha',
            content: 'Recuerde de seleccionar la fecha correcta para la actividad que quiere hacer',
            image: '../images/tour/activity-tour-3.jpg'
        }, {
            element: '#program-schedule',
            title: 'Incluya la actividad',
            content: 'Presione el botón AGREGAR, para incluir en su carrito de actividades',
            image: '../images/tour/activity-tour-4.jpg'
        }, {
            element: '#reserve-date',
            title: 'Su carrito',
            content: 'Luego presionar AGREGAR, sus actividades estarán en su carrito. Para finalizar su reserva, presione MI AGENDA',
            image: '../images/tour/home-tour-2.jpg'
        }
        ]);
        productTour_activity.startTour();
        localStorage.activitytour = "visited";
    }

    function reservationtour(){
        var productTour_activity = new ProductTour({
            overlay: true
        });
        productTour_activity.steps([{
            element: '#reservetour1',
            title: 'Atento a las condiciones de las agencias',
            content: 'Cada actividad y agencia tiene sus propias condiciones. Esté atento cuales son.',
            image: '../images/tour/reserve-tour-1.jpg'
        },{
            element: '.btn-reservar.reserve',
            title: 'Reservar',
            content: 'Para confirmar sus actividades, presione el botón y pague la tarifa de reserva.',
            image: '../images/tour/reserve-tour-2.jpg'
        }
        ]);
        productTour_activity.startTour();
        localStorage.reservationtour = "visited";
    }

    $(".info-tour").click(function(){
        if(isDesctop){
            if (window.location.pathname === '/home' || window.location.pathname === '/'){
                homeTour();
            }else if (window.location.pathname === '/activities'){
                activitiesTour();
            }else if(window.location.pathname.indexOf('/activity/') === 0){
                activitytour();
            }else if(window.location.pathname === '/reserve'){
                reservationtour();
            }
        }
    })
});