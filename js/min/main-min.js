!function($){var e={vars:{},w:$(window),init:function(){if(e.vars.header=$("#header"),e.vars.body=$("body"),e.vars.wrapper=$("#kanye-west"),e.vars.page=$("#page"),e.vars.sidebar=$(".sidebar"),e.vars.contact=$("#contact"),this.header.init(),this.slider.init(),this.sidebar.init(),this.cedric.init(),this.contact.init(),this.video.init(),this.infiniteScroll(),e.w.on("load",function(){$(".flexslider").flexslider({animation:"fade",controlNav:!0,slideshowSpeed:4e3,pauseOnHover:!0}),e.sidebar.resize()}),$("ul.stream").length)var t=0,i=setInterval(function(){$(".stream .dcsns-twitter:eq(0), .stream .dcsns-twitter:eq(1) ").addClass("show"),$(".stream .dcsns-instagram:eq(0), .stream .dcsns-instagram:eq(1) ").addClass("show"),$(".stream .dcsns-facebook:eq(0), .stream .dcsns-facebook:eq(1) ").addClass("show"),t++,10===t&&clearInterval(i)},1e3);$("#single .share-bar").length&&e.w.width()>899&&($("#single .share-bar, #single .follow-bar").height($("#single .article-meta").height()),$("#single .share-bar .share").hcSticky({top:10}),$("#single .follow-bar .follow").hcSticky({top:10})),$(".equal-height").matchHeight(),$("#ee-Sage_Pay-billing-form-zip-input-dv").length&&$("#ee-Sage_Pay-billing-form-zip-lbl").html('Postcode <span class="ee-asterisk">*</span>')},header:{element:$("#header"),init:function(){var t=e.header.element;t.length&&(this.megatron.init(),$("form").find('input[name="log"]').each(function(e){$(this).val()||$(this).attr("placeholder","Membership Name")}),$("form").find('input[name="pwd"]').each(function(e){$(this).val()||$(this).attr("placeholder","Membership Number")}),$(".js-login, .login-trigger").on("click",function(e){e.preventDefault(),$("#login").toggleClass("visible")}),$(".login-close").on("click",function(){$("#login").toggleClass("visible")}),$(".info-toggle").on("click",function(){$(".login-modal .instructions").toggleClass("visible")}))},megatron:{init:function(){this.resize(),$("#nav .mob-button").on("click",function(){$("#nav > ul.menu").toggleClass("open")}),e.w.resize(function(){e.header.megatron.resize()})},resize:function(){var t=e.vars.header;$("html").hasClass("no-touch")&&$("nav .equal-height").matchHeight()}}},slider:{element:$(".flexslider"),init:function(){var t=e.slider.element;t.length&&$(document).scroll(function(){$(document).scrollTop()>350&&$(".arrow-wrap").addClass("fadeOut")})}},sidebar:{element:$(".sidebar"),init:function(){var t=e.sidebar.element;t.length&&(e.sidebar.content=$("#content-wrapper"),e.sidebar.container=t.parent(".container"),this.triggers(),this.resize())},triggers:function(){$(".mob-bar .mob-button").on("click",function(){$("body").toggleClass("sidebar-visible")})},resize:function(){var t=e.vars.sidebar;if(t.length){var i=e.vars.sidebar.outerHeight(),n=$(".inner-content").outerHeight(),o=$("#breadcrumbs").outerHeight(!0);i>n?e.sidebar.container.css("height",i+o+32):e.sidebar.container.css("height",n+o)}}},contact:{element:$("#contact"),init:function(){var t=e.contact.element;t.length&&(this.triggers(),this.map.init())},triggers:function(){$(".feedback-toggle").on("click",function(){e.vars.contact.toggleClass("feedback-visible")}),$(".feedback-overlay").on("click",function(){e.vars.contact.toggleClass("feedback-visible")})},map:{element:$("#map"),init:function(){var t=e.contact.map.element;t.length&&e.w.on("load",function(){e.contact.map.loaded()})},loaded:function(){function e(){t=o.getCenter()}var t=new google.maps.LatLng(51.516098,-.156354),i={zoom:15,draggable:!1,disableDefaultUI:!1,scrollwheel:!1,center:t,styles:[{featureType:"water",elementType:"all",stylers:[{hue:"#e9ebed"},{saturation:-78},{lightness:67},{visibility:"simplified"}]},{featureType:"landscape",elementType:"all",stylers:[{hue:"#ffffff"},{saturation:-100},{lightness:100},{visibility:"simplified"}]},{featureType:"road",elementType:"geometry",stylers:[{hue:"#bbc0c4"},{saturation:-93},{lightness:31},{visibility:"simplified"}]},{featureType:"poi",elementType:"all",stylers:[{hue:"#ffffff"},{saturation:-100},{lightness:100},{visibility:"off"}]},{featureType:"road.local",elementType:"geometry",stylers:[{hue:"#e9ebed"},{saturation:-90},{lightness:-8},{visibility:"simplified"}]},{featureType:"transit",elementType:"all",stylers:[{hue:"#e9ebed"},{saturation:10},{lightness:69},{visibility:"on"}]},{featureType:"administrative.locality",elementType:"all",stylers:[{hue:"#2c2e33"},{saturation:7},{lightness:19},{visibility:"on"}]},{featureType:"road",elementType:"labels",stylers:[{hue:"#bbc0c4"},{saturation:-93},{lightness:31},{visibility:"on"}]},{featureType:"road.arterial",elementType:"labels",stylers:[{hue:"#bbc0c4"},{saturation:-93},{lightness:-2},{visibility:"simplified"}]}]},n=$("#map"),o=new google.maps.Map(n[0],i),a=new google.maps.Marker({position:t,map:o,icon:url.template+"/img/pin.png"});google.maps.event.addDomListener(o,"idle",function(){e()}),google.maps.event.addDomListener(window,"resize",function(){o.setCenter(t)})}}},cedric:{element:$("#isotope"),init:function(){var t=e.cedric.element;t.length&&(e.w.on("load",function(){e.cedric.isotope.init()}),e.cedric.filters.init())},filters:{element:$("#filters"),init:function(){var t=e.cedric.filters.element;if(t.length){var i=$(".filter-button",t),n=$(".js-toggle",t),o=$(".filters-menu"),a=t.offset().top;i.on("click",function(){$("html,body").animate({scrollTop:a});var t=$(this).attr("data-filter");e.cedric.isotope.element.isotope({filter:t})}),n.on("click",function(){t.toggleClass("filters-visible")}),o.on("click","button.filter",function(){var t=$(this).attr("data-filter");e.cedric.isotope.element.isotope({filter:t})}),o.on("click","button.sort",function(){var t=$(this).attr("data-sort-by");e.cedric.isotope.element.isotope({sortBy:t}),e.cedric.isotope.element.isotope({sortBy:t,sortAscending:{name:!0}})}),o.on("click","button.sort-desc",function(){var t=$(this).attr("data-sort-by");e.cedric.isotope.element.isotope({sortBy:t,sortAscending:{name:!1}})})}}},isotope:{element:$("#isotope"),init:function(){var t=e.cedric.isotope.element;t.length&&t.imagesLoaded(function(){t.isotope({itemSelector:".item",masonry:{columnWidth:".grid-sizer"},getSortData:{date:"[data-date]",name:".highlight"}})})}}},video:{element:$(".video-js"),init:function(){var t=e.video.element;if(t.length){$("#modal-video button").on("click",function(){$("#intro-video").fadeOut(500,function(){$("#modal-video").remove()})});var i=videojs("intro-video",{autoplay:!0});i.ready(function(){this.on("play",function(){$(".vjs-poster").remove()}),this.on("ended",function(){$("#intro-video").fadeOut(500,function(){$("#modal-video").remove()})})})}}},infiniteScroll:function(){var e=$("#post-list");e.length&&(e.infinitescroll({navSelector:"#navbelow",nextSelector:"#navbelow a",itemSelector:".post-item",extraScrollPx:150,loading:{finishedMsg:"No more items to load.",msgText:" ",img:site_url+"/wp-content/themes/homehouse/img/infloader.gif"}},function(e){var t=$(e).hide();t.imagesLoaded(function(){t.fadeIn()}),$("#infscr-loading").remove()}),$("body").hasClass("blog")&&($(window).unbind(".infscr"),$("a#next").click(function(t){return t.preventDefault(),e.infinitescroll("retrieve"),!1})),$(document).ajaxError(function(e,t,i){404==t.status&&$("a#next").remove()}))}};window.main=e,$(function(){window.main.init();var e=new Blazy({container:".flow"})})}(jQuery);