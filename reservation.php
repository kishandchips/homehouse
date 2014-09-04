<?php 
/*
	Template Name: Reservation
*/
?>
<?php get_header(); ?>

<div id="reservation">
	
	<div id="content-wrapper" class="pattern">
		<section class="inner">
			<div class="row">
				<header>
					<h2 class="title large">Make a reservation</h2>						
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
			</div>			
		</section><!-- .inner -->
	</div><!-- #content-wrapper -->
</div><!-- #reservation -->

<?php get_footer(); ?>