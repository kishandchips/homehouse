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

				</div><!-- .body -->
									
			</section><!-- .inner-content -->
		</div><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #testimonials -->

<?php get_footer(); ?>