<?php 
/*
	Template Name: Love from Cedric
*/
?>
<?php get_header(); ?>

<div id="cedric" class="flex-page ">

	<section class="hero flexslider thumbnails">
		<ul class="slides">
			<?php $featured = get_field('featured_offer'); ?>

			<?php foreach($featured as $post): ?>
				<?php setup_postdata( $post ); ?>
				<?php $featured_id = $post->ID; ?>
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'slider' ); ?>
				<?php $terms = get_the_terms( $post->ID, 'offer-category' ); ?>

				<li class="slide" style="background-image: url(<?php echo $image[0] ?>)">
					<div class="slide-content-wrapper">
						<div class="slide-content">
							<div class="inner">
								<span class="heading">
									<?php foreach ($terms as $term): ?>
										<?php echo $term->name ?>
									<?php endforeach; ?>	
								</span>
								<p class="slide-title"><?php the_title(); ?></p>
								<div class="slide-description"><?php the_excerpt(); ?></div>
								<a href="<?php the_permalink(); ?>" class="button primary invert small">View Offer</a>							
							</div>
						</div>
					</div>
				</li>
			<?php endforeach; ?>
			<?php wp_reset_postdata(); ?>
		</ul>
		<div class="arrow-wrap"></div>
	</section><!-- hero flexslider -->

	<div id="content-wrapper">
		<section class="inner">

			<div id="filters">
				<button class="button filter-heading js-toggle">
					Filter Offers
					<i class='icon-arrow-down'></i>
				</button>

				<div class="filters-menu">
					<ul>
						<li>
							<b class="filter-heading">Filter by Type</b>
							<ul class="filter-list">
							<?php $terms = get_terms('offer-category') ?>
							<?php foreach ($terms as $term): ?>
							
							<li><button data-filter=".<?php echo $term->term_id ?>" class="button filter"><?php echo $term->name ?></button></li>
							
							<?php endforeach; ?>
							
							<li><button data-filter="*" class="button filter">Show All</button>	</li>
						</li>
					</ul>
				</div>
			</div><!-- #filters -->

			<div id="isotope">
				<div class="grid-sizer"></div>
				<?php $args = array (
						'posts_per_page'	=> 99,
						'post_type'              => 'love-from-cedric',
						'orderby'                => 'date',
						'post__not_in'			 =>  array($featured_id),
						'meta_query' => array(
							'relation' => 'OR',
							array(
								'key' => 'unpublish_date',
								'compare' => '=',
								'value' => '',
							 ),
							array(
								'key' => 'unpublish_date',
								'compare' => '>=',
								'value' => date('Y-m-d'),
								'type' => 'DATE'
							),
						),
					);
					$query = new WP_Query( $args ); 
				?>
				<?php if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full' ); ?>
					<?php $terms = get_the_terms( $post->ID, 'offer-category' ); ?>
					
					<?php foreach ($terms as $term): ?>
						<?php $term_id = $term->term_id; ?>
						<?php $cat = $term->name; ?>
					<?php endforeach; ?>

						<article class="item <?php the_field('item_size'); ?> <?php foreach($terms as $term){ echo $term->term_id." "; } ?>">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?> ">
								<figure style="background-image: url(<?php echo $image[0] ?>)">
									<div class="meta">
										<h2 class="title"><?php the_title(); ?></h2>
										<p class="cat"><?php echo $cat ?></p>
									</div>
								</figure>
							</a>
						</article><!-- .item -->

				<?php endwhile; endif; ?>
				<?php wp_reset_query(); ?>	
			</div><!-- #isotope -->

		</section><!-- .inner -->
	</div><!-- #content-wrapper -->
</div><!-- #cedric -->

<?php get_footer(); ?>