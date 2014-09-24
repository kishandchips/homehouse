<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="page" class="has-sidebar">
<?php else: ?>
	<div id="page">
<?php endif; ?>

		<?php if(get_field('hero')): ?>
			
			<?php $images = get_field('slider_images'); ?>
			<?php if($images): ?>
				<?php if(count($images)>1): ?>

					<section class="hero flexslider thumbnails">
						
						<div class="hero-content">
							<h2 class="title thin"><?php the_title(); ?></h2>
						</div>

						<ul class="slides">
							<?php foreach ($images as $image): ?>
								<li style='background-image: url(<?php echo $image['url']; ?>)'>
									<img src="<?php echo $image['url']; ?>">
								</li>
							<?php endforeach; ?>
						</ul>
					</section><!-- hero flexslider -->

				<?php else: ?>
					<?php foreach ($images as $image): ?>

						<div class="hero image" style="background-image:url(<?php echo $image['url']; ?>)">
	
							<div class="hero-content">
								<h2 class="title thin"><?php the_title(); ?></h2>
							</div>

							<img src="<?php echo $image['url']; ?>">
						</div><!-- hero image -->

					<?php endforeach; ?>

				<?php endif; ?>
			<?php endif; ?>

		<?php endif; ?>

		<div id="content-wrapper">	
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

		<?php if(get_field('display_grid')): ?>
			<div class="flow">
				<section class="rect-items grid-flow row">

				<?php $grid_items = get_field('grid_items'); ?>
				<?php $widget_count = count( $grid_items ); ?>

				<?php if(have_rows('grid_items')): while(have_rows('grid_items')): the_row(); ?>

					<?php switch ($widget_count){
							case 1:
							echo '<div class="column col-full pad">';
							break;
							case 2:
							echo '<div class="column col-1-2 pad">';
							break;
							case 3:
							echo '<div class="column col-1-3 pad">';
							break;
							case 4:
							echo '<div class="column col-1-2 pad">';
							break;
					}?>
					
					<?php if(get_field('display_background')): ?>
						<?php $image = get_sub_field('grid_image'); ?>
						<div class="image"  style="background-image:url(<?php echo $image['url']; ?>)">
					<?php else: ?>
						<div class="image pattern">
					<?php endif; ?>
							<div class="valign">
								<?php the_sub_field('grid_content') ?>
								<div class="buttons">
									<?php $buttons = get_sub_field('buttons'); ?>
									<?php foreach ($buttons as $button):?>
										<?php $post_object = $button['button_link'] ?>
										<?php $post = $post_object; ?>
										<?php setup_postdata( $post ); ?>
										<?php 	$url = get_the_permalink();
												$text = (!empty($button['button_text'])) ? $button['button_text'] : null;
												$style =  (!empty($button['button_style'])) ? $button['button_style'] : null;
										?>
										<a href="<?php echo $url ?>" class="button small <?php echo $style?>"><?php echo $text ?></a>
										<?php wp_reset_postdata(); ?>
									<?php endforeach; ?>
								</div>
							</div>
						</div><!-- .rect -->
				</div><!-- .column -->
				<?php endwhile; endif; ?>
				</section><!--  .grid-flow -->
			</div><!-- .flow -->
		<?php endif; ?>	
		
		</div><!-- #content-wrapper -->


	</div><!-- #page -->

<?php get_footer(); ?>