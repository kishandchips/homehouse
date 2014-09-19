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
			main.vars.footer = $('#footer'),
			main.vars.contact = $('#contact');

			this.header.init();
			this.sidebar.init();
			this.cedric.init();
			this.contact.init();

			main.w.on('load', function(){
				$('.flexslider').flexslider({
			    	animation: "slide"
			  	});
			});

			$('.equal-height').matchHeight();	
		},

		header: {
			element: $('#header'),

			init: function(){
				var element = main.header.element;
				if(!element.length){return;}

				this.megatron.init();

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
				$('.inner-content .mob-button').on('click', function(){
					$('body').toggleClass('sidebar-visible');
				});

			},// sidebar.listeners

			resize: function(){

				var element = main.vars.sidebar;
				if(!element.length){return;}

				var sidebarHeight = main.vars.sidebar.outerHeight();
				var containerHeight = $('.inner-content').outerHeight();

				if(containerHeight < sidebarHeight){
					main.sidebar.container.css('height', sidebarHeight);
				}else{
					main.sidebar.container.css('height', containerHeight);
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
					    disableDefaultUI: true,
					    scrollwheel: false,
					    center: center, // Homehouse
					    styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]}]
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
			element: $('#cedric'),

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

					var buttons = $('button', element),
						filterTop = element.offset().top;

					buttons.on('click', function(){
						$('html,body').animate({scrollTop: filterTop});

						var filterValue = $(this).attr('data-filter');
						main.cedric.isotope.element.isotope({ filter: filterValue });
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
							}
						});
					});
				}// cedric.isotope.init
			
			}// cedric.isotope
		}// main.cedric

	};//main


	main.init();
	
})(jQuery);