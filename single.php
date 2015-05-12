<?php get_header(); ?>

<div id="single" class="flex-page has-sidebar page-pattern">
	<div id="content-wrapper">
		<div class="container">
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs">','</p>');
			} ?><!-- .breadcrumbs -->
				
			<div class="sidebar column">
				<h3 class="sidenav-title">Categories</h3>

				<?php dynamic_sidebar('blog' ); ?>
			</div><!-- sidenav -->

			<section class="inner-content column">
				<article class="single">
					<?php if(have_posts()): while(have_posts()): the_post(); ?>
						<div class="single-meta">
							<div class="date">
								<span class="day">
									<?php the_time('d'); ?>
								</span>
								<span class="month">
									<?php the_time('F');?>
								</span>	
							</div>
							
							<div class="title">
								<h3><?php the_title(); ?></h3>
							</div>

							<div class="author">
								<span>Added By </span>
								<?php the_author(); ?>
							</div>
							<div class="categories">
								<span>Filed under </span>
								<?php the_category(); ?>
							</div>
						</div>
						<div class="body">
							<?php the_content(); ?>
						</div>
						
					<?php endwhile;endif; ?>
					
					<div class="separator"><span>&#9830;</span></div>

					<div class="share">
						<span>Share</span>
						<ul class="social-icons">
							<li>
								<a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="Share on Facebook" target="_blank">
									<i class="icon-facebook"></i>
								</a>							
							</li>
							<li>
								<a href="http://twitter.com/share?text=<?php the_title(); ?>" title="Share on Twitter" target="_blank">
									<i class="icon-twitter"></i>
								</a>
							</li>
						</ul>
					</div>

				</article>
				<p>
					<a href="<?php bloginfo('url'); ?>/blog" class="primary button small" title="Back to Homehouse Blog">Back to Blog</a>
				</p>
				
			</section><!-- .inner-content -->		
		</div><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #single-cedric -->

<?php get_footer(); ?>