<?php get_header(); ?>

<?php if(is_page('my-membership') and !is_user_logged_in()): ?>
	<?php wp_redirect( home_url() . '/login/' ); ?>
<?php endif; ?>

<?php if(get_field('sidebar')): ?>
	<div id="page" class="flex-page has-sidebar page-pattern" <?php if(get_field('page_pattern')): ?> style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php else: ?>
	<div id="page" class="flex-page page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
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

					<?php if(have_posts()): while(have_posts()): the_post(); ?>

					<div class="body">
						<?php the_content(); ?>
					</div>
					
					<?php endwhile; endif; ?>

				</section><!-- .inner-content -->
		</div><!-- .container -->

	<?php if(get_field('display_grid')): ?>

		<?php get_template_part( 'content', 'grid' ); ?>

	<?php endif; ?>	

	</div><!-- #content-wrapper -->
</div><!-- #page -->

<?php get_footer(); ?>