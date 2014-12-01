<?php 
/*
	Template Name: Reservation
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="reservation" class="flex-page has-sidebar page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php else: ?>
	<div id="reservation" class="flex-page page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php endif; ?>
	
	<div id="content-wrapper">

		<div class="container">
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs">','</p>');
			} ?><!-- .breadcrumbs -->
			
        	<section class="inner-content">
        
				<header>
					<h2>Make a reservation</h2>
				</header>

				<div class="body clearfix">
					<div class="widget column col-1-2">
						<div class="frame-dark">
							<iframe id="reservation_widget" name="widget" src="<?php the_field('reservation_widget'); ?>"></iframe>
						</div>
					</div>
					<div class="column col-1-2">
						<?php if(have_posts()): while(have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
					</div>
				</div>
				
			</section><!-- .inner-content -->
		</div><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #reservation -->

<?php get_footer(); ?>