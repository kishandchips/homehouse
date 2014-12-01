<?php 
/*
	Template Name: Contact
*/
?>
<?php get_header(); ?>

<div id="contact" class="flex-page row page-pattern">
	<div id="map" class="column col-3-5 equal-height">
		<?php wp_enqueue_script('mapkey'); ?>
	</div><!-- .map -->
	
	<div class="contact-info column col-2-5 equal-height">
		<div class="address">
			<header>
				<h2>Where to find us</h3>
			</header>
			<div class="body small">
				<?php the_field('address_info'); ?>
			</div>		
		</div>

		<div class="opening">
			<header>
				<h2>Opening Hours</h3>
			</header>
			<div class="body small">
				<div class="row">
					<div class="column col-1-2">
						<?php the_field('opening_info1'); ?>
					</div>
					<div class="column col-1-2">
						<?php the_field('opening_info2'); ?>
					</div>
				</div>
			</div>
		</div>

		<button class="button primary small feedback-toggle">
			Contact Us
		</button>
	</div><!-- .contact-info -->

	<div class="feedback-overlay">	
	</div><!-- .feedback overlay -->
	<div class="feedback">
		<button class="button feedback-toggle" aria-role="toggle feedback form">
			<i class="icon-cross"></i>
		</button>		
		<?php echo do_shortcode('[gravityform id=2 title=false description=true ajax=true ]' ); ?>
	</div><!-- .feedback -->	

</div><!-- #contact -->

<?php get_footer(); ?>