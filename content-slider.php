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

			<div class="hero image" style="background-image:url(<?php echo $image['sizes']['slider']; ?>)">

				<div class="hero-content valign">
					<h2 class="title"><?php the_title(); ?></h2>
					<?php if(get_field('description')): ?>
						<div class="description"><?php the_field('description'); ?></div>
					<?php endif; ?>
				</div>

				<img src="<?php echo $image['sizes']['slider']; ?>">
			</div><!-- hero image -->

		<?php endforeach; ?>

	<?php endif; ?>
<?php endif; ?>