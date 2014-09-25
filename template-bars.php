<?php 
/*
	Template Name: Bars
*/
?>
<?php get_header(); ?>
	<div id="page">

		<?php if(get_field('display_grid')): ?>
			<div class="flow">
				<section class="rect-items grid-flow row">
				<?php global $post; ?>

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
					
					<?php if(get_sub_field('display_background')): ?>
						<?php $image = get_sub_field('grid_image'); ?>
						<div class="image"  style="background-image:url(<?php echo $image['sizes']['grid-rect-med']; ?>)">
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

	</div><!-- #page -->

<?php get_footer(); ?>