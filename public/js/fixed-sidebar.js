!function(t){function e(n){if(o[n])return o[n].exports;var r=o[n]={i:n,l:!1,exports:{}};return t[n].call(r.exports,r,r.exports,e),r.l=!0,r.exports}var o={};e.m=t,e.c=o,e.d=function(t,o,n){e.o(t,o)||Object.defineProperty(t,o,{configurable:!1,enumerable:!0,get:n})},e.n=function(t){var o=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(o,"a",o),o},e.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},e.p="",e(e.s=33)}({33:function(t,e,o){t.exports=o(34)},34:function(t,e){$(document).ready(function(){var t=$(".s-program__content"),e=$(".s-program"),o=t.outerWidth(),n=t.outerHeight();$(window).resize(function(){o=t.outerWidth()}),$(window).width()>991&&$(window).scroll(function(){var r=$(window).scrollTop();e.offset().top<r?(e.css("height",n+"px"),t.css("width",o+"px").addClass("fixed")):(e.css("height",""),t.css("width","").removeClass("fixed"))})})}});