<?php get_header(); ?>

<div id="home">

	<div id="content-wrapper">
		<div class="flow">
			<div class="houses grid-flow row">
			<?php $posts = get_field('house_pages'); ?>
			<?php if($posts): ?>
				<?php foreach ($posts as $post): ?>
					<?php setup_postdata($post); ?>
				<div class="column col-1-3 pad">
					<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
					<div class="square bg" style="background-image:url(<?php echo $url; ?>)">
						<div class="valign">
							<h3 class="title large">
								<?php the_title(); ?>
							</h3>
							<p>
								<a href="<?php the_permalink(); ?>" class="button primary small" title="Explore <?php the_title(); ?>">Explore</a>								
							</p>
						</div>
					</div>
				</div>
				<?php endforeach; endif; ?>
				<?php wp_reset_postdata(); ?>
			</div><!-- .houses -->			
		</div><!-- .flow -->

		<?php  
		    $post_object= get_field('featured_event');
			if($post_object):
				$post = $post_object;
				setup_postdata( $post );
		?>
		<?php $event_thumbnail_url = get_post_meta($post->ID, 'event_thumbnail_url', true); ?>

		<div class="events">
			<div class="rect-items row">
				<div class="column col-2-3 pad expand">
					<div class="image" style="background-image:url(<?php echo $event_thumbnail_url; ?>)">
						<div class="valign">
							<h3 class="title large">
								<?php the_title(); ?>
							</h3>
							<p>
								<a href="<?php the_permalink(); ?>" class="button primary small" title="View <?php the_title(); ?>">View Event</a>
							</p>							
						</div>
					</div>
				</div>
		<?php endif; ?>	
		<?php wp_reset_postdata(); ?>

				<div class="column col-1-3 pad expand">
					<div class="content pattern-img">
						<div class="valign">
							<h3 class="title large">
								Upcoming Events
							</h3>
							<p>
								There is an abundance of events to suit all in June: screening both the World Cup & Wimbledon.
							</p>
							<p>
								<a href="<?php echo bloginfo('url'); ?>/events-calendar" class="button primary small" title="View Events Calendar">Full Events Calendar</a>
							</p>
						</div>
					</div>
				</div>
			</div><!-- .row -->
		</div><!-- .events -->

		<div class="flow">
			<div class="restaurants rect-items grid-flow row">
			<?php $posts = get_field('restaurant_pages'); ?>
			<?php if($posts): ?>
				<?php foreach ($posts as $post): ?>
				<?php setup_postdata($post); ?>
					<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				<?php if(count($posts)== 2): ?>

					<div class="column col-1-2 pad">
					<div class="image" style="background-image:url(<?php echo $url; ?>)">

				<?php else : ?>

					<div class="column col-1-3 pad">
					<div class="square bg" style="background-image:url(<?php echo $url; ?>)">

				<?php endif; ?>
					
						<div class="valign">
							<h3 class="title large">
								<?php the_title(); ?>
							</h3>
							<p>
								<a href="<?php the_permalink(); ?>" class="button primary small" title="Explore <?php the_title(); ?>">Explore</a>								
							</p>
						</div>
					</div>
				</div>
				<?php endforeach; endif; ?>
				<?php wp_reset_postdata(); ?>
			</div><!-- restaurants -->
		</div><!-- .flow -->

		<?php if( have_rows('row_content') ): ?>
			<?php while(has_sub_field('row_content')): ?>

				<div class="rect-items <?php the_sub_field('class'); ?> row">
					<div class="column col-2-3 pad expand <?php the_sub_field('alignment'); ?>">

					<?php $posts = get_sub_field('page'); ?>
					<?php foreach ($posts as $post): setup_postdata( $post );?>
						<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

						<div class="image" style="background-image:url(<?php echo $url; ?>)">
							<div class="valign">
								<h2 class="title large"><?php the_sub_field('title_text') ?></h2>
								<p>
									<a href="<?php the_permalink(); ?>" class="button primary small"><?php the_sub_field('button') ?></a>
								</p>
							</div>
						</div>

					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>

					</div>

					<div class="column col-1-3 expand pad">
						<div class="content pattern-img">
							<div class="valign">
								<?php the_sub_field('box_content'); ?>				
							</div>
						</div>
					</div>

				</div><!-- members -->

			<?php endwhile; ?>
		<?php endif; ?>

	</div><!-- #content-wrapper -->
</div><!-- #home -->

<?php get_footer(); ?>