<?php 
/*
	Template Name: House-Single
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="house-single" class="has-sidebar">
<?php else: ?>
	<div id="house-single">
<?php endif; ?>

		<?php if(get_field('hero')): ?>
			
			<?php $images = get_field('slider_images'); ?>
			<?php if($images): ?>
				<?php if(count($images)>1): ?>

					<section class="hero flexslider thumbnails">
						
						<div class="hero-content valign">
							<div class="highlight">
								<h2 class="title"><?php the_title(); ?></h2>
							</div>
						</div>

						<ul class="slides">
							<?php foreach ($images as $image): ?>
								<li style='background-image: url(<?php echo $image['sizes']['slider']; ?>)'>
									<img src="<?php echo $image['url']; ?>">
								</li>
							<?php endforeach; ?>
						</ul>
					</section><!-- hero flexslider -->

				<?php else: ?>
					<?php foreach ($images as $image): ?>

						<div class="hero image" style="background-image:url(<?php echo $image['sizes']['slider']; ?>)">
	
							<div class="hero-content valign">
								<div class="highlight">
									<h2 class="title"><?php the_title(); ?></h2>
								</div>
							</div>

							<img src="<?php echo $image['url']; ?>">
						</div><!-- hero image -->

					<?php endforeach; ?>

				<?php endif; ?>
			<?php endif; ?>

		<?php endif; ?>

	<div id="content-wrapper" class="page-pattern">
		<div class="container">

			<?php if(get_field('sidebar')): ?>
				<div class="sidebar column col-1-5">
	 				<?php
						$parent = array_reverse(get_post_ancestors($post->ID));
						$first_parent = get_page($parent[0]);
					?>
					<h3 class="sidenav-title"><a href="<?php echo $first_parent->guid; ?>"><?php echo $first_parent->post_title; ?></a></h3>
					<?php get_sidebar(); ?>
				</div><!-- sidenav -->
			<?php endif; ?>

			<section class="inner-content column col-4-5">
			    <button aria-role="Mobile Sidebar Button" class="mob-button">
                    <i class="icon-menu"></i>
                    <span>Sidebar</span>
                </button>

				<header>
					<h3 class="title large"><?php the_title(); ?></h3>						
				</header>

				<?php if(have_posts()): while(have_posts()): the_post(); ?>
				<div class="body">
					<?php the_content(); ?>
				</div>
				<?php endwhile; endif; ?>						
			</section><!-- .inner-content -->

		</div><!-- .container -->

		<div class="flow">
			<section class="rect-items grid-flow row">
				<div class="column col-1-3 pad">
					<div class="content pattern">
						<div class="valign">
							<h3 class="title">Events at house No 19</h3>
							<p>There is an abundance of events to suit all in June: screening both the World Cup and Wimbledon.</p>
							<p><a href="<?php echo bloginfo('url'); ?>/events-calendar" class="button primary small" title="Full Events Calendar">Full events calendar</a></p>
						</div>
					</div>
				</div>

				<?php 
					global $post;
					$slug = get_post( $post )->post_name;

				?>
				<?php 
					$args = array(
						'post_type'   => 'espresso_event',
						'posts_per_page'         => 2,
						'tax_query' => array(
							array(
								'taxonomy'         => 'category',
								'field'            => 'slug',
								'terms'            => array($slug),
							)
						),
					);
				
				$upcoming_events = new WP_Query( $args );
				 ?>

				 <?php if($upcoming_events->have_posts()): while($upcoming_events->have_posts()): $upcoming_events->the_post(); ?>
				<div class="column col-1-3 pad">
					<?php $event_thumbnail_url = get_post_meta($post->ID, 'event_thumbnail_url', true); ?>
					<div class="image" style="background-image:url(<?php echo $event_thumbnail_url; ?>)">
						<div class="valign">
							<div class="highlight">
								<h3 class="title"><?php the_title(); ?></h3>
								<p><a href="<?php the_permalink(); ?>" class="button primary small">View Event</a></p>								
							</div>
						</div>
					</div>
				</div>
				<?php endwhile; endif; ?>
				<?php wp_reset_query(); ?>	

			</section>		
		</div><!-- flow -->	

	</div><!-- #content-wrapper -->
</div><!-- #house-single -->

<?php get_footer(); ?>