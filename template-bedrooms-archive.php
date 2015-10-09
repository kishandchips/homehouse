<?php 
/*
	Template Name: Bedrooms Archive
*/
?>
<?php get_header(); ?>

<?php if(is_page('my-membership') and !is_user_logged_in()): ?>
	<?php wp_redirect( home_url() . '/login/' ); ?>
<?php endif; ?>

<?php if(get_field('sidebar')): ?>
	<div id="page" class="flex-page has-sidebar page-pattern" <?php if(get_field('page_pattern')): ?> style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php else: ?>
	<div id="page" class="flex-page page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php endif; ?>

	<?php if(get_field('hero')): ?>
		
		<?php $images = get_field('slider_images'); ?>
		<?php if($images): ?>
			<?php if(count($images)>1): ?>

				<section class="hero flexslider thumbnails">
					
					<div class="hero-content valign">
						<h2 class="title"><?php the_title(); ?></h2>
					</div>

					<ul class="slides">
						<?php foreach ($images as $image): ?>
							<li style='background-image: url(<?php echo $image['sizes']['slider']; ?>)'>
								<img src="<?php echo $image['sizes']['slider']; ?>">
							</li>
						<?php endforeach; ?>
					</ul>
					
					<div class="arrow-wrap"></div>
				</section><!-- hero flexslider -->

			<?php else: ?>
				<?php foreach ($images as $image): ?>

					<div class="hero image">
						<div class="videoWrapper valign">
							<div id="ytplayer"></div>
						</div>

						<script>
						  var tag = document.createElement('script');
						  tag.src = "https://www.youtube.com/player_api";
						  var firstScriptTag = document.getElementsByTagName('script')[0];
						  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
						  var player;
						  function onYouTubePlayerAPIReady() {
						    player = new YT.Player('ytplayer', {
						      	height: '1280',
						      	width: '720',
						      	videoId: 'cVmSNn419Tc',
							    playerVars: { 'autoplay': 1, 'controls': 0 , 'rel' : 0, 'showinfo' : 0, 'modestbranding' : 1},
								events: {
									'onReady': onPlayerReady,
									'onStateChange': onStateChange
								}							    				      
						    });
						  }

							function onPlayerReady(event) {
							  event.target.setVolume(100);
							  event.target.playVideo();
							}						  

							function onStateChange(event) {
							    var id = 'cVmSNn419Tc';

							    if(event.data === YT.PlayerState.ENDED){
							        player.loadVideoById(id);
							    }
							}						  
						</script>					
					</div><!-- hero image -->

				<?php endforeach; ?>

			<?php endif; ?>
		<?php endif; ?>

	<?php endif; ?>
	
	<div id="content-wrapper">	

	<?php if(get_field('display_grid')): ?>

	<div class="flow">
		<section class="rect-items grid-flow row">

		<?php 
			$grid_items = get_field('grid_items'); 
			$widget_count = count( $grid_items ); 
			$prologue = get_field('prologue');
			$epilogue = get_field('epilogue');
			$i = 1;
			//$array = array(1,4);
		?>

<!-- 		<?php if($prologue): ?>
			<div class="column col-1-3 pad prologue equal-height">
				<div class="inner">
					<p><?php echo $prologue; ?></p>
				</div>
			</div>
		<?php endif; ?>

 -->		<?php if(have_rows('grid_items')): while(have_rows('grid_items')): the_row(); ?>

			
			<div class="column pad <?php if (in_array($i, $array)){echo 'col-2-3 equal-height';} else {echo 'col-1-2';} ?> ">		


				<?php if(get_sub_field('display_background')): ?>
					<?php 
						$image = get_sub_field('grid_image'); 
						$image = $image['url'];
						$image_size = array('width' => 1056, 'height' => 500);
						$image = bfi_thumb($image, $image_size);
					?>
					<div class="image"  style="background-image:url(<?php echo $image; ?>)">
				<?php else: ?>
					<div class="image pattern">
				<?php endif; ?>

					<div class="valign">
						<span class="highlight large">
							<?php the_sub_field('grid_content') ?>
							<?php $buttons = get_sub_field('buttons'); ?>
							<?php foreach ($buttons as $button):?>
								<?php
										$url = $button['button_link'];
										$text = (!empty($button['button_text'])) ? $button['button_text'] : null;
										$style =  (!empty($button['button_style'])) ? $button['button_style'] : null;
								?>
								<a href="<?php echo $url['url']; ?>" class="button small secondary"><?php echo $text ?></a>
							<?php endforeach; ?>
						</span>
					</div>

				</div><!-- .image -->
			</div>
			<?php $i++; ?>
		<?php endwhile; endif; ?>

<!-- 		<?php if($epilogue): ?>
			<div class="column col-1-3 pad epilogue equal-height">
				<div class="inner">
					<p><?php echo $epilogue; ?></p>
				</div>
			</div>
		<?php endif; ?>		
 -->
		</section><!--  .grid-flow -->
	</div><!-- .flow -->

	<?php endif; ?>		


	</div><!-- #content-wrapper -->
</div><!-- #page -->

<?php get_footer(); ?>