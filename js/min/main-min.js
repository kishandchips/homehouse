!function($){window.main={vars:{},w:$(window),init:function(){main.vars.header=$("#header"),main.vars.body=$("body"),main.vars.wrapper=$("#kanye-west"),main.vars.page=$("#page"),main.vars.sidebar=$(".sidebar"),main.vars.footer=$("#footer"),main.vars.contact=$("#contact"),this.header.init(),this.sidebar.init(),this.cedric.init(),this.contact.init(),this.footer.init(),main.w.on("load",function(){$(".flexslider").flexslider({animation:"slide",controlNav:!1})}),$(".equal-height").matchHeight()},header:{element:$("#header"),init:function(){var e=main.header.element;e.length&&(this.megatron.init(),$(".js-login").on("click",function(){$(".login").toggleClass("visible")}))},megatron:{init:function(){this.resize(),$("#nav .mob-button").on("click",function(){$("#nav > ul.menu").toggleClass("open")}),main.w.resize(function(){main.header.megatron.resize()})},resize:function(){var e=main.vars.header;main.w.width()<800?(e.removeClass("mega"),e.addClass("mobile")):(e.removeClass("mobile"),e.addClass("mega")),$("html").hasClass("no-touch")&&e.hasClass("mega")&&$("nav .equal-height").matchHeight()}}},sidebar:{element:$(".sidebar"),init:function(){var e=main.sidebar.element;e.length&&(main.sidebar.content=$("#content-wrapper"),main.sidebar.container=e.parent(".container"),this.triggers(),this.resize())},triggers:function(){$(".inner-content .mob-button").on("click",function(){$("body").toggleClass("sidebar-visible")})},resize:function(){var e=main.vars.sidebar;if(e.length){var t=main.vars.sidebar.outerHeight(),i=$(".inner-content").outerHeight();t>i?main.sidebar.container.css("height",t):main.sidebar.container.css("height",i)}}},contact:{element:$("#contact"),init:function(){var e=main.contact.element;e.length&&(this.triggers(),this.map.init())},triggers:function(){$(".feedback-toggle").on("click",function(){main.vars.contact.toggleClass("feedback-visible")}),$(".feedback-overlay").on("click",function(){main.vars.contact.toggleClass("feedback-visible")})},map:{element:$("#map"),init:function(){var e=main.contact.map.element;e.length&&main.w.on("load",function(){main.contact.map.loaded()})},loaded:function(){function e(){t=o.getCenter()}var t=new google.maps.LatLng(51.516098,-.156354),i={zoom:15,disableDefaultUI:!0,scrollwheel:!1,center:t,styles:[{featureType:"water",elementType:"geometry",stylers:[{color:"#000000"},{lightness:17}]},{featureType:"landscape",elementType:"geometry",stylers:[{color:"#000000"},{lightness:20}]},{featureType:"road.highway",elementType:"geometry.fill",stylers:[{color:"#000000"},{lightness:17}]},{featureType:"road.highway",elementType:"geometry.stroke",stylers:[{color:"#000000"},{lightness:29},{weight:.2}]},{featureType:"road.arterial",elementType:"geometry",stylers:[{color:"#000000"},{lightness:18}]},{featureType:"road.local",elementType:"geometry",stylers:[{color:"#000000"},{lightness:16}]},{featureType:"poi",elementType:"geometry",stylers:[{color:"#000000"},{lightness:21}]},{elementType:"labels.text.stroke",stylers:[{visibility:"on"},{color:"#000000"},{lightness:16}]},{elementType:"labels.text.fill",stylers:[{saturation:36},{color:"#000000"},{lightness:40}]},{elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"transit",elementType:"geometry",stylers:[{color:"#000000"},{lightness:19}]},{featureType:"administrative",elementType:"geometry.fill",stylers:[{color:"#000000"},{lightness:20}]},{featureType:"administrative",elementType:"geometry.stroke",stylers:[{color:"#000000"},{lightness:17},{weight:1.2}]}]},n=$("#map"),o=new google.maps.Map(n[0],i),a=new google.maps.Marker({position:t,map:o,icon:url.template+"/img/pin.png"});google.maps.event.addDomListener(o,"idle",function(){e()}),google.maps.event.addDomListener(window,"resize",function(){o.setCenter(t)})}}},cedric:{element:$("#isotope"),init:function(){var e=main.cedric.element;e.length&&(main.w.on("load",function(){main.cedric.isotope.init()}),main.cedric.filters.init())},filters:{element:$("#filters"),init:function(){var e=main.cedric.filters.element;if(e.length){var t=$(".filter-button",e),i=$(".js-toggle",e),n=$(".filters-menu"),o=e.offset().top;t.on("click",function(){$("html,body").animate({scrollTop:o});var e=$(this).attr("data-filter");main.cedric.isotope.element.isotope({filter:e})}),i.on("click",function(){e.toggleClass("filters-visible")}),n.on("click","button.filter",function(){var e=$(this).attr("data-filter");main.cedric.isotope.element.isotope({filter:e})}),n.on("click","button.sort",function(){var e=$(this).attr("data-sort-by");main.cedric.isotope.element.isotope({sortBy:e}),main.cedric.isotope.element.isotope({sortBy:e,sortAscending:{name:!0}})}),n.on("click","button.sort-desc",function(){var e=$(this).attr("data-sort-by");main.cedric.isotope.element.isotope({sortBy:e,sortAscending:{name:!1}})})}}},isotope:{element:$("#isotope"),init:function(){var e=main.cedric.isotope.element;e.length&&e.imagesLoaded(function(){e.isotope({itemSelector:".item",masonry:{columnWidth:".grid-sizer"},getSortData:{date:"[data-date]",name:".title"}})})}}},footer:{element:$("#footer"),init:function(){var e=main.footer.element;e.length&&this.sticky()},sticky:function(){var e=main.footer.element.outerHeight();main.vars.wrapper.css("margin-bottom",-e),$(".push").css("height",e)},resize:function(){var e=main.footer.element.outerHeight();main.vars.wrapper.css("margin-bottom",-e),$(".push").css("height",e)}}},main.init()}(jQuery);