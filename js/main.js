(function($){

var main = {

	vars : {},

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
		this.contact.init();

		$(window).resize(function(){
			main.header.megatron.resize();
		});

		$('.equal-height').matchHeight();	
	},

	header: {
		init: function(){
			this.megatron.init();
		},

		megatron: {
			init: function(){
				this.resize();

				// Menu Trigger
				$('#nav .mob-button').on('click', function(){
					$('#nav > ul.menu').toggleClass('open');
				});		

			},//init

			resize: function(){
				var header = main.vars.header;
				// Add mob classes
				if($(window).width() < 800){
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
			}
		}//megatron
	},

	sidebar: {

		init: function(){	
			var element = main.vars.sidebar;
			if(!element.length){return false;}

			main.sidebar.content = $('#content-wrapper');
			main.sidebar.container = element.parent('.container');

			this.listeners();
			this.resize();
		},

		listeners: function(){
			// Menu Trigger
			$('.inner-content .mob-button').on('click', function(){
				$('body').toggleClass('sidebar-visible');
			});
		},

		resize: function(){
			var element = main.vars.sidebar;
			if(!element.length){return false;}

			var sidebarHeight = main.vars.sidebar.outerHeight();
			var containerHeight = $('.inner-content').outerHeight();

			if(containerHeight < sidebarHeight){
				main.sidebar.container.css('height', sidebarHeight);
			}else{
				main.sidebar.container.css('height', containerHeight);
			}
		}
	},

	contact: {
		init: function(){
			var element = main.vars.contact;
			if(!element.length){return false;}

			this.triggers();
			this.map.init();
		},

		triggers: function(){
			// Feedback Toggle
			$('.feedback-toggle').on('click',function(){
				element.toggleClass('feedback-visible');
			});
			$('.feedback-overlay').on('click', function(){
				element.toggleClass('feedback-visible');
			});
		},

		map:{

			init: function(){
				var element = $('#map');

				if(!element.length){return false;}

				$(window).on('load', function(){
					main.map.loaded();					
				});
			},// init

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

				var center;
				function calculateCenter() {
				  center = map.getCenter();
				}
				google.maps.event.addDomListener(map, 'idle', function() {
				  calculateCenter();
				});
				google.maps.event.addDomListener(window, 'resize', function() {
				  map.setCenter(center);
				});
			}
		}
	},

	isotope:function(){
		var element = $('#cedric');
		if(!element.length){return false;}

		//bind trigger for scroll
		var filterTop = $('#filters').offset().top;

		$('#filters button').on('click', function(){
			$('html,body').animate({scrollTop: filterTop});
		});

		// initialise isotope
		var $container = $('#isotope').imagesLoaded( function() {
			$container.isotope({
				itemSelector: '.item',
				masonry:{
					columnWidth: '.grid-sizer',
				}
			});
		});
		$('#filters').on( 'click', 'button', function() {
		  var filterValue = $(this).attr('data-filter');
		  $container.isotope({ filter: filterValue });
		});
	}

};//main

	$(window).load(function(){
		$('.flexslider').flexslider({
	    	animation: "slide"
	  	});

	  	main.isotope();
	});

	main.init();
	
})(jQuery);