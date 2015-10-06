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

	<?php if(get_field('hero')): ?>
		
		<?php get_template_part( 'content', 'slider' ); ?>

	<?php endif; ?>

	<div id="content-wrapper">


		<?php $pages = get_pages( array('sort_column'=>'menu_order','child_of'=>$post->ID) ); ?>
		<?php foreach ($pages as $post ): ?>
			 <?php setup_postdata( $post ); ?>

		<div class="bedroom">
			<div class="rect-items row">
					<div class="column col-2-3 pad expand">
						<?php 
							$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full' );
							$image = $image[0];
							$image_size = array('width' => 1046, 'height' => 500);
							$image = bfi_thumb($image, $image_size);
						?>

						<div class="image" style="background-image:url(<?php echo $image; ?>)">
						</div>
					</div>
					<div class="column col-1-3 pad expand">
						<div class="content">
							<h3 class="title large">
								<?php the_title(); ?>
							</h3>
							<p>
								<?php echo custom_excerpt(30, ' ...'); ?>
							</p>
							<div class="buttons">
								<a href="<?php echo get_the_permalink($post->ID); ?>" title="<?php the_title(); ?>" class="button secondary med white">Explore</a>
								<a href="mailto:reservations@homehouse.co.uk?subject=Bedroom booking request - <?php the_title(); ?>&body=Hi,I would like to book the bedroom found here: <?php the_permalink(); ?>" title="<?php the_title(); ?>" class="button primary purple med">Book Now</a>
							</div>							
						</div>
					</div>
			</div>
		</div><!-- .bedroom -->
		<?php wp_reset_postdata(); ?>
		<?php endforeach; ?>
		
	</div><!-- #content-wrapper -->
</div><!-- #bedrooms -->

<?php get_footer(); ?>