<?php 
/*
	Template Name: Calendar
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="calendar" class="has-sidebar">
<?php else: ?>
	<div id="calendar">
<?php endif; ?>

	<div id="content-wrapper" class="page-pattern-white">
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
				<section class="grid-flow row">

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
						<div class="rect bg"  style="background-image:url(<?php echo $image['url']; ?>)">
					<?php else: ?>
						<div class="rect pattern">
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