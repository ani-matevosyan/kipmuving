
$(window).load(function(){
    if (typeof(Storage) !== "undefined") {
        if (window.location.pathname === '/home' || window.location.pathname === '/') {
            if(localStorage.hometour !== "visited"){
                homeTour();
           }
        }
        if (window.location.pathname === '/activities') {
            if(localStorage.activitiestour !== "visited"){
                activitiesTour();
            }
        }
        if (window.location.pathname.indexOf('/activity/') === 0) {
            if(localStorage.activitytour !== "visited") {
                activitytour();
            }
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
        }, {
            element: '#program-schedule',
            title: 'Su carrito de actividades',
            content: 'Aquí estará su carrito de actividades. Para ir finalizando su reserva, presione AGENDA.',
            image: 'images/tour/home-tour-2.jpg'
        }, {
            element: '#guia',
            title: 'Guia de Pucón',
            content: 'Preparamos una guia completa de Pucón con las actividades más buscadas y también tours gratuitos que puede hacer.',
            image: 'images/tour/home-tour-3.jpg'
        }]);
        productTour_home.startTour();
        localStorage.hometour = "visited";
    }

    function activitiesTour(){
        var productTour_activities = new ProductTour({
            overlay: true
        });
        productTour_activities.steps([{
            element: '#first-slider-sec',
            title: 'Los más pedidos',
            content: 'Aquí puedes encontrar cuales son las actividades más buscadas en Pucón.',
            image: 'images/tour/activities-tour-1.jpg'
        }, {
            element: '#floatdiv',
            title: 'Estilos de Actividades',
            content: 'Para facilitar, separamos las actividades por estilos.',
            image: 'images/tour/activities-tour-2.jpg'
        },{
            element: '#activities-info',
            title: 'Iconografia',
            content: 'Algunas clasificaciones de actividades, que te ayudará a elegir el momento correcto de hacerlas.',
            image: 'images/tour/activities-tour-3.jpg'
        }
        ]);
        productTour_activities.startTour();
        localStorage.activitiestour = "visited";
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

    $(".info-tour").click(function(){
        if (window.location.pathname === '/home' || window.location.pathname === '/'){
            homeTour();
        }else if (window.location.pathname === '/activities'){
            activitiesTour();
        }else if(window.location.pathname.indexOf('/activity/') === 0){
            activitytour();
        }
    })
});