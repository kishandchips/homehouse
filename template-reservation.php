<?php 
/*
	Template Name: Reservation
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="reservation" class="has-sidebar">
<?php else: ?>
	<div id="reservation">
<?php endif; ?>
	
	<div id="content-wrapper" class="pattern">

		<div class="container">
            	<section class="inner-content">
            
					<header>
						<h3 class="title large">Make a reservation</h3>						
					</header>

					<div class="column col-1-2">
						<div class="frame-dark">
							<iframe id="reservation_widget" name="widget" src="<?php the_field('reservation_widget'); ?>"></iframe>
						</div>
						
					</div>
					<div class="column col-1-2">
						<?php if(have_posts()): while(have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
					</div>					
				</section><!-- .inner-content -->

		</div><!-- .container -->

	</div><!-- #content-wrapper -->
</div><!-- #reservation -->

<?php get_footer(); ?>