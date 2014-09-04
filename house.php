<?php 
/*
	Template Name: House-Single
*/
?>
<?php get_header(); ?>

<div id="house-single">

	<?php $images = get_field('slider_images'); ?>
	<?php if($images): ?>
		<?php if(count($images)>1): ?>

			<section class="hero flexslider thumbnails">
				<ul class="slides">
					<?php foreach ($images as $image): ?>
						<li style="background-image:url(<?php echo $image['url']; ?>)">
						</li>
					<?php endforeach; ?>
				</ul>
			</section><!-- hero flexslider -->

		<?php else: ?>
			<?php foreach ($images as $image): ?>

				<div class="hero image" style="background-image:url(<?php echo $image['url']; ?>)">
				</div><!-- hero image -->

			<?php endforeach; ?>
		<?php endif; ?>
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
			    <button aria-role="Mobile Sidebar Button" class="mob-button">
                    <i class="icon-menu"></i>
                    <span>Sidebar</span>
                </button>

				<header>
					<h3 class="title large"><?php the_title(); ?></h3>						
				</header>

				<?php if(have_posts()): while(have_posts()): the_post(); ?>
				<div class="body">
					<?php the_content(); ?>
				</div>
				<?php endwhile; endif; ?>						
			</section><!-- .inner-content -->

		</div><!-- .container -->

		<div class="flow">
			<section class="grid-flow row">
				<div class="column col-1-3 pad">
					<div class="rect pattern">
						<div class="valign">
							<h3 class="title">Events at house No 19</h3>
							<p>There is an abundance of events to suit all in June: screening both the World Cup and Wimbledon.</p>
							<p><a href="#" class="button primary small">Full events calendar</a></p>
						</div>
					</div>
				</div>
				<div class="column col-1-3 pad">
					<div class="rect bg" style="background-image:url(<?php bloginfo("stylesheet_directory"); ?>/img/events2.jpg)">
						<div class="valign">
							<h3 class="title">Write and deliver the perfect speech</h3>
							<p><a href="#" class="button primary small">View Event</a></p>
						</div>
					</div>
				</div>
				<div class="column col-1-3 pad">
					<div class="rect bg" style="background-image:url(<?php bloginfo("stylesheet_directory"); ?>/img/events3.jpg)">
						<div class="valign">
							<h3 class="title">The unspoken rules of dating</h3>
							<p><a href="#" class="button primary small">View Event</a></p>
						</div>
					</div>
				</div>		
			</section>		
		</div><!-- flow -->	

	</div><!-- #content-wrapper -->
</div><!-- #house-single -->

<?php get_footer(); ?>