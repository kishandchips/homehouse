<?php 
/*
	Template Name: Events-Confirmation
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="events-single" class="flex-page has-sidebar page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php else: ?>
	<div id="events-single" class="flex-page page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php endif; ?>

	<div id="content-wrapper">
		<div class="container">
				<section class="inner-content">
					<header>
						<h2><?php the_title(); ?></h2>
						<hr>				
					</header>

					<?php if(have_posts()): while(have_posts()): the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; endif; ?>
				</section><!-- .inner-content -->

		</div><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #events-single -->

<?php get_footer(); ?>