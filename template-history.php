<?php 
/*
	Template Name: History
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="history" class="has-sidebar">
<?php else: ?>
	<div id="history">
<?php endif; ?>

	<div id="content-wrapper" class="page-pattern">
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
					<header>
						<h3 class="title large"><?php the_title(); ?></h3>						
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
								<p><a href="#">Show all Upcoming Events</a></p>
							</div>
						</article><!-- .history-snippet -->						
				</section><!--.inner-content  -->

		</div><!-- .container -->
	</div><!-- #content-wrapper -->

</div><!-- #history -->
<?php get_footer(); ?>