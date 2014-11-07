<?php 
/*
	Template Name: Bedrooms
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="bedrooms" class="flex-page has-sidebar page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php else: ?>
	<div id="bedrooms" class="flex-page page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
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
						<h2><?php the_title(); ?></h2>
					</header>

					<?php if(have_posts()): while(have_posts()): the_post(); ?>
					
					<div class="body">
						<?php the_content(); ?>
					</div>

					<?php endwhile; endif; ?>
					
				</section><!-- .inner-content -->

		</div><!-- .container -->

		<?php $pages = get_pages( array('sort_column'=>'menu_order','child_of'=>$post->ID) ); ?>
		<?php foreach ($pages as $post ): ?>

		<div class="bedroom">
			<div class="rect-items row">
				<a href="<?php echo get_the_permalink($post->ID); ?>" title="<?php the_title(); ?>">
					<div class="column col-2-3 pad expand">
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'grid-rect-large' ); ?>
						<div class="image" style="background-image:url(<?php echo $image[0] ?>)">
						</div>
					</div>
					<div class="column col-1-3 pad expand">
						<div class="content pattern">
							<div class="valign">
								<h3 class="title large">
									<?php echo get_the_title($post->ID); ?>
								</h3>
								<p>
									<span class="button primary small">View Room</span>
								</p>							
							</div>
						</div>
					</div>
				</a>
			</div>
		</div><!-- .bedroom -->

		<?php endforeach; ?>
		
	</div><!-- #content-wrapper -->
</div><!-- #bedrooms -->

<?php get_footer(); ?>