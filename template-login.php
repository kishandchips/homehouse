<?php 
/*
	Template Name: Login
*/
?>
<?php $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;  ?>
<?php get_header(); ?>


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

					<?php if ( !is_user_logged_in() ) : ?>
						<?php 
							if ( $login === "failed" ) {
								echo '<p class="login-msg"><strong>ERROR:</strong> Invalid username and/or password.</p>';
							} elseif ( $login === "empty" ) {
								echo '<p class="login-msg"><strong>ERROR:</strong> Username and/or Password is empty.</p>';
							} elseif ( $login === "false" ) {
								echo '<p class="login-msg"><strong>ERROR:</strong> You are logged out.</p>';
							}
						?>
						<?php 

							if( isset($_REQUEST['redirect_to']) ){
								$redirect = $_REQUEST['redirect_to'];
							} else {
								$redirect = home_url() . '/login/';
							}
							
							$args = array(
	            				'redirect'       => $redirect,
	            			) 

            			?>

            			<?php wp_login_form($args); ?>

        			<?php else: ?>

						<?php wp_redirect( home_url() . '/my-membership/' ); ?>

        			<?php endif; ?>

				</div><!-- .body -->

				<?php endwhile; endif; ?>	

			</section><!-- .inner-content -->
		</div><!-- .container -->

	<?php if(get_field('display_grid')): ?>

		<?php get_template_part( 'content', 'grid' ); ?>

	<?php endif; ?>	
	
	</div><!-- #content-wrapper -->
</div><!-- #login -->

<?php get_footer(); ?>