!function(e){function t(o){if(a[o])return a[o].exports;var i=a[o]={i:o,l:!1,exports:{}};return e[o].call(i.exports,i,i.exports,t),i.l=!0,i.exports}var a={};t.m=e,t.c=a,t.d=function(e,a,o){t.o(e,a)||Object.defineProperty(e,a,{configurable:!1,enumerable:!0,get:o})},t.n=function(e){var a=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(a,"a",a),a},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="",t(t.s=180)}({180:function(e,t,a){e.exports=a(7)},7:function(e,t){$(window).on("load",function(){function e(){var e=new ProductTour({overlay:!0});e.steps([{element:"#activity-form",title:"Busque su actividad",content:"Busque las actividades que quiere hacer y seleccione la fecha que estará en Pucón.",image:"images/tour/home-tour-1.jpg"},{element:"#guia",title:"Guia de Pucón",content:"Preparamos una guia completa de Pucón con las actividades más buscadas y también tours gratuitos que puede hacer.",image:"images/tour/home-tour-3.jpg"}]),e.startTour(),localStorage.hometour="visited"}function t(){var e=new ProductTour({overlay:!0});e.steps([{element:".jcf-select-hours",title:"Los horarios",content:"Algunas actividades poseen dos horarios distintos, elija aquel que más le acomode",image:"../images/tour/activity-tour-2.jpg"},{element:".btn-reserve",title:"La fecha",content:"Recuerde de seleccionar la fecha correcta para la actividad que quiere hacer",image:"../images/tour/activity-tour-3.jpg"},{element:"#program-schedule",title:"Incluya la actividad",content:"Presione el botón AGREGAR, para incluir en su carrito de actividades",image:"../images/tour/activity-tour-4.jpg"},{element:"#reserve-date",title:"Su carrito",content:"Luego presionar AGREGAR, sus actividades estarán en su carrito. Para finalizar su reserva, presione MI AGENDA",image:"../images/tour/home-tour-2.jpg"}]),e.startTour(),localStorage.activitytour="visited"}function a(){var e=new ProductTour({overlay:!0});e.steps([{element:"#reservetour1",title:"Atento a las condiciones de las agencias",content:"Cada actividad y agencia tiene sus propias condiciones. Esté atento cuales son.",image:"../images/tour/reserve-tour-1.jpg"},{element:".btn-reservar.reserve",title:"Reservar",content:"Para confirmar sus actividades, presione el botón y pague la tarifa de reserva.",image:"../images/tour/reserve-tour-2.jpg"}]),e.startTour(),localStorage.reservationtour="visited"}var o=$(window).width()>767;$(window).resize(function(){o=$(window).width()>767}),"undefined"!=typeof Storage&&o&&("/home"!==window.location.pathname&&"/"!==window.location.pathname||("visited"!==localStorage.hometour&&e(),$(".info-tour").show()),0===window.location.pathname.indexOf("/activity/")&&("visited"!==localStorage.activitytour&&t(),$(".info-tour").show()),"/reserve"===window.location.pathname&&("visited"!==localStorage.reservationtour&&a(),$(".info-tour").show())),$(".info-tour").click(function(){o&&("/home"===window.location.pathname||"/"===window.location.pathname?e():"/activities"===window.location.pathname?activitiesTour():0===window.location.pathname.indexOf("/activity/")?t():"/reserve"===window.location.pathname&&a())})})}});