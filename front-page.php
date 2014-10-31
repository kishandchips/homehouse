<?php get_header(); ?>

<div id="home" class="flex-page">

	<?php  
		$video = '<div id="modal-video">';
		$video .= '<div class="valign">';
		$video .= '<video id="intro-video" class="video-js vjs-default-skin" controls preload="auto" width="100%" height="auto" data-setup="{"nativeControlsForTouch": false}">';
		$video .= '<source src="' . get_template_directory_uri() . '/video/homehouse-intro.mp4" type="video/mp4">';
		$video .= '<source src="' . get_template_directory_uri() . '/video/homehouse-intro.ogv" type="video/ogg">';
		$video .= '<source src="' . get_template_directory_uri() . '/video/homehouse-intro-animation.swf" type="video/swf">';
		$video .= '<source src="' . get_template_directory_uri() . '/video/homehouse-intro-animation.webm" type="video/webm">';
		$video .= '</video>';
		$video .= '<p>';
		$video .= '<button class="button primary small">Skip Intro</button>';
		$video .= '</p>';
		$video .= '</div>';
		$video .= '</div>';

		if(!isset($_COOKIE['HomehouseVisit'])) {
			echo $video;
		}
	?>

	<section class="hero flexslider">
		<ul class="slides">
			
			<?php if(have_rows('slides')): while(have_rows('slides')): the_row(); ?>
				<li class="slide" style="background-image:url(<?php the_sub_field('slide_image'); ?>)">
					<div class="slide-content-wrapper">
						<div class="slide-content" style="background-image:url(<?php the_sub_field('slide_pattern'); ?>)">
							<div class="inner">
								<span class="heading">
									<?php the_sub_field('slide_heading') ?>
								</span>
								<p class="slide-title"><?php the_sub_field('slide_title'); ?></p>
								<div class="slide-description"><?php the_sub_field('slide_description'); ?></div>
								<a href="<?php the_sub_field('slide_link'); ?>" class="button primary invert small"><?php the_sub_field('slide_link_text') ?></a>							
							</div>
						</div>
					</div>
				</li>

			<?php endwhile; endif;?>

			<li class="restaurants-slide">
				<div class="slide-content-wrapper">
					<div class="slide-content">
						<div class="inner">
							<span class="heading">
								The
							</span>
							<p class="slide-title">Restaurants</p>
							<p class="slide-description">From British classics to Asian delights, there is a taste to suit every bud.</p>
							<a href="#" class="button primary invert small">See the Restaurants</a>							
						</div>
					</div>
				</div>
			</li>

			<li class="bedrooms-slide">
				<div class="slide-content-wrapper">
					<div class="slide-content">
						<div class="inner">
							<span class="heading">
								The
							</span>
							<p class="slide-title">Bedrooms</p>
							<p class="slide-description">The 20 luxurious rooms and suites are beautifully spacious and offer guests a warm and exclusive living space with the highest standards in comfort and technology...</p>
							<a href="#" class="button primary invert small">See the Bedrooms</a>							
						</div>
					</div>
				</div>
			</li>

			<li class="bars-slide">
				<div class="slide-content-wrapper">
					<div class="slide-content">
						<div class="inner">
							<span class="heading">
								The
							</span>
							<p class="slide-title">Bars</p>
							<p class="slide-description">From the futuristic Zaha Hadid designed bar in House 21 to the classic Bison Bar, there are myriad opportunities to socialise and celebrate...</p>
							<a href="#" class="button primary invert small">See the Bars</a>							
						</div>
					</div>
				</div>
			</li>

		</ul>

		<div class="arrow-wrap"></div>
	</section><!-- HERO SLIDER -->

	<div id="content-wrapper">
		<div class="flow">
			<div class="houses grid-flow row">
			<?php $posts = get_field('house_pages'); ?>
			<?php if($posts): ?>
				<?php foreach ($posts as $post): ?>
					<?php setup_postdata($post); ?>
				<div class="column col-1-3 pad">
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'grid-square' ); ?>
					<div class="square bg" style="background-image:url(<?php echo $image[0]; ?>)">
						<div class="valign">
							<h3 class="highlight large">
								<?php the_title(); ?>
							</h3>
							<div>
								<a href="<?php the_permalink(); ?>" class="button primary small" title="Explore <?php the_title(); ?>">Explore</a>								
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; endif; ?>
				<?php wp_reset_postdata(); ?>
			</div><!-- .houses -->			
		</div><!-- .flow -->

		<?php  
		    $post_object= get_field('featured_event');
			if($post_object):
				$post = $post_object;
				setup_postdata( $post );
		?>
		<?php $event_thumbnail_url = get_post_meta($post->ID, 'event_thumbnail_url', true); ?>

		<div class="events">
			<div class="rect-items row">
				<div class="column col-2-3 pad expand">
					<div class="image" style="background-image:url(<?php echo $event_thumbnail_url; ?>)">
						<div class="valign">
							<h3 class="highlight large">
								<?php the_title(); ?>
							</h3>
							<div>
								<a href="<?php the_permalink(); ?>" class="button primary small" title="View <?php the_title(); ?>">View Event</a>
							</div>							
						</div>
					</div>
				</div>
		<?php endif; ?>	
		<?php wp_reset_postdata(); ?>

				<div class="column col-1-3 pad expand">
					<div class="content pattern-img">
						<div class="valign">
							<h3 class="title large">
								Upcoming Events
							</h3>
							<p class="small">
								There is an abundance of events to suit all in June: screening both the World Cup & Wimbledon.
							</p>
							<div>
								<a href="<?php echo bloginfo('url'); ?>/events" class="button primary small" title="View Events Calendar">View Events</a>
							</div>
						</div>
					</div>
				</div>
			</div><!-- .row -->
		</div><!-- .events -->

		<div class="flow">
			<div class="restaurants rect-items grid-flow row">
			<?php $posts = get_field('restaurant_pages'); ?>
			<?php if($posts): ?>
				<?php foreach ($posts as $post): ?>
				<?php setup_postdata($post); ?>
				<?php if(count($posts)== 2): ?>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'grid-rect-med' ); ?>
					<div class="column col-1-2 pad">
					<div class="image" style="background-image:url(<?php echo $image[0]; ?>)">

				<?php else : ?>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'grid-square' ); ?>
					<div class="column col-1-3 pad">
					<div class="square bg" style="background-image:url(<?php echo $image[0]; ?>)">

				<?php endif; ?>
					
						<div class="valign">
							<h3 class="highlight large">
								<?php the_title(); ?>
							</h3>
							<div>
								<a href="<?php the_permalink(); ?>" class="button primary small" title="Explore <?php the_title(); ?>">Explore</a>								
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; endif; ?>
				<?php wp_reset_postdata(); ?>
			</div><!-- restaurants -->
		</div><!-- .flow -->

		<?php if( have_rows('row_content') ): ?>
			<?php while(has_sub_field('row_content')): ?>

				<div class="rect-items <?php the_sub_field('class'); ?> row">
					<div class="column col-2-3 pad expand <?php the_sub_field('alignment'); ?>">

					<?php $posts = get_sub_field('page'); ?>
					<?php foreach ($posts as $post): setup_postdata( $post );?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'grid-rect-med' ); ?>

						<div class="image" style="background-image:url(<?php echo $image[0]; ?>)">
							<div class="valign">
								<h3 class="highlight large">
									<?php the_sub_field('title_text') ?>
								</h3>
								<div>
									<a href="<?php the_permalink(); ?>" class="button primary small"><?php the_sub_field('button') ?></a>
								</div>
							</div>
						</div>

					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>

					</div>

					<div class="column col-1-3 expand pad">
						<div class="content pattern-img">
							<div class="valign">
								<?php the_sub_field('box_content'); ?>				
							</div>
						</div>
					</div>

				</div><!-- members -->

			<?php endwhile; ?>
		<?php endif; ?>

	</div><!-- #content-wrapper -->
</div><!-- #home -->

<?php get_footer(); ?>