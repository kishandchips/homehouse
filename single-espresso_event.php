<?php 
/*
	Template Name: Events-Single
*/
?>
<?php get_header(); ?>

<div id="events-single">
	<?php $event_thumbnail_url = get_post_meta($post->ID, 'event_thumbnail_url', true); ?>
	<section class="hero image" style="background-image:url(<?php echo $event_thumbnail_url; ?>)">

	</section><!-- hero-slider -->
	
	<div id="content-wrapper">
		<div class="container">
				<section class="inner-content">
					<header>
						<span>You're booking tickets for:</span>
						<hr>
						<h2 class="title xlarge"><?php the_title(); ?></h2>						
					</header>

					<?php if(have_posts()): while(have_posts()): the_post(); ?>
						<?php 
						$event_id = get_post_meta($post->ID, 'event_id', true);
						$event_start_date = get_post_meta($post->ID, 'event_start_date', true);
						$event_location = get_post_meta($post->ID, 'event_location', true);
						$event_price = '£' . do_shortcode('[EVENT_PRICE event_id="'.$event_id.'" number="0"]');
						$event_time = do_shortcode('[EVENT_TIME event_id="'.$event_id.'" type="start_time"]');
						?>
					<div class="body">
						<p><b>Date:</b> <?php echo $event_start_date ?><br>
						<b>Location:</b> <?php echo $event_location ?><br>
						<b>Time:</b> <?php echo $event_time ?><br>
						<b>Price:</b> <?php echo $event_price ?></p>
						<div class="description">
							<?php the_content(); ?>
						</div>
						<?php echo do_shortcode('[ESPRESSO_CART_LINK event_id="'.$event_id.'" direct_to_cart=1 moving_to_cart="Redirecting to cart..."]' ); ?>
						<!-- <?php echo do_shortcode('[ESPRESSO_REG_FORM event_id="'.$event_id.'"]' ); ?> -->

					</div>
					<?php endwhile; endif; ?>
				</section><!-- .inner-content -->

		</div><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #events-single -->

<?php get_footer(); ?>