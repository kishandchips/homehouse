<?php 
/*
	Template Name: Events
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="events" class="has-sidebar">
<?php else: ?>
	<div id="events">
<?php endif; ?>

	<div id="content-wrapper">
		<?php $args = array( 'post_type' => 'espresso_event', 'posts_per_page' => 5 ); ?>
		<?php $loop = new WP_Query( $args ); ?>

		<?php while($loop->have_posts()): $loop->the_post(); ?>
			<?php $event_id = get_post_meta($post->ID, 'event_id', true); ?>
			<article id="event_data-<?php echo $event_id ?>" class="event>">
				<div class="row">
					<div class="column col-2-3 pad expand">
						<?php $event_thumbnail_url = get_post_meta($post->ID, 'event_thumbnail_url', true); ?>

						<div class="rect bg" style="background-image:url(<?php echo $event_thumbnail_url; ?>)">
							<div class="valign">
								<h3 id="event_title-<?php echo $event_id ?>" class="title large">
									<?php the_title(); ?>
								</h3>
								<p>
									<a href="<?php the_permalink(); ?>"  class="button primary small">View Event</a>								
								</p>							
							</div>
						</div>
					</div>
					<div class="column col-1-3 pad expand">
						<div class="square pattern">
							<div class="event-desc valign">
								<?php the_excerpt(); ?>
								<p>
									<a href="<?php the_permalink(); ?>" class="button primary small">Read More</a>
								</p>
							</div>
						</div>
					</div>
				</div>		
			</article><!-- .event -->
		<?php endwhile; ?>
	</div><!-- #content-wrapper -->
</div><!-- #events -->
<?php get_footer(); ?>