function initCustomForms(){jcf.setOptions("Select",{wrapNative:!1,wrapNativeOnMobile:!1,maxVisibleItems:5}),jcf.replaceAll()}function initAccordion(){jQuery("ul.accordion").slideAccordion({opener:"a.opener",slider:"div.slide",animSpeed:300})}function initMobileNav(){jQuery("body").mobileNav({menuActiveClass:"nav-active",menuOpener:".nav-opener"})}function initSameHeight(){jQuery(".two-columns, .packages").sameHeight({elements:".box",flexible:!0,multiLine:!0})}jQuery(window).load(function(){initCustomForms(),initAccordion(),initMobileNav(),initSameHeight(),jQuery("input, textarea").placeholder()}),function(e){e.fn.slideAccordion=function(i){var n=e.extend({addClassBeforeAnimation:!1,allowClickWhenExpanded:!1,activeClass:"active",opener:".opener",slider:".slide",animSpeed:300,collapsible:!0,event:"click"},i);return this.each(function(){var i=e(this),o=i.find(":has("+n.slider+")");o.each(function(){var i=e(this),o=i.find(n.opener),l=i.find(n.slider);o.bind(n.event,function(e){if(!l.is(":animated"))if(i.hasClass(n.activeClass)){if(n.allowClickWhenExpanded)return;n.collapsible&&l.slideUp(n.animSpeed,function(){s(l),i.removeClass(n.activeClass)})}else{var o=i.siblings("."+n.activeClass),a=o.find(n.slider);i.addClass(n.activeClass),t(l).hide().slideDown(n.animSpeed),a.slideUp(n.animSpeed,function(){o.removeClass(n.activeClass),s(a)})}e.preventDefault()}),i.hasClass(n.activeClass)?t(l):s(l)})})};var t=function(e){return e.css({position:"",top:"",left:"",width:""})},s=function(e){return e.show().css({position:"absolute",top:-9999,left:-9999,width:e.width()})}}(jQuery),function(e){function t(t){this.options=e.extend({container:null,hideOnClickOutside:!1,menuActiveClass:"nav-active",menuOpener:".nav-opener",menuDrop:".nav-drop",toggleEvent:"click",outsideClickEvent:"click touchstart pointerdown MSPointerDown"},t),this.initStructure(),this.attachEvents()}t.prototype={initStructure:function(){this.page=e("html"),this.container=e(this.options.container),this.opener=this.container.find(this.options.menuOpener),this.drop=this.container.find(this.options.menuDrop)},attachEvents:function(){var t=this;s&&(s(),s=null),this.outsideClickHandler=function(s){if(t.isOpened()){var i=e(s.target);i.closest(t.opener).length||i.closest(t.drop).length||t.hide()}},this.openerClickHandler=function(e){e.preventDefault(),t.toggle()},this.opener.on(this.options.toggleEvent,this.openerClickHandler)},isOpened:function(){return this.container.hasClass(this.options.menuActiveClass)},show:function(){this.container.addClass(this.options.menuActiveClass),this.options.hideOnClickOutside&&this.page.on(this.options.outsideClickEvent,this.outsideClickHandler)},hide:function(){this.container.removeClass(this.options.menuActiveClass),this.options.hideOnClickOutside&&this.page.off(this.options.outsideClickEvent,this.outsideClickHandler)},toggle:function(){this.isOpened()?this.hide():this.show()},destroy:function(){this.container.removeClass(this.options.menuActiveClass),this.opener.off(this.options.toggleEvent,this.clickHandler),this.page.off(this.options.outsideClickEvent,this.outsideClickHandler)}};var s=function(){var t,s,i=e(window),n=e("html"),o="resize-active",l=function(){t=!1,n.removeClass(o)},a=function(){t||(t=!0,n.addClass(o)),clearTimeout(s),s=setTimeout(l,500)};i.on("resize orientationchange",a)};e.fn.mobileNav=function(s){return this.each(function(){var i=e.extend({},s,{container:this}),n=new t(i);e.data(this,"MobileNav",n)})}}(jQuery),function(e){function t(t,o){var l,a=e(),r=0,h=t.eq(0).offset().top;t.each(function(){var t=e(this);t.offset().top===h?a=a.add(this):(l=s(a),r=Math.max(r,i(a,l,o)),a=t,h=t.offset().top)}),a.length&&(l=s(a),r=Math.max(r,i(a,l,o))),o.biggestHeight&&t.css(o.useMinHeight&&n?"minHeight":"height",r)}function s(t){var s=0;return t.each(function(){s=Math.max(s,e(this).outerHeight())}),s}function i(t,s,i){var o,l="number"==typeof s?s:s.height();return t.removeClass(i.leftEdgeClass).removeClass(i.rightEdgeClass).each(function(){var t=e(this),a=0,r="border-box"===t.css("boxSizing")||"border-box"===t.css("-moz-box-sizing")||"border-box"===t.css("-webkit-box-sizing");"number"!=typeof s&&t.parents().each(function(){var t=e(this);return s.is(this)?!1:void(a+=t.outerHeight()-t.height())}),o=l-a,o-=r?0:t.outerHeight()-t.height(),o>0&&t.css(i.useMinHeight&&n?"minHeight":"height",o)}),t.filter(":first").addClass(i.leftEdgeClass),t.filter(":last").addClass(i.rightEdgeClass),o}e.fn.sameHeight=function(s){var o=e.extend({skipClass:"same-height-ignore",leftEdgeClass:"same-height-left",rightEdgeClass:"same-height-right",elements:">*",flexible:!1,multiLine:!1,useMinHeight:!1,biggestHeight:!1},s);return this.each(function(){function s(){h.css(o.useMinHeight&&n?"minHeight":"height",""),o.multiLine?t(h,o):i(h,r,o)}var l,a,r=e(this),h=r.find(o.elements).not("."+o.skipClass);if(h.length){s();var c=function(){a||(a=!0,s(),clearTimeout(l),l=setTimeout(function(){s(),setTimeout(function(){a=!1},10)},100))};o.flexible&&e(window).bind("resize orientationchange fontresize",c),e(window).bind("load",c)}})};var n="undefined"!=typeof document.documentElement.style.maxHeight}(jQuery),jQuery.onFontResize=function(e){return e(function(){var t="font-resize-frame-"+Math.floor(1e3*Math.random()),s=e("<iframe>").attr("id",t).addClass("font-resize-helper");if(s.css({width:"100em",height:"10px",position:"absolute",borderWidth:0,top:"-9999px",left:"-9999px"}).appendTo("body"),window.attachEvent&&!window.addEventListener)s.bind("resize",function(){e.onFontResize.trigger(s[0].offsetWidth/100)});else{var i=s[0].contentWindow.document;i.open(),i.write('<script>window.onload = function(){var em = parent.jQuery("#'+t+'")[0];window.onresize = function(){if(parent.jQuery.onFontResize){parent.jQuery.onFontResize.trigger(em.offsetWidth / 100);}}};</script>'),i.close()}jQuery.onFontResize.initialSize=s[0].offsetWidth/100}),{trigger:function(t){e(window).trigger("fontresize",[t])}}}(jQuery),function(e,t,s){function i(e){var t={},i=/^jQuery\d+$/;return s.each(e.attributes,function(e,s){s.specified&&!i.test(s.name)&&(t[s.name]=s.value)}),t}function n(e,t){var i=this,n=s(i);if(i.value==n.attr("placeholder")&&n.hasClass("placeholder"))if(n.data("placeholder-password")){if(n=n.hide().next().show().attr("id",n.removeAttr("id").data("placeholder-id")),e===!0)return n[0].value=t;n.focus()}else i.value="",n.removeClass("placeholder"),i==l()&&i.select()}function o(){var e,t=this,o=s(t),l=this.id;if(""==t.value){if("password"==t.type){if(!o.data("placeholder-textinput")){try{e=o.clone().attr({type:"text"})}catch(a){e=s("<input>").attr(s.extend(i(this),{type:"text"}))}e.removeAttr("name").data({"placeholder-password":o,"placeholder-id":l}).bind("focus.placeholder",n),o.data({"placeholder-textinput":e,"placeholder-id":l}).before(e)}o=o.removeAttr("id").hide().prev().attr("id",l).show()}o.addClass("placeholder"),o[0].value=o.attr("placeholder")}else o.removeClass("placeholder")}function l(){try{return t.activeElement}catch(e){}}var a,r,h="[object OperaMini]"==Object.prototype.toString.call(e.operamini),c="placeholder"in t.createElement("input")&&!h,p="placeholder"in t.createElement("textarea")&&!h,d=s.fn,u=s.valHooks,f=s.propHooks;c&&p?(r=d.placeholder=function(){return this},r.input=r.textarea=!0):(r=d.placeholder=function(){var e=this;return e.filter((c?"textarea":":input")+"[placeholder]").not(".placeholder").bind({"focus.placeholder":n,"blur.placeholder":o}).data("placeholder-enabled",!0).trigger("blur.placeholder"),e},r.input=c,r.textarea=p,a={get:function(e){var t=s(e),i=t.data("placeholder-password");return i?i[0].value:t.data("placeholder-enabled")&&t.hasClass("placeholder")?"":e.value},set:function(e,t){var i=s(e),a=i.data("placeholder-password");return a?a[0].value=t:i.data("placeholder-enabled")?(""==t?(e.value=t,e!=l()&&o.call(e)):i.hasClass("placeholder")?n.call(e,!0,t)||(e.value=t):e.value=t,i):e.value=t}},c||(u.input=a,f.value=a),p||(u.textarea=a,f.value=a),s(function(){s(t).delegate("form","submit.placeholder",function(){var e=s(".placeholder",this).each(n);setTimeout(function(){e.each(o)},10)})}),s(e).bind("beforeunload.placeholder",function(){s(".placeholder").each(function(){this.value=""})}))}(this,document,jQuery),function(e,t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):"object"==typeof exports?module.exports=t(require("jquery")):e.jcf=t(jQuery)}(this,function(e){"use strict";var t="1.1.3",s=[],i={optionsKey:"jcf",dataKey:"jcf-instance",rtlClass:"jcf-rtl",focusClass:"jcf-focus",pressedClass:"jcf-pressed",disabledClass:"jcf-disabled",hiddenClass:"jcf-hidden",resetAppearanceClass:"jcf-reset-appearance",unselectableClass:"jcf-unselectable"},n="ontouchstart"in window||window.DocumentTouch&&document instanceof window.DocumentTouch,o=/Windows Phone/.test(navigator.userAgent);i.isMobileDevice=!(!n&&!o);var l=function(){var t=e("<style>").appendTo("head"),s=t.prop("sheet")||t.prop("styleSheet"),n=function(e,t,i){s.insertRule?s.insertRule(e+"{"+t+"}",i):s.addRule(e,t,i)};n("."+i.hiddenClass,"position:absolute !important;left:-9999px !important;height:1px !important;width:1px !important;margin:0 !important;border-width:0 !important;-webkit-appearance:none;-moz-appearance:none;appearance:none"),n("."+i.rtlClass+" ."+i.hiddenClass,"right:-9999px !important; left: auto !important"),n("."+i.unselectableClass,"-webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-tap-highlight-color: rgba(0,0,0,0);"),n("."+i.resetAppearanceClass,"background: none; border: none; -webkit-appearance: none; appearance: none; opacity: 0; filter: alpha(opacity=0);");var o=e("html"),l=e("body");("rtl"===o.css("direction")||"rtl"===l.css("direction"))&&o.addClass(i.rtlClass),o.on("reset",function(){setTimeout(function(){r.refreshAll()},0)}),i.styleSheetCreated=!0};!function(){var t,s=navigator.pointerEnabled||navigator.msPointerEnabled,i="ontouchstart"in window||window.DocumentTouch&&document instanceof window.DocumentTouch,n={},o="jcf-";t=s?{pointerover:navigator.pointerEnabled?"pointerover":"MSPointerOver",pointerdown:navigator.pointerEnabled?"pointerdown":"MSPointerDown",pointermove:navigator.pointerEnabled?"pointermove":"MSPointerMove",pointerup:navigator.pointerEnabled?"pointerup":"MSPointerUp"}:{pointerover:"mouseover",pointerdown:"mousedown"+(i?" touchstart":""),pointermove:"mousemove"+(i?" touchmove":""),pointerup:"mouseup"+(i?" touchend":"")},e.each(t,function(t,s){e.each(s.split(" "),function(e,s){n[s]=t})}),e.each(t,function(t,s){s=s.split(" "),e.event.special[o+t]={setup:function(){var t=this;e.each(s,function(e,s){t.addEventListener?t.addEventListener(s,r,!1):t["on"+s]=r})},teardown:function(){var t=this;e.each(s,function(e,s){t.addEventListener?t.removeEventListener(s,r,!1):t["on"+s]=null})}}});var l=null,a=function(e){var t=Math.abs(e.pageX-l.x),s=Math.abs(e.pageY-l.y),i=25;return i>=t&&i>=s?!0:void 0},r=function(t){var s=t||window.event,i=null,r=n[s.type];if(t=e.event.fix(s),t.type=o+r,s.pointerType)switch(s.pointerType){case 2:t.pointerType="touch";break;case 3:t.pointerType="pen";break;case 4:t.pointerType="mouse";break;default:t.pointerType=s.pointerType}else t.pointerType=s.type.substr(0,5);return t.pageX||t.pageY||(i=s.changedTouches?s.changedTouches[0]:s,t.pageX=i.pageX,t.pageY=i.pageY),"touchend"===s.type&&(l={x:t.pageX,y:t.pageY}),"mouse"===t.pointerType&&l&&a(t)?void 0:(e.event.dispatch||e.event.handle).call(this,t)}}(),function(){var t=("onwheel"in document||document.documentMode>=9?"wheel":"mousewheel DOMMouseScroll").split(" "),s="jcf-mousewheel";e.event.special[s]={setup:function(){var s=this;e.each(t,function(e,t){s.addEventListener?s.addEventListener(t,i,!1):s["on"+t]=i})},teardown:function(){var s=this;e.each(t,function(e,t){s.addEventListener?s.removeEventListener(t,i,!1):s["on"+t]=null})}};var i=function(t){var i=t||window.event;if(t=e.event.fix(i),t.type=s,"detail"in i&&(t.deltaY=-i.detail),"wheelDelta"in i&&(t.deltaY=-i.wheelDelta),"wheelDeltaY"in i&&(t.deltaY=-i.wheelDeltaY),"wheelDeltaX"in i&&(t.deltaX=-i.wheelDeltaX),"deltaY"in i&&(t.deltaY=i.deltaY),"deltaX"in i&&(t.deltaX=i.deltaX),t.delta=t.deltaY||t.deltaX,1===i.deltaMode){var n=16;t.delta*=n,t.deltaY*=n,t.deltaX*=n}return(e.event.dispatch||e.event.handle).call(this,t)}}();var a={fireNativeEvent:function(t,s){e(t).each(function(){var e,t=this;t.dispatchEvent?(e=document.createEvent("HTMLEvents"),e.initEvent(s,!0,!0),t.dispatchEvent(e)):document.createEventObject&&(e=document.createEventObject(),e.target=t,t.fireEvent("on"+s,e))})},bindHandlers:function(){var t=this;e.each(t,function(s,i){0===s.indexOf("on")&&e.isFunction(i)&&(t[s]=function(){return i.apply(t,arguments)})})}},r={version:t,modules:{},getOptions:function(){return e.extend({},i)},setOptions:function(t,s){arguments.length>1?this.modules[t]&&e.extend(this.modules[t].prototype.options,s):e.extend(i,t)},addModule:function(t){var n=function(t){t.element.data(i.dataKey)||t.element.data(i.dataKey,this),s.push(this),this.options=e.extend({},i,this.options,o(t.element),t),this.bindHandlers(),this.init.apply(this,arguments)},o=function(t){var s=t.data(i.optionsKey),n=t.attr(i.optionsKey);if(s)return s;if(n)try{return e.parseJSON(n)}catch(o){}};n.prototype=t,e.extend(t,a),t.plugins&&e.each(t.plugins,function(t,s){e.extend(s.prototype,a)});var l=n.prototype.destroy;n.prototype.destroy=function(){this.options.element.removeData(this.options.dataKey);for(var e=s.length-1;e>=0;e--)if(s[e]===this){s.splice(e,1);break}l&&l.apply(this,arguments)},this.modules[t.name]=n},getInstance:function(t){return e(t).data(i.dataKey)},replace:function(t,s,n){var o,a=this;return i.styleSheetCreated||l(),e(t).each(function(){var t,l=e(this);o=l.data(i.dataKey),o?o.refresh():(s||e.each(a.modules,function(e,t){return t.prototype.matchElement.call(t.prototype,l)?(s=e,!1):void 0}),s&&(t=e.extend({element:l},n),o=new a.modules[s](t)))}),o},refresh:function(t){e(t).each(function(){var t=e(this).data(i.dataKey);t&&t.refresh()})},destroy:function(t){e(t).each(function(){var t=e(this).data(i.dataKey);t&&t.destroy()})},replaceAll:function(t){var s=this;e.each(this.modules,function(i,n){e(n.prototype.selector,t).each(function(){this.className.indexOf("jcf-ignore")<0&&s.replace(this,i)})})},refreshAll:function(t){if(t)e.each(this.modules,function(s,n){e(n.prototype.selector,t).each(function(){var t=e(this).data(i.dataKey);t&&t.refresh()})});else for(var n=s.length-1;n>=0;n--)s[n].refresh()},destroyAll:function(t){if(t)e.each(this.modules,function(s,n){e(n.prototype.selector,t).each(function(t,s){var n=e(s).data(i.dataKey);n&&n.destroy()})});else for(;s.length;)s[0].destroy()}};return window.jcf=r,r}),function(e,t){"use strict";function s(t){this.options=e.extend({wrapNative:!0,wrapNativeOnMobile:!0,fakeDropInBody:!0,useCustomScroll:!0,flipDropToFit:!0,maxVisibleItems:10,fakeAreaStructure:'<span class="jcf-select"><span class="jcf-select-text"></span><span class="jcf-select-opener"></span></span>',fakeDropStructure:'<div class="jcf-select-drop"><div class="jcf-select-drop-content"></div></div>',optionClassPrefix:"jcf-option-",selectClassPrefix:"jcf-select-",dropContentSelector:".jcf-select-drop-content",selectTextSelector:".jcf-select-text",dropActiveClass:"jcf-drop-active",flipDropClass:"jcf-drop-flipped"},t),this.init()}function i(t){this.options=e.extend({wrapNative:!0,useCustomScroll:!0,fakeStructure:'<span class="jcf-list-box"><span class="jcf-list-wrapper"></span></span>',selectClassPrefix:"jcf-select-",listHolder:".jcf-list-wrapper"},t),this.init()}function n(t){this.options=e.extend({holder:null,maxVisibleItems:10,selectOnClick:!0,useHoverClass:!1,useCustomScroll:!1,handleResize:!0,multipleSelectWithoutKey:!1,alwaysPreventMouseWheel:!1,indexAttribute:"data-index",cloneClassPrefix:"jcf-option-",containerStructure:'<span class="jcf-list"><span class="jcf-list-content"></span></span>',containerSelector:".jcf-list-content",captionClass:"jcf-optgroup-caption",disabledClass:"jcf-disabled",optionClass:"jcf-option",groupClass:"jcf-optgroup",hoverClass:"jcf-hover",selectedClass:"jcf-selected",scrollClass:"jcf-scroll-active"},t),this.init()}jcf.addModule({name:"Select",selector:"select",options:{element:null,multipleCompactStyle:!1},plugins:{ListBox:i,ComboBox:s,SelectList:n},matchElement:function(e){return e.is("select")},init:function(){this.element=e(this.options.element),this.createInstance()},isListBox:function(){return this.element.is("[size]:not([jcf-size]), [multiple]")},createInstance:function(){this.instance&&this.instance.destroy(),this.isListBox()&&!this.options.multipleCompactStyle?this.instance=new i(this.options):this.instance=new s(this.options)},refresh:function(){var e=this.isListBox()&&this.instance instanceof s||!this.isListBox()&&this.instance instanceof i;e?this.createInstance():this.instance.refresh()},destroy:function(){this.instance.destroy()}}),e.extend(s.prototype,{init:function(){this.initStructure(),this.bindHandlers(),this.attachEvents(),this.refresh()},initStructure:function(){this.win=e(t),this.doc=e(document),this.realElement=e(this.options.element),this.fakeElement=e(this.options.fakeAreaStructure).insertAfter(this.realElement),this.selectTextContainer=this.fakeElement.find(this.options.selectTextSelector),this.selectText=e("<span></span>").appendTo(this.selectTextContainer),l(this.fakeElement),this.fakeElement.addClass(o(this.realElement.prop("className"),this.options.selectClassPrefix)),this.realElement.prop("multiple")&&this.fakeElement.addClass("jcf-compact-multiple"),this.options.isMobileDevice&&this.options.wrapNativeOnMobile&&!this.options.wrapNative&&(this.options.wrapNative=!0),this.options.wrapNative?this.realElement.prependTo(this.fakeElement).css({position:"absolute",height:"100%",width:"100%"}).addClass(this.options.resetAppearanceClass):(this.realElement.addClass(this.options.hiddenClass),this.fakeElement.attr("title",this.realElement.attr("title")),this.fakeDropTarget=this.options.fakeDropInBody?e("body"):this.fakeElement)},attachEvents:function(){var e=this;this.delayedRefresh=function(){setTimeout(function(){e.refresh(),e.list&&(e.list.refresh(),e.list.scrollToActiveOption())},1)},this.options.wrapNative?this.realElement.on({focus:this.onFocus,change:this.onChange,click:this.onChange,keydown:this.onChange}):(this.realElement.on({focus:this.onFocus,change:this.onChange,keydown:this.onKeyDown}),this.fakeElement.on({"jcf-pointerdown":this.onSelectAreaPress}))},onKeyDown:function(e){13===e.which?this.toggleDropdown():this.dropActive&&this.delayedRefresh()},onChange:function(){this.refresh()},onFocus:function(){this.pressedFlag&&this.focusedFlag||(this.fakeElement.addClass(this.options.focusClass),this.realElement.on("blur",this.onBlur),this.toggleListMode(!0),this.focusedFlag=!0)},onBlur:function(){this.pressedFlag||(this.fakeElement.removeClass(this.options.focusClass),this.realElement.off("blur",this.onBlur),this.toggleListMode(!1),this.focusedFlag=!1)},onResize:function(){this.dropActive&&this.hideDropdown()},onSelectDropPress:function(){this.pressedFlag=!0},onSelectDropRelease:function(e,t){this.pressedFlag=!1,"mouse"===t.pointerType&&this.realElement.focus()},onSelectAreaPress:function(t){var s=!this.options.fakeDropInBody&&e(t.target).closest(this.dropdown).length;s||t.button>1||this.realElement.is(":disabled")||(this.selectOpenedByEvent=t.pointerType,this.toggleDropdown(),this.focusedFlag||("mouse"===t.pointerType?this.realElement.focus():this.onFocus(t)),this.pressedFlag=!0,this.fakeElement.addClass(this.options.pressedClass),this.doc.on("jcf-pointerup",this.onSelectAreaRelease))},onSelectAreaRelease:function(e){this.focusedFlag&&"mouse"===e.pointerType&&this.realElement.focus(),this.pressedFlag=!1,this.fakeElement.removeClass(this.options.pressedClass),this.doc.off("jcf-pointerup",this.onSelectAreaRelease)},onOutsideClick:function(t){var s=e(t.target),i=s.closest(this.fakeElement).length||s.closest(this.dropdown).length;i||this.hideDropdown()},onSelect:function(){this.refresh(),this.realElement.prop("multiple")?this.repositionDropdown():this.hideDropdown(),this.fireNativeEvent(this.realElement,"change")},toggleListMode:function(e){this.options.wrapNative||(e?this.realElement.attr({size:4,"jcf-size":""}):this.options.wrapNative||this.realElement.removeAttr("size jcf-size"))},createDropdown:function(){this.dropdown&&(this.list.destroy(),this.dropdown.remove()),this.dropdown=e(this.options.fakeDropStructure).appendTo(this.fakeDropTarget),this.dropdown.addClass(o(this.realElement.prop("className"),this.options.selectClassPrefix)),l(this.dropdown),this.realElement.prop("multiple")&&this.dropdown.addClass("jcf-compact-multiple"),this.options.fakeDropInBody&&this.dropdown.css({position:"absolute",top:-9999}),this.list=new n({useHoverClass:!0,handleResize:!1,alwaysPreventMouseWheel:!0,maxVisibleItems:this.options.maxVisibleItems,useCustomScroll:this.options.useCustomScroll,holder:this.dropdown.find(this.options.dropContentSelector),multipleSelectWithoutKey:this.realElement.prop("multiple"),element:this.realElement}),e(this.list).on({select:this.onSelect,press:this.onSelectDropPress,release:this.onSelectDropRelease})},repositionDropdown:function(){var e,t,s,i=this.fakeElement.offset(),n=this.fakeElement.outerWidth(),o=this.fakeElement.outerHeight(),l=this.dropdown.css("width",n).outerHeight(),a=this.win.scrollTop(),r=this.win.height(),h=!1;i.top+o+l>a+r&&i.top-l>a&&(h=!0),this.options.fakeDropInBody&&(s="static"!==this.fakeDropTarget.css("position")?this.fakeDropTarget.offset().top:0,this.options.flipDropToFit&&h?(t=i.left,e=i.top-l-s):(t=i.left,e=i.top+o-s),this.dropdown.css({width:n,left:t,top:e})),this.dropdown.add(this.fakeElement).toggleClass(this.options.flipDropClass,this.options.flipDropToFit&&h)},showDropdown:function(){this.realElement.prop("options").length&&(this.dropdown||this.createDropdown(),this.dropActive=!0,this.dropdown.appendTo(this.fakeDropTarget),this.fakeElement.addClass(this.options.dropActiveClass),this.refreshSelectedText(),this.repositionDropdown(),this.list.setScrollTop(this.savedScrollTop),this.list.refresh(),this.win.on("resize",this.onResize),this.doc.on("jcf-pointerdown",this.onOutsideClick))},hideDropdown:function(){this.dropdown&&(this.savedScrollTop=this.list.getScrollTop(),this.fakeElement.removeClass(this.options.dropActiveClass+" "+this.options.flipDropClass),this.dropdown.removeClass(this.options.flipDropClass).detach(),this.doc.off("jcf-pointerdown",this.onOutsideClick),this.win.off("resize",this.onResize),this.dropActive=!1,"touch"===this.selectOpenedByEvent&&this.onBlur())},toggleDropdown:function(){this.dropActive?this.hideDropdown():this.showDropdown()},refreshSelectedText:function(){var t,s=this.realElement.prop("selectedIndex"),i=this.realElement.prop("options")[s],n=i?i.getAttribute("data-image"):null,l="",a=this;this.realElement.prop("multiple")?(e.each(this.realElement.prop("options"),function(e,t){t.selected&&(l+=(l?", ":"")+t.innerHTML)}),l||(l=a.realElement.attr("placeholder")||""),this.selectText.removeAttr("class").html(l)):i?(this.currentSelectedText!==i.innerHTML||this.currentSelectedImage!==n)&&(t=o(i.className,this.options.optionClassPrefix),this.selectText.attr("class",t).html(i.innerHTML),n?(this.selectImage||(this.selectImage=e("<img>").prependTo(this.selectTextContainer).hide()),this.selectImage.attr("src",n).show()):this.selectImage&&this.selectImage.hide(),this.currentSelectedText=i.innerHTML,this.currentSelectedImage=n):(this.selectImage&&this.selectImage.hide(),this.selectText.removeAttr("class").empty())},refresh:function(){"none"===this.realElement.prop("style").display?this.fakeElement.hide():this.fakeElement.show(),this.refreshSelectedText(),this.fakeElement.toggleClass(this.options.disabledClass,this.realElement.is(":disabled"))},destroy:function(){this.options.wrapNative?this.realElement.insertBefore(this.fakeElement).css({position:"",height:"",width:""}).removeClass(this.options.resetAppearanceClass):(this.realElement.removeClass(this.options.hiddenClass),this.realElement.is("[jcf-size]")&&this.realElement.removeAttr("size jcf-size")),this.fakeElement.remove(),this.doc.off("jcf-pointerup",this.onSelectAreaRelease),this.realElement.off({focus:this.onFocus})}}),e.extend(i.prototype,{init:function(){this.bindHandlers(),this.initStructure(),this.attachEvents()},initStructure:function(){this.realElement=e(this.options.element),this.fakeElement=e(this.options.fakeStructure).insertAfter(this.realElement),this.listHolder=this.fakeElement.find(this.options.listHolder),l(this.fakeElement),this.fakeElement.addClass(o(this.realElement.prop("className"),this.options.selectClassPrefix)),this.realElement.addClass(this.options.hiddenClass),this.list=new n({useCustomScroll:this.options.useCustomScroll,holder:this.listHolder,selectOnClick:!1,element:this.realElement})},attachEvents:function(){var t=this;this.delayedRefresh=function(e){e&&16===e.which||(clearTimeout(t.refreshTimer),t.refreshTimer=setTimeout(function(){t.refresh(),t.list.scrollToActiveOption()},1))},this.realElement.on({focus:this.onFocus,click:this.delayedRefresh,keydown:this.delayedRefresh}),e(this.list).on({select:this.onSelect,press:this.onFakeOptionsPress,release:this.onFakeOptionsRelease})},onFakeOptionsPress:function(e,t){this.pressedFlag=!0,"mouse"===t.pointerType&&this.realElement.focus()},onFakeOptionsRelease:function(e,t){this.pressedFlag=!1,"mouse"===t.pointerType&&this.realElement.focus()},onSelect:function(){this.fireNativeEvent(this.realElement,"change"),this.fireNativeEvent(this.realElement,"click")},onFocus:function(){this.pressedFlag&&this.focusedFlag||(this.fakeElement.addClass(this.options.focusClass),this.realElement.on("blur",this.onBlur),this.focusedFlag=!0)},onBlur:function(){this.pressedFlag||(this.fakeElement.removeClass(this.options.focusClass),this.realElement.off("blur",this.onBlur),this.focusedFlag=!1)},refresh:function(){this.fakeElement.toggleClass(this.options.disabledClass,this.realElement.is(":disabled")),this.list.refresh()},destroy:function(){this.list.destroy(),this.realElement.insertBefore(this.fakeElement).removeClass(this.options.hiddenClass),this.fakeElement.remove()}}),e.extend(n.prototype,{init:function(){this.initStructure(),this.refreshSelectedClass(),this.attachEvents()},initStructure:function(){this.element=e(this.options.element),this.indexSelector="["+this.options.indexAttribute+"]",this.container=e(this.options.containerStructure).appendTo(this.options.holder),this.listHolder=this.container.find(this.options.containerSelector),this.lastClickedIndex=this.element.prop("selectedIndex"),this.rebuildList()},attachEvents:function(){this.bindHandlers(),this.listHolder.on("jcf-pointerdown",this.indexSelector,this.onItemPress),this.listHolder.on("jcf-pointerdown",this.onPress),this.options.useHoverClass&&this.listHolder.on("jcf-pointerover",this.indexSelector,this.onHoverItem)},onPress:function(t){e(this).trigger("press",t),this.listHolder.on("jcf-pointerup",this.onRelease)},onRelease:function(t){e(this).trigger("release",t),this.listHolder.off("jcf-pointerup",this.onRelease)},onHoverItem:function(e){var t=parseFloat(e.currentTarget.getAttribute(this.options.indexAttribute));this.fakeOptions.removeClass(this.options.hoverClass).eq(t).addClass(this.options.hoverClass)},onItemPress:function(e){"touch"===e.pointerType||this.options.selectOnClick?(this.tmpListOffsetTop=this.list.offset().top,this.listHolder.on("jcf-pointerup",this.indexSelector,this.onItemRelease)):this.onSelectItem(e)},onItemRelease:function(e){this.listHolder.off("jcf-pointerup",this.indexSelector,this.onItemRelease),this.tmpListOffsetTop===this.list.offset().top&&this.listHolder.on("click",this.indexSelector,{savedPointerType:e.pointerType},this.onSelectItem),delete this.tmpListOffsetTop},onSelectItem:function(t){var s,i=parseFloat(t.currentTarget.getAttribute(this.options.indexAttribute)),n=t.data&&t.data.savedPointerType||t.pointerType||"mouse";this.listHolder.off("click",this.indexSelector,this.onSelectItem),t.button>1||this.realOptions[i].disabled||(this.element.prop("multiple")?t.metaKey||t.ctrlKey||"touch"===n||this.options.multipleSelectWithoutKey?this.realOptions[i].selected=!this.realOptions[i].selected:t.shiftKey?(s=[this.lastClickedIndex,i].sort(function(e,t){return e-t}),this.realOptions.each(function(e,t){t.selected=e>=s[0]&&e<=s[1]})):this.element.prop("selectedIndex",i):this.element.prop("selectedIndex",i),t.shiftKey||(this.lastClickedIndex=i),this.refreshSelectedClass(),"mouse"===n&&this.scrollToActiveOption(),e(this).trigger("select"))},rebuildList:function(){var t=this,s=this.element[0];this.storedSelectHTML=s.innerHTML,this.optionIndex=0,this.list=e(this.createOptionsList(s)),this.listHolder.empty().append(this.list),this.realOptions=this.element.find("option"),this.fakeOptions=this.list.find(this.indexSelector),this.fakeListItems=this.list.find("."+this.options.captionClass+","+this.indexSelector),delete this.optionIndex;var i=this.options.maxVisibleItems,n=this.element.prop("size");n>1&&!this.element.is("[jcf-size]")&&(i=n);var o=this.fakeOptions.length>i;return this.container.toggleClass(this.options.scrollClass,o),o&&(this.listHolder.css({maxHeight:this.getOverflowHeight(i),overflow:"auto"}),this.options.useCustomScroll&&jcf.modules.Scrollable)?void jcf.replace(this.listHolder,"Scrollable",{handleResize:this.options.handleResize,alwaysPreventMouseWheel:this.options.alwaysPreventMouseWheel}):void(this.options.alwaysPreventMouseWheel&&(this.preventWheelHandler=function(e){var s=t.listHolder.scrollTop(),i=t.listHolder.prop("scrollHeight")-t.listHolder.innerHeight();(0>=s&&e.deltaY<0||s>=i&&e.deltaY>0)&&e.preventDefault()},this.listHolder.on("jcf-mousewheel",this.preventWheelHandler)))},refreshSelectedClass:function(){var e,t=this,s=this.element.prop("multiple"),i=this.element.prop("selectedIndex");s?this.realOptions.each(function(e,s){t.fakeOptions.eq(e).toggleClass(t.options.selectedClass,!!s.selected)}):(this.fakeOptions.removeClass(this.options.selectedClass+" "+this.options.hoverClass),e=this.fakeOptions.eq(i).addClass(this.options.selectedClass),this.options.useHoverClass&&e.addClass(this.options.hoverClass))},scrollToActiveOption:function(){var e=this.getActiveOptionOffset();"number"==typeof e&&this.listHolder.prop("scrollTop",e)},getSelectedIndexRange:function(){var e=-1,t=-1;return this.realOptions.each(function(s,i){i.selected&&(0>e&&(e=s),t=s)}),[e,t]},getChangedSelectedIndex:function(){var e,t=this.element.prop("selectedIndex");return this.element.prop("multiple")?(this.previousRange||(this.previousRange=[t,t]),this.currentRange=this.getSelectedIndexRange(),e=this.currentRange[this.currentRange[0]!==this.previousRange[0]?0:1],this.previousRange=this.currentRange,e):t},getActiveOptionOffset:function(){var e=this.listHolder.height(),t=this.listHolder.prop("scrollTop"),s=this.getChangedSelectedIndex(),i=this.fakeOptions.eq(s),n=i.offset().top-this.list.offset().top,o=i.innerHeight();return n+o>=t+e?n-e+o:t>n?n:void 0},getOverflowHeight:function(e){var t=this.fakeListItems.eq(e-1),s=this.list.offset().top,i=t.offset().top,n=t.innerHeight();return i+n-s},getScrollTop:function(){return this.listHolder.scrollTop()},setScrollTop:function(e){this.listHolder.scrollTop(e)},createOption:function(e){var t=document.createElement("span");t.className=this.options.optionClass,t.innerHTML=e.innerHTML,t.setAttribute(this.options.indexAttribute,this.optionIndex++);var s,i=e.getAttribute("data-image");return i&&(s=document.createElement("img"),s.src=i,t.insertBefore(s,t.childNodes[0])),e.disabled&&(t.className+=" "+this.options.disabledClass),e.className&&(t.className+=" "+o(e.className,this.options.cloneClassPrefix)),t},createOptGroup:function(e){var t,s,i=document.createElement("span"),n=e.getAttribute("label");return t=document.createElement("span"),t.className=this.options.captionClass,t.innerHTML=n,i.appendChild(t),e.children.length&&(s=this.createOptionsList(e),i.appendChild(s)),i.className=this.options.groupClass,
i},createOptionContainer:function(){var e=document.createElement("li");return e},createOptionsList:function(t){var s=this,i=document.createElement("ul");return e.each(t.children,function(e,t){var n,o=s.createOptionContainer(t);switch(t.tagName.toLowerCase()){case"option":n=s.createOption(t);break;case"optgroup":n=s.createOptGroup(t)}i.appendChild(o).appendChild(n)}),i},refresh:function(){this.storedSelectHTML!==this.element.prop("innerHTML")&&this.rebuildList();var e=jcf.getInstance(this.listHolder);e&&e.refresh(),this.refreshSelectedClass()},destroy:function(){this.listHolder.off("jcf-mousewheel",this.preventWheelHandler),this.listHolder.off("jcf-pointerdown",this.indexSelector,this.onSelectItem),this.listHolder.off("jcf-pointerover",this.indexSelector,this.onHoverItem),this.listHolder.off("jcf-pointerdown",this.onPress)}});var o=function(e,t){return e?e.replace(/[\s]*([\S]+)+[\s]*/gi,t+"$1 "):""},l=function(){function e(e){e.preventDefault()}var t=jcf.getOptions().unselectableClass;return function(s){s.addClass(t).on("selectstart",e)}}()}(jQuery,this),function(e){"use strict";jcf.addModule({name:"Checkbox",selector:'input[type="checkbox"]',options:{wrapNative:!0,checkedClass:"jcf-checked",uncheckedClass:"jcf-unchecked",labelActiveClass:"jcf-label-active",fakeStructure:'<span class="jcf-checkbox"><span></span></span>'},matchElement:function(e){return e.is(":checkbox")},init:function(){this.initStructure(),this.attachEvents(),this.refresh()},initStructure:function(){this.doc=e(document),this.realElement=e(this.options.element),this.fakeElement=e(this.options.fakeStructure).insertAfter(this.realElement),this.labelElement=this.getLabelFor(),this.options.wrapNative?this.realElement.appendTo(this.fakeElement).css({position:"absolute",height:"100%",width:"100%",opacity:0,margin:0}):this.realElement.addClass(this.options.hiddenClass)},attachEvents:function(){this.realElement.on({focus:this.onFocus,click:this.onRealClick}),this.fakeElement.on("click",this.onFakeClick),this.fakeElement.on("jcf-pointerdown",this.onPress)},onRealClick:function(e){var t=this;this.savedEventObject=e,setTimeout(function(){t.refresh()},0)},onFakeClick:function(e){this.options.wrapNative&&this.realElement.is(e.target)||this.realElement.is(":disabled")||(delete this.savedEventObject,this.stateChecked=this.realElement.prop("checked"),this.realElement.prop("checked",!this.stateChecked),this.fireNativeEvent(this.realElement,"click"),this.savedEventObject&&this.savedEventObject.isDefaultPrevented()?this.realElement.prop("checked",this.stateChecked):this.fireNativeEvent(this.realElement,"change"),delete this.savedEventObject)},onFocus:function(){this.pressedFlag&&this.focusedFlag||(this.focusedFlag=!0,this.fakeElement.addClass(this.options.focusClass),this.realElement.on("blur",this.onBlur))},onBlur:function(){this.pressedFlag||(this.focusedFlag=!1,this.fakeElement.removeClass(this.options.focusClass),this.realElement.off("blur",this.onBlur))},onPress:function(e){this.focusedFlag||"mouse"!==e.pointerType||this.realElement.focus(),this.pressedFlag=!0,this.fakeElement.addClass(this.options.pressedClass),this.doc.on("jcf-pointerup",this.onRelease)},onRelease:function(e){this.focusedFlag&&"mouse"===e.pointerType&&this.realElement.focus(),this.pressedFlag=!1,this.fakeElement.removeClass(this.options.pressedClass),this.doc.off("jcf-pointerup",this.onRelease)},getLabelFor:function(){var t=this.realElement.closest("label"),s=this.realElement.prop("id");return!t.length&&s&&(t=e('label[for="'+s+'"]')),t.length?t:null},refresh:function(){var e=this.realElement.is(":checked"),t=this.realElement.is(":disabled");this.fakeElement.toggleClass(this.options.checkedClass,e).toggleClass(this.options.uncheckedClass,!e).toggleClass(this.options.disabledClass,t),this.labelElement&&this.labelElement.toggleClass(this.options.labelActiveClass,e)},destroy:function(){this.options.wrapNative?this.realElement.insertBefore(this.fakeElement).css({position:"",width:"",height:"",opacity:"",margin:""}):this.realElement.removeClass(this.options.hiddenClass),this.fakeElement.off("jcf-pointerdown",this.onPress),this.fakeElement.remove(),this.doc.off("jcf-pointerup",this.onRelease),this.realElement.off({focus:this.onFocus,click:this.onRealClick})}})}(jQuery);
