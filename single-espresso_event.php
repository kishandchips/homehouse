<?php 
/*
	Template Name: Events-Single
*/
?>
<?php get_header(); ?>
<?php global $wpdb; ?>

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

					// Get list of attendees for the event and then check to see if
					// the current user exists on the list AND has Completed payment.
					$user_booked = $wpdb->get_row(
						$wpdb->prepare(
							"SELECT user_id 
							FROM wp_events_attendee a
							JOIN wp_events_member_rel m ON m.attendee_id = a.id 
							WHERE a.event_id = '%d' AND a.payment_status = 'Completed' AND m.user_id = '%s' ", 
						$event_id, $current_user->ID )
					);

						// echo '<pre>';
						// echo('EE Event ID :' 	. $event_id);
						// echo('<br>');
						// echo('WP User ID :' 	. $current_user->ID);
						// echo('<br>');
						// var_dump($user_booked);
						// echo '</pre>';
				?>
				<div class="body">

					<p>
						<i class="icon-calendar"></i>
						<b>Date:</b> <?php echo $event_start_date ?>
					</p>
					<?php if ($event_location != ""): ?>
					<p>
						<i class="icon-pin"></i>
						<b>Location:</b> <?php echo $event_location ?>
					</p>
					<?php endif; ?>
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
					
					<?php if($user_booked != null): ?>
							<p class="notice">
								<b>You have already reserved your place for this event.</b>
							</p>
					<?php endif; ?>
				</div>

					<?php if($user_booked == null): ?>
						<span class="ticket-wrap">
							<?php echo do_shortcode('[ESPRESSO_CART_LINK event_id="'.$event_id.'" direct_to_cart=1 moving_to_cart="Redirecting to cart..."]' ); ?>	
						</span>
					<?php endif; ?>

				<?php endwhile; endif; ?>

			</section><!-- .inner-content -->
		</div><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #events-single -->

<?php get_footer(); ?>