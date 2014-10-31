<?php 
/*
	Template Name: Testimonials
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="testimonials" class="flex-page has-sidebar page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php else: ?>
	<div id="testimonials" class="flex-page page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php endif; ?>

		<?php if(get_field('hero')): ?>
			
			<?php $images = get_field('slider_images'); ?>
			<?php if($images): ?>
				<?php if(count($images)>1): ?>

					<section class="hero flexslider thumbnails">
						
						<div class="hero-content valign">
							<h2 class="title"><?php the_title(); ?></h2>
						</div>

						<ul class="slides">
							<?php foreach ($images as $image): ?>
								<li style='background-image: url(<?php echo $image['sizes']['slider']; ?>)'>
									<img src="<?php echo $image['sizes']['slider']; ?>">
								</li>
							<?php endforeach; ?>
						</ul>

						<div class="arrow-wrap"></div>
					</section><!-- hero flexslider -->

				<?php else: ?>
					<?php foreach ($images as $image): ?>

						<div class="hero image" style="background-image:url(<?php echo $image['sizes']['slider']; ?>)">
	
							<div class="hero-content valign">
								<h2 class="title"><?php the_title(); ?></h2>
							</div>

							<img src="<?php echo $image['sizes']['slider']; ?>">
						</div><!-- hero image -->

					<?php endforeach; ?>

				<?php endif; ?>
			<?php endif; ?>

		<?php endif; ?>

	<div id="content-wrapper">
		<div class="container">
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs">','</p>');
			} ?><!-- .breadcrumbs -->

			<?php if(get_field('sidebar')): ?>
				<div class="sidebar column">

	 				<?php $parent = array_reverse(get_post_ancestors($post->ID)); ?>
					<?php if(count($parent)): ?>	
						<?php $first_parent = get_page($parent[0]); ?>
						<h3 class="sidenav-title"><a href="<?php echo $first_parent->guid; ?>"><?php echo $first_parent->post_title; ?></a></h3>
					<?php else: ?>
						<h3 class="sidenav-title"><a href="<?php get_page_link($post->ID );; ?>"><?php the_title(); ?></a></h3>
					<?php endif; ?>

					<?php get_sidebar(); ?>
				</div><!-- sidenav -->

				<section class="inner-content column">
					<div class="mob-bar">
						<button aria-role="Mobile Sidebar Button" class="mob-button">
		                    <i class="icon-menu"></i>
		                    <span>Side Menu</span>
		                </button>						
					</div>
            <?php else: ?>

            	<section class="inner-content">
            <?php endif; ?>

				<header>
					<h2><?php the_title(); ?></h2>						
				</header>
				
				
				<div class="body">
					<?php if( have_rows('testimonials')): while( have_rows('testimonials')) : the_row(); ?>
						<article class="testimonial">
							<?php the_sub_field('testimonial_text'); ?>
							<b><?php the_sub_field('testimonial_name'); ?></b>
						</article>
						<div class="separator">
							<span>&#9830;</span>
						</div>
					<?php endwhile; endif; ?>	
				</div>
									
			</section><!-- .inner-content -->

		</div><!-- .container -->
	</div><!-- #content-wrapper -->

</div><!-- #contact -->

<?php get_footer(); ?>