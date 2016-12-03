$(window).load(function(){
    if (typeof(Storage) !== "undefined") {
        if (window.location.pathname === '/home' || window.location.pathname === '/') {
            if(localStorage.hometour !== "visited"){
                var productTour_home = new ProductTour({
                    overlay: true
                });
                productTour_home.steps([{
                    element: '#activity-form',
                    title: 'Activity form',
                    content: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy',
                    image: 'images/tour/home-tour-1.jpg'
                }, {
                    element: '#program-schedule',
                    title: 'Program schedule',
                    content: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy',
                    image: 'images/tour/home-tour-2.jpg'
                }, {
                    element: '#guia',
                    title: 'Guia section',
                    content: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy',
                    image: 'images/tour/home-tour-3.jpg'
                }]);
                productTour_home.startTour();
                localStorage.hometour = "visited";
           }
        }
        if (window.location.pathname === '/activities') {
            if(localStorage.activitiestour !== "visited"){
                var productTour_activities = new ProductTour({
                    overlay: true
                });
                productTour_activities.steps([{
                    element: '#first-slider-sec',
                    title: 'Slider',
                    content: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy',
                    image: 'images/tour/activities-tour-1.jpg'
                }, {
                    element: '#floatdiv',
                    title: 'Types',
                    content: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy',
                    image: 'images/tour/activities-tour-2.jpg'
                }]);
                productTour_activities.startTour();
                localStorage.activitiestour = "visited";
            }
        }
        if (window.location.pathname.indexOf('/activity/') === 0) {
            if(localStorage.activitytour !== "visited") {
                var productTour_activity = new ProductTour({
                    overlay: true
                });
                productTour_activity.steps([{
                    element: '.jcf-select-persona',
                    title: 'Persons',
                    content: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy',
                    image: '../images/tour/activity-tour-1.jpg'
                }, {
                    element: '.btn-reserve',
                    title: 'Reserve',
                    content: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy',
                    image: '../images/tour/activity-tour-2.jpg'
                }]);
                productTour_activity.startTour();
                localStorage.activitytour = "visited";
            }
        }
    }
});