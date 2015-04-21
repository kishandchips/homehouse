<?php 
/*
	Template Name: House-Single
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="house-single" class="flex-page has-sidebar page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php else: ?>
	<div id="house-single" class="flex-page page-pattern"  <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php endif; ?>

	<?php if(get_field('hero')): ?>
		
		<?php get_template_part( 'content', 'slider' ); ?>

	<?php endif; ?>

	<div id="content-wrapper">
		<div class="container">
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs">','</p>');
			} ?><!-- .breadcrumbs -->

			<?php if(get_field('sidebar')): ?>
				
				<?php get_template_part( 'content', 'sidebar' ); ?>
				
            <?php else: ?>

            	<section class="inner-content">
            <?php endif; ?>

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
							<h3 class="title large">Events at <?php the_title(); ?></h3>
							<p>There is an abundance of events to suit all at HomeHouse.</p>
							<p><a href="<?php echo bloginfo('url'); ?>/events" class="button primary small" title="Full Events Calendar">View Events</a></p>
						</div>
					</div>
				</div>

				<?php 
					global $post;
					$slug = get_post( $post )->post_name;

				?>
				<?php 
					$args = array(
						'post_type'   => 'espresso_events',
						'posts_per_page'         => 2,
						'tax_query' => array(
							array(
								'taxonomy'         => 'espresso_event_categories',
								'field'            => 'slug',
								'terms'            => array($slug),
							)
						),
					);
				
				$upcoming_events = new WP_Query( $args );
				 ?>

				 <?php if($upcoming_events->have_posts()): while($upcoming_events->have_posts()): $upcoming_events->the_post(); ?>
				<div class="column col-1-3 pad">
					<?php $event_thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
					<div class="image" style="background-image:url(<?php echo $event_thumbnail_url[0]; ?>)">
						<div class="valign">
							<h3 class="highlight medium"><?php the_title(); ?></h3>
							<p><a href="<?php the_permalink(); ?>" class="button primary small">View Event</a></p>
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