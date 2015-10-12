(function($){

	var main = {
		
		vars: {},
		w : $(window),

		init: function(){

			main.vars.header = $('#header'),
			main.vars.body = $('body'),
			main.vars.wrapper = $('#kanye-west'),
			main.vars.page = $('#page'),
			main.vars.sidebar = $('.sidebar'),
			main.vars.contact = $('#contact');

			this.header.init();
			this.slider.init();
			this.sidebar.init();
			this.cedric.init();
			this.contact.init();
			this.video.init();
			this.infiniteScroll();

			main.w.on('load', function(){
			  	main.sidebar.resize();

		        $('.flexslider').each( function() {
		            var $carousel = $(this);
		            $carousel.flexslider({
				    	animation: "fade",
				    	controlNav: $carousel.data("controlnav"),
				    	slideshowSpeed: 4000,
				    	pauseOnHover: true
		            });
		        });			  	
			});		

			if ($('ul.stream').length) {
					var amount = 0;
					var timerId = setInterval(function () {
						  $('.stream .dcsns-twitter:eq(0), .stream .dcsns-twitter:eq(1) ').addClass('show');
						  $('.stream .dcsns-instagram:eq(0), .stream .dcsns-instagram:eq(1) ').addClass('show');
						  $('.stream .dcsns-facebook:eq(0), .stream .dcsns-facebook:eq(1) ').addClass('show');
					    amount++;
					    if(amount === 10) {
					        clearInterval(timerId);
					    }
					}, 1 * 1000); // do this every 1 seconds 					
			}

			if($('#single .share-bar').length) {
				if(main.w.width() > 899) {
					$('#single .share-bar, #single .follow-bar').height($('#single .article-meta').height());
					$('#single .share-bar .share').hcSticky({
						top: 10
					});

					$('#single .follow-bar .follow').hcSticky({
						top: 10
					});

				}
			}				

			$('.equal-height').matchHeight();	

			if($('#ee-Sage_Pay-billing-form-zip-input-dv').length) {
				$('#ee-Sage_Pay-billing-form-zip-lbl').html('Postcode <span class="ee-asterisk">*</span>');
			}
		},

		header: {
			element: $('#header'),

			init: function(){
				var element = main.header.element;
				if(!element.length){return;}

				this.megatron.init();

				$('form').find('input[name="log"]').each(function(ev){
				  	if(!$(this).val()) {
				 		$(this).attr("placeholder", "Membership Name");
					}
				});

				$('form').find('input[name="pwd"]').each(function(ev){
				  	if(!$(this).val()) {
				 		$(this).attr("placeholder", "Membership Number");
					}
				});

				$('.js-login, .login-trigger').on('click', function(e){
					e.preventDefault();
					$('#login').toggleClass('visible');
				});

				if(main.w.width() > 550) {
					$('.call-btn').on('click', function(e){
						e.preventDefault();
						$('#call-us').toggleClass('visible');
					});
				}

				$('.login-close').on('click', function(){
					$('#login').toggleClass('visible');
				});

				$('.call-us-close').on('click', function(){
					$('#call-us').toggleClass('visible');
				});

				$('.info-toggle').on('click', function(){
					$('.login-modal .instructions').toggleClass('visible');
				})

			},

			megatron: {
				init: function(){

					this.resize();

					// Menu Trigger
					$('#nav .mob-button').on('click', function(){
						$('#nav > ul.menu').toggleClass('open');
					});	

					main.w.resize(function(){
						main.header.megatron.resize();
					});

				},// megatron.init

				resize: function(){

					var header = main.vars.header;
					
					// Equalise columns on desktop
					if($('html').hasClass('no-touch')){
						$('nav .equal-height').matchHeight();		
					}

				}// megatron.resize

			}// header.megatron
		},// main.header

		slider: {
			element: $('.flexslider'),

			init: function(){
				var element = main.slider.element;
				if(!element.length){return;}

				$(document).scroll(function() {
		        	if($(document).scrollTop() > 350) {
		            	$(".arrow-wrap").addClass('fadeOut');
		        	}
		    	});
			}
		},// main.slider

		sidebar: {
			element: $('.sidebar'),

			init: function(){

				var element = main.sidebar.element;
				if(!element.length){return;}

				main.sidebar.content = $('#content-wrapper');
				main.sidebar.container = element.parent('.container');

				this.triggers();
				this.resize();

			},

			triggers: function(){
				// Menu Trigger
				$('.mob-bar .mob-button').on('click', function(){
					$('body').toggleClass('sidebar-visible');
				});

			},// sidebar.listeners

			resize: function(){

				var element = main.vars.sidebar;
				if(!element.length){return;}

				var sidebarHeight = main.vars.sidebar.outerHeight(),
					containerHeight = $('.inner-content').outerHeight(),
					breadcrumbHeight = $('#breadcrumbs').outerHeight(true);

				if(containerHeight < sidebarHeight){
					main.sidebar.container.css('height', sidebarHeight+breadcrumbHeight+32);
				}else{
					main.sidebar.container.css('height', containerHeight+breadcrumbHeight);
				}

			}// sidebar.resize
		},// main.sidebar

		contact: {
			element: $('#contact'),

			init: function(){
				var element = main.contact.element;
				if(!element.length){return;}

				this.triggers();
				this.map.init();

			},

			triggers: function(){

				// Feedback Toggle
				$('.feedback-toggle').on('click',function(){
					main.vars.contact.toggleClass('feedback-visible');
				});
				$('.feedback-overlay').on('click', function(){
					main.vars.contact.toggleClass('feedback-visible');
				});

			},// contact.triggers

			map:{
				element: $('#map'),

				init: function(){
					var element = main.contact.map.element;
					if(!element.length){return;}

					main.w.on('load', function(){
						main.contact.map.loaded();					
					});

				},// contact.map.init

				loaded: function(){

					var center = new google.maps.LatLng(51.516098, -0.156354);
					var mapOptions = {
					    zoom: 15,
					    draggable: false,
					    disableDefaultUI: false,
					    scrollwheel: false,
					    center: center, // Homehouse
					    styles: [{"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]}]
					};

					var element = $('#map');
					var map = new google.maps.Map(element[0], mapOptions);
					
					var marker = new google.maps.Marker({
					      position: center,
					      map: map,
					      icon: url.template + '/img/pin.png',
					});

					function calculateCenter() {
					  center = map.getCenter();
					}
					google.maps.event.addDomListener(map, 'idle', function() {
					  calculateCenter();
					});
					google.maps.event.addDomListener(window, 'resize', function() {
					  map.setCenter(center);
					});

				}//contact.map.loaded

			}// contact.map
		},// main.contact

		cedric: {
			element: $('#isotope'),

			init: function(){
				var element = main.cedric.element;
				if(!element.length){return;}

				main.w.on('load', function(){
					main.cedric.isotope.init();
				});

				main.cedric.filters.init();

			},// main.cedric.init

			filters: {
				element: $('#filters'),

				init: function(){
					var element = main.cedric.filters.element;		
					if(!element.length){return;}

					var button = $('.filter-button', element),
						toggle = $('.js-toggle', element),
						menu = $('.filters-menu'),
						filterTop = element.offset().top;

					button.on('click', function(){
						$('html,body').animate({scrollTop: filterTop});

						var filterValue = $(this).attr('data-filter');
						main.cedric.isotope.element.isotope({ filter: filterValue });
					});

					toggle.on('click', function(){
						element.toggleClass('filters-visible');
					});

					menu.on('click', 'button.filter', function() {
  						var filterValue = $(this).attr('data-filter');
  						main.cedric.isotope.element.isotope({ filter: filterValue });
  						
					});

					menu.on('click', 'button.sort', function(){
						var sortByValue = $(this).attr('data-sort-by');
  						main.cedric.isotope.element.isotope({ sortBy: sortByValue});
  						main.cedric.isotope.element.isotope({ 
  							sortBy: sortByValue, 
  							sortAscending:{ 
  								name:true,
  							}
  						});
					});

					menu.on('click', 'button.sort-desc', function(){
						var sortByValue = $(this).attr('data-sort-by');
  						
  						main.cedric.isotope.element.isotope({ 
  							sortBy: sortByValue, 
  							sortAscending:{ 
  								name:false,
  							}
  						});
					});

				}

			},// main.cedric.filters

			isotope: {
				element: $('#isotope'),

				init: function(){
					var element = main.cedric.isotope.element;
					if(!element.length){return;}

					// initialise isotope
					element.imagesLoaded( function() {
						element.isotope({
							itemSelector: '.item',
							masonry:{
								columnWidth: '.grid-sizer'
							},
							getSortData: {
								date: '[data-date]',
							    name: '.highlight',
							},
						});
					});
				}// cedric.isotope.init
			
			}// cedric.isotope
		},// main.cedric

		video: {
			element: $('.video-js'),

			init: function(){
				var element = main.video.element;
				if(!element.length){return;}

				$('#modal-video button').on('click', function(){
					$("#intro-video").fadeOut(500, function() {
						$("#modal-video").remove();
					});
				});

				var player = videojs('intro-video',{
					autoplay: true
				});

				player.ready(function(){
					this.on('play', function(){
						$('.vjs-poster').remove();
					});

					this.on("ended", function() {
						$("#intro-video").fadeOut(500, function() {
							$("#modal-video").remove();
						});
					});
				});
			}
		},

		infiniteScroll: function() {
			var container = $('#post-list');

			if(container.length) {
				container.infinitescroll({
					navSelector: "#navbelow",
					nextSelector: "#navbelow a",
					itemSelector: ".post-item",
					extraScrollPx: 150,
					loading: {
						finishedMsg: 'No more items to load.',
						msgText: ' ',
						img: site_url +'/wp-content/themes/homehouse/img/infloader.gif'
					}
				}, function (newElements) {
					var newElems = $( newElements ).hide();
						newElems.imagesLoaded(function(){
						newElems.fadeIn(); // fade in when ready
					});
					$( "#infscr-loading" ).remove();
				});

				if ($('body').hasClass('blog')) {
					$(window).unbind('.infscr');
					$('a#next').click(function(e){
						e.preventDefault();
					    container.infinitescroll('retrieve');
					 	return false;
					});
				};


				$(document).ajaxError(function(e,xhr,opt) {
					if(xhr.status==404)
					  $('a#next').remove();
				});			  	
			}
		}		

	};//main

	window.main = main;

	$(function(){
		window.main.init();
		var bLazy = new Blazy({
			container: '.flow'
		});

	});
	
})(jQuery);