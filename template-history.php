<?php 
/*
	Template Name: History
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="history" class="flex-page has-sidebar page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php else: ?>
	<div id="history" class="flex-page page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
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
				<?php if( have_rows('history_snippet')): while( have_rows('history_snippet')) : the_row(); ?>
					<article class="history-snippet">
						<?php if( have_rows('dates')): while( have_rows('dates')) : the_row(); ?>
							<div class="meta">
								<span><?php the_sub_field('snippet_date'); ?></span>
							</div>
						<?php endwhile; endif; ?>
						<div class="body">
							<?php the_sub_field('snippet_body'); ?>
						</div>
					</article><!-- .history-snippet -->
				<?php endwhile; endif; ?>
					<article class="history-snippet end">
							<div class="meta">
								<span>Now</span>
							</div>
						<div class="body">
							<p class="medium">What's next for <?php the_title(); ?>...?</p>
							<p><a href="<?php bloginfo('url' ); ?>/events">Show all Upcoming Events</a></p>
						</div>
					</article><!-- .history-snippet -->

			</section><!--.inner-content  -->
		</div><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #history -->

<?php get_footer(); ?>