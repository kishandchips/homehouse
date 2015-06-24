<?php get_header(); ?>

<?php if(is_page('my-membership') and !is_user_logged_in()): ?>
	<?php wp_redirect( home_url() . '/login/' ); ?>
<?php endif; ?>



	<div id="content-wrapper">	
		<div class="container">

			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs">','</p>');
			} ?><!-- .breadcrumbs -->

	        
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


	</div><!-- #content-wrapper -->
</div><!-- #page -->

<?php get_footer(); ?>