<?php get_header(); ?>

<div id="home">

	<?php  
		$video = '<div id="modal-video">';
		$video .= '<div class="valign">';
		$video .= '<video id="intro-video" class="video-js vjs-default-skin" autoplay preload="auto" width="100%" height="auto" data-setup="{}">';
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

			<li class="house19-slide">
				<div class="slide-content-wrapper">
					<div class="slide-content">
						<div class="inner">
							<span class="heading">
								Explore
							</span>
							<p class="slide-title">House No 19</p>
							<p>The ultimate sophisticated, yet relaxed entertaining space. This is the perfect place to enjoy sumptuous Brasserie style dining or long cocktail soirees, where spontaneous outbursts of revelry abound.</p>
							<a href="#" class="button primary invert small">See the House</a>							
						</div>
					</div>
				</div>
			</li>

			<li class="house20-slide">
				<div class="slide-content-wrapper">
					<div class="slide-content">
						<div class="inner">
							<span class="heading">
								Explore
							</span>
							<p class="slide-title">House No 20</p>
							<p>The sumptuous Drawing Rooms provide the ideal setting for a quintessentially British Afternoon Tea, a casual dinner or a decadent cocktail...</p>
							<a href="#" class="button primary invert small">See the House</a>							
						</div>
					</div>
				</div>
			</li>

			<li class="house21-slide">
				<div class="slide-content-wrapper">
					<div class="slide-content">
						<div class="inner">
							<span class="heading">
								Explore
							</span>
							<p class="slide-title">House No 21</p>
							<p>Where Georgian grandeur meets cutting edge design... creating a unique space that is perfect for work, rest or play...</p>
							<a href="#" class="button primary invert small">See the House</a>							
						</div>
					</div>
				</div>
			</li>

			<li class="restaurants-slide">
				<div class="slide-content-wrapper">
					<div class="slide-content">
						<div class="inner">
							<span class="heading">
								The
							</span>
							<p class="slide-title">Restaurants</p>
							<p>From British classics to Asian delights, there is a taste to suit every bud.</p>
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
							<p>The 20 luxurious rooms and suites are beautifully spacious and offer guests a warm and exclusive living space with the highest standards in comfort and technology...</p>
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
							<p>From the futuristic Zaha Hadid designed bar in House 21 to the classic Bison Bar, there are myriad opportunities to socialise and celebrate...</p>
							<a href="#" class="button primary invert small">See the Bars</a>							
						</div>
					</div>
				</div>
			</li>

		</ul>
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
							<div class="highlight">
								<h3 class="title">
									<?php the_title(); ?>
								</h3>
								<p>
									<a href="<?php the_permalink(); ?>" class="button primary small" title="Explore <?php the_title(); ?>">Explore</a>								
								</p>								
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
							<div class="highlight">
								<h3 class="title">
									<?php the_title(); ?>
								</h3>
								<p>
									<a href="<?php the_permalink(); ?>" class="button primary small" title="View <?php the_title(); ?>">View Event</a>
								</p>							
							</div>
						</div>
					</div>
				</div>
		<?php endif; ?>	
		<?php wp_reset_postdata(); ?>

				<div class="column col-1-3 pad expand">
					<div class="content pattern-img">
						<div class="valign">
							<h3 class="title">
								Upcoming Events
							</h3>
							<p>
								There is an abundance of events to suit all in June: screening both the World Cup & Wimbledon.
							</p>
							<p>
								<a href="<?php echo bloginfo('url'); ?>/events" class="button primary small" title="View Events Calendar">Full Events Calendar</a>
							</p>
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
							<div class="highlight">
								<h3 class="title">
									<?php the_title(); ?>
								</h3>
								<p>
									<a href="<?php the_permalink(); ?>" class="button primary small" title="Explore <?php the_title(); ?>">Explore</a>								
								</p>							
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
								<div class="highlight">
									<h2 class="title"><?php the_sub_field('title_text') ?></h2>
									<p>
										<a href="<?php the_permalink(); ?>" class="button primary small"><?php the_sub_field('button') ?></a>
									</p>									
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