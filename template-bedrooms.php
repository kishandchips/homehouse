<?php 
/*
	Template Name: Bedrooms
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="bedrooms" class="has-sidebar">
<?php else: ?>
	<div id="bedrooms">
<?php endif; ?>

	<div id="content-wrapper" class="page-pattern">
			<div class="container">

				<?php if(get_field('sidebar')): ?>
					<div class="sidebar column col-1-5">

		 				<?php $parent = array_reverse(get_post_ancestors($post->ID)); ?>
						<?php if(count($parent)): ?>	
							<?php $first_parent = get_page($parent[0]); ?>
							<h3 class="sidenav-title"><a href="<?php echo $first_parent->guid; ?>"><?php echo $first_parent->post_title; ?></a></h3>
						<?php else: ?>
							<h3 class="sidenav-title"><a href="<?php get_page_link($post->ID );; ?>"><?php the_title(); ?></a></h3>
						<?php endif; ?>

						<?php get_sidebar(); ?>
					</div><!-- sidenav -->
				

					<section class="inner-content column col-4-5">
					    <button aria-role="Mobile Sidebar Button" class="mob-button">
		                    <i class="icon-menu"></i>
		                    <span>Sidebar</span>
		                </button>
	            <?php else: ?>

	            	<section class="inner-content">
	            <?php endif; ?>
	            
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

		<?php $pages = get_pages( array('sort_column'=>'menu_order','child_of'=>$post->ID) ); ?>
		<?php foreach ($pages as $post ): ?>

		<div class="bedroom">
			<div class="rect-items row">
			
				<div class="column col-2-3 pad expand">
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'slider' ); ?>
					<div class="image" style="background-image:url(<?php echo $image[0] ?>)">
					</div>
				</div>
				<div class="column col-1-3 pad expand">
					<div class="content pattern">
						<div class="valign">
							<h3 class="title">
								<?php echo get_the_title($post->ID); ?>
							</h3>
							<p>
								<a href="<?php echo get_the_permalink($post->ID); ?>" class="button primary small">View Room</a>
							</p>							
						</div>
					</div>
				</div>

			</div>
		</div><!-- .bedroom -->

		<?php endforeach; ?>
		
	</div><!-- #content-wrapper -->
</div><!-- #bedrooms -->

<?php get_footer(); ?>