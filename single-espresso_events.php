<?php 
/*
	Template Name: Events-Single
*/
?>
<?php get_header(); ?>

<div id="events-single" class="flex-page page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
	<?php 

		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 

	 ?>
	<section class="hero image" style="background-image:url(<?php echo $image[0]; ?>)">
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
						$event_id = get_the_ID();
						$event_start_date = espresso_event_date('', ' ', $event_id, false);
						$event_location = get_post_meta($event_id, 'event_location', true);
						$event_time = espresso_event_date(' ', '', $event_id, false);
					?>

				<div class="body">
					<p>	
						<i class="icon-calendar"></i>
						<b>Date:</b> <?php echo $event_start_date; ?>
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
						<b>Ticket types available to book:</b>
						<?php 
							if ( $post->EE_Event instanceof EE_Event ) {
								$tickets = $post->EE_Event->first_datetime()->tickets();

								foreach ($tickets as $ticket) {

									echo '<span class="ticket-type">';
									echo $ticket->name() . ': ';
									echo $ticket->pretty_price();
									echo '</span>';
								}
							}
						 ?>										
					</p>

					<div class="description">
						<?php the_content(); ?>
					</div>


					<p>
						<?php echo do_shortcode('[ESPRESSO_TICKET_SELECTOR event_id="'. $event_id .'"]' ); ?>
					</p>

				</div>

				<?php endwhile; endif; ?>

			</section><!-- .inner-content -->
		</div><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #events-single -->

<?php get_footer(); ?>