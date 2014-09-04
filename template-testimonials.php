<?php 
/*
	Template Name: Testimonials
*/
?>
<?php get_header(); ?>

<div id="testimonials" class="clearfix">

	<div id="content-wrapper" class="page-pattern clearfix">
		<div class="container">

			<?php if(get_field('sidebar')): ?>
				<div class="sidebar column col-1-5">
	 				<?php
						$parent = array_reverse(get_post_ancestors($post->ID));
						$first_parent = get_page($parent[0]);
					?>
					<h3 class="sidenav-title"><a href="<?php echo $first_parent->guid; ?>"><?php echo $first_parent->post_title; ?></a></h3>
					<?php get_sidebar(); ?>
				</div><!-- sidenav -->
			<?php endif; ?>

			<section class="inner-content column col-4-5">
			    <button aria-role="Mobile Sidebar Button" class="mob-button">
                    <i class="icon-menu"></i>
                    <span>Sidebar</span>
                </button>

				<header>
					<h3 class="title large"><?php the_title(); ?></h3>						
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