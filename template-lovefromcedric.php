<?php 
/*
	Template Name: Love from Cedric
*/
?>
<?php get_header(); ?>

<div id="cedric">

	<header>
		<?php if(have_posts()): while(have_posts()): the_post(); ?>
			<div class="valign">
				<?php the_content(); ?>
			</div>
		<?php endwhile; endif; ?>
		<?php wp_reset_postdata(); ?>	
	</header><!-- header -->

	<div id="content-wrapper">
		<section class="inner">

			<div class="featured">
				<?php $featured = get_field('featured_offer'); ?>

				<?php foreach($featured as $post): ?>
				<?php setup_postdata( $post ); ?>
				<?php $featured_id = $post->post->ID; ?>
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full' ); ?>
				<?php $terms = get_the_terms( $post->ID, 'offer-category' ); ?>

					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?> ">
						<figure style="background-image: url(<?php echo $image[0] ?>)">
							<div class="meta pattern">
								<h2 class="title"><?php the_title(); ?></h2>
								<?php foreach ($terms as $term): ?>
									<p class="cat"><?php echo $term->name ?></p>
								<?php endforeach; ?>						
							</div>
						</figure>

					</a>

				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			</div><!-- .featured -->

			<div id="filters">
				<p>Filter Offers:</p>
				<?php $terms = get_terms('offer-category') ?>
				<?php foreach ($terms as $term): ?>
					<button data-filter=".<?php echo $term->term_id ?>" class="button primary"><?php echo $term->name ?></button>
				<?php endforeach; ?>
					<button data-filter="*" class="button primary">Show All</button>		
			</div><!-- #filters -->

			<div id="isotope">
				<div class="grid-sizer"></div>
				<?php $args = array (
						'post_type'              => 'love-from-cedric',
						'orderby'                => 'date',
						'post__not_in'			 =>  array($featured_id),
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
						<div class="item <?php the_field('item_size'); ?> <?php echo $term_id ?>">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?> ">
								<figure style="background-image: url(<?php echo $image[0] ?>)">
<!-- 									<div class="overlay">
										<p>View Offer</p>
									</div> -->
									
									<div class="meta pattern">
										<h2 class="title"><?php the_title(); ?></h2>
										<p class="cat"><?php echo $cat ?></p>
									</div>
								</figure>
							</a>
						</div><!-- .item -->

				<?php endwhile; endif; ?>
				<?php wp_reset_postdata(); ?>	
			</div><!-- #isotope -->

		</section><!-- .inner -->
	</div><!-- #content-wrapper -->
</div><!-- #cedric -->

<?php get_footer(); ?>