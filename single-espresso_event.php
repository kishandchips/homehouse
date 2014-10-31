<?php 
/*
	Template Name: Events-Single
*/
?>
<?php get_header(); ?>

<div id="events-single" class="flex-page page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
	
	<?php $event_thumbnail_url = get_post_meta($post->ID, 'event_thumbnail_url', true); ?>
	<section class="hero image" style="background-image:url(<?php echo $event_thumbnail_url; ?>)">

	</section><!-- hero-slider -->
	
	<div id="content-wrapper">
		<div class="container">
			<section class="inner-content">
				<header>
					<h2>Book your tickets for:</h2>
					<hr>
					<h1 class="event_title"><?php the_title(); ?></h1>						
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
					<p>
						<i class="icon-calendar"></i>
						<b>Date:</b> <?php echo $event_start_date ?>
					</p>
					<p>
						<i class="icon-pin"></i>
						<b>Location:</b> <?php echo $event_location ?>
					</p>
					<p>
						<i class="icon-time"></i>
						<b>Time:</b> <?php echo $event_time ?>
					</p>
					<p>
						<i class="icon-ticket"></i>
						<b>Price:</b><?php echo $event_price ?>
					</p>
					<div class="description">
						<?php the_content(); ?>
					</div>
				</div>

				<span class="ticket-wrap">
					<?php echo do_shortcode('[ESPRESSO_CART_LINK event_id="'.$event_id.'" direct_to_cart=1 moving_to_cart="Redirecting to cart..."]' ); ?>	
				</span>

				<?php endwhile; endif; ?>
			</section><!-- .inner-content -->

		</div><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #events-single -->

<?php get_footer(); ?>