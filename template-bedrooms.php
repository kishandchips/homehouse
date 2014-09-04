<?php 
/*
	Template Name: Bedrooms
*/
?>
<?php get_header(); ?>

<div id="bedrooms">
	<?php $images = get_field('slider_images'); ?>
	<?php if($images): ?>
		<?php if(count($images)>1): ?>

			<section class="hero flexslider thumbnails">
				<ul class="slides">
					<?php foreach ($images as $image): ?>
						<li style="background-image:url(<?php echo $image['url']; ?>)">
						</li>
					<?php endforeach; ?>
				</ul>
			</section><!-- hero flexslider -->

		<?php else: ?>
			<?php foreach ($images as $image): ?>

				<div class="hero image" style="background-image:url(<?php echo $image['url']; ?>)">
				</div><!-- hero image -->

			<?php endforeach; ?>
		<?php endif; ?>
	<?php endif; ?>

	<div id="content-wrapper" class="page-pattern">
		<div class="container">
			<section class="inner-content">
				<header>
					<h3 class="title large"><?php the_title(); ?></h3>						
				</header>

				<?php if(have_posts()): while(have_posts()): the_post(); ?>
				<div class="body">
					<?php the_content(); ?>
				</div>
				<?php endwhile; endif; ?>	
			</section><!-- .inner-content -->			
		</div><!-- .inner -->

		<?php $pages = get_pages( array('sort_column'=>'menu_order','child_of'=>$post->ID) ); ?>
		<?php foreach ($pages as $page ): ?>

		<div class="bedroom">
			<div class="row">
				<div class="column col-2-3 pad expand">
					<?php $url = wp_get_attachment_url( get_post_thumbnail_id($page->ID) ); ?>
					<div class="rect bg" style="background-image:url(<?php echo $url ?>)">
					</div>
				</div>
				<div class="column col-1-3 pad expand">
					<div class="square pattern">
						<div class="valign">
							<h3 class="title large">
								<?php echo get_the_title($page->ID); ?>
							</h3>
							<p>
								<a href="<?php echo get_the_permalink($page->ID); ?>" class="button primary small">View Room</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .bedroom -->

		<?php endforeach; ?>
		
	</div><!-- #content-wrapper -->
</div><!-- #bedrooms -->

<?php get_footer(); ?>