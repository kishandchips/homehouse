(function($){

	window.main = {
		
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

			main.w.on('load', function(){
				$('.flexslider').flexslider({
			    	animation: "fade",
			    	controlNav: true,
			    	slideshowSpeed: 4000
			  	});
			  	main.sidebar.resize();
			});

			$('.equal-height').matchHeight();	
		},

		header: {
			element: $('#header'),

			init: function(){
				var element = main.header.element;
				if(!element.length){return;}

				this.megatron.init();

				$('.js-login').on('click', function(){
					$('#login-wrapper').toggleClass('visible');
				});

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
					// Add mob classes
					if(main.w.width() < 800){
						header.removeClass('mega');
						header.addClass('mobile');
					} else {
						header.removeClass('mobile');
						header.addClass('mega');
					}
					
					// Equalise columns on desktop
					if($('html').hasClass('no-touch') && header.hasClass('mega')){
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

				player = videojs('#intro-video');
				
				player.ready(function(){
					this.on("ended", function() {
						$("#intro-video").fadeOut(500, function() {
							$("#modal-video").remove();
						});
						// $('.flexslider .slides').addClass('visible');
					});
				});
			}
		}

	};//main

	main.init();
	
})(jQuery);