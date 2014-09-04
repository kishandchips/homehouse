<?php 
/*
	Template Name: Events-Confirmation
*/
?>
<?php get_header(); ?>

<div id="events-single">

	<div id="content-wrapper" class="page-pattern clearfix">
		<div class="container">
				<section class="inner-content">
					<header>
						<h2 class="title large"><?php the_title(); ?></h2>						
					</header>

					<?php if(have_posts()): while(have_posts()): the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; endif; ?>
				</section><!-- .inner-content -->

		</div><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #events-single -->

<?php get_footer(); ?>