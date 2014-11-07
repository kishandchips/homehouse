<?php 
/*
	Template Name: Events
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="events" class="flex-page has-sidebar">
<?php else: ?>
	<div id="events" class="flex-page ">
<?php endif; ?>
<?php  
    $post_objects= get_field('featured_events');
	if($post_objects): ?>

	<section class="hero flexslider thumbnails">

		<ul class="slides">
			<?php foreach ($post_objects as $post): ?>
				<?php setup_postdata($post); ?>
				<?php $event_thumbnail_url = get_post_meta($post->ID, 'event_thumbnail_url', true); ?>
					<li style='background-image: url(<?php echo $event_thumbnail_url; ?>)'>
						<div class="hero-content valign">
							<h2 class="title"><?php the_title(); ?></h2>
							<br>
							<a href="<?php the_permalink(); ?>" class="button primary small">View Event</a>
						</div>
						<img src="<?php echo $event_thumbnail_url; ?>">
					</li>
			<?php endforeach; ?>
			<?php wp_reset_postdata(); ?>
		</ul>
	</section><!-- hero flexslider -->
	<?php endif; ?>

	<?php $current_month = date('m'); ?>
	<?php $next_month = date("m",strtotime("+30 days")); ?>
	<div id="content-wrapper">
		<div id="filters">
			<button class="button filter-heading js-toggle">
				Filter Events
				<i class='icon-arrow-down'></i>
			</button>

			<div class="filters-menu">
				<ul>
<!-- 					<li>
						<b class="filter-heading">Filter by House</b>
						<ul class="filter-list">
							<li><button class="button filter" data-filter="*">All</button></li>
							<li><button class="button filter" data-filter=".house-19">House No.19</button></li>
							<li><button class="button filter" data-filter=".house-20">House No.20</button></li>
							<li><button class="button filter" data-filter=".house-21">House No.21</button></li>
						</ul>
					</li> -->
					<li>
						<b class="filter-heading">Filter By Name</b>
						<ul class="filter-list">
							<li><button class="button sort" data-sort-by="name">Ascending</button></li>
							<li><button class="button sort-desc" data-sort-by="name">Descending</button></li>
						</ul>
					</li>
					<li>
						<b class="filter-heading">Filter by Month</b>
						<ul class="filter-list">
							<li><button class="button filter" data-filter="*">All</button></li>
							<li><button class="button filter" data-filter=".<?php echo $current_month; ?>">Current Month</button></li>
							<li><button class="button filter" data-filter=".<?php echo $next_month; ?>">Next Month</button></li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- #filters -->
		
		<div id="isotope" class="clearfix">
			<div class="grid-sizer"></div>
			<?php $args = array( 
				'post_type' => 'espresso_event',
				'posts_per_page' => 50,
				'meta_key' => 'event_start_date',
				'orderby' => 'meta_value', 
           		'order' => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'event_start_date',
						'compare' => '>=', 
						'value' => date('Y-m-d'),
						'type' => 'DATE'
					),
					array(
						'key' => 'event_end_date',
						'compare' => '<=', 
						'value' => date('Y-m-d',strtotime("+60 days")),
						'type' => 'DATE'
					),

				),
			); ?>

			<?php $loop = new WP_Query( $args ); ?>
			
			<?php while($loop->have_posts()): $loop->the_post(); ?>
				<?php $event_id = get_post_meta($post->ID, 'event_id', true); ?>
				<?php $event_date = do_shortcode('[EVENT_TIME event_id="'.$event_id.'" type="start_date" format="F j"]'); ?>
				<?php $filter_date = do_shortcode('[EVENT_TIME event_id="'.$event_id.'" type="start_date" format="m"]'); ?>
				<?php $catArray = get_the_terms($post,'category'); ?>

				<article id="event_data-<?php echo $event_id ?>" class="item event <?php echo $filter_date; ?> <?php foreach ($catArray as $cat): ?><?php echo $cat->slug; ?><?php endforeach; ?>">

					<div class="rect-items row">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<div class="column col-2-3 pad expand">
								<?php $event_thumbnail_url = get_post_meta($post->ID, 'event_thumbnail_url','thumbnail', true); ?>

								<div class="image b-lazy" data-src="<?php echo $event_thumbnail_url; ?>">
									<div class="valign">
<!-- 										<h3 id="event_title-<?php echo $event_id ?>" class="highlight large">
											<?php the_title(); ?>
										</h3> -->
										<div class="event-date highlight large">
											<?php echo $event_date ?>
										</div>
									</div>
								</div>
							</div>
							<div class="column col-1-3 pad expand">
								<div class="content pattern">
									<div class="event-desc valign">
										<h3 class="large title"><?php the_title(); ?></h3>
										<?php the_field('event_excerpt') ?>
										<div>
											<span class="button primary small">Read More</span>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>	
				</article><!-- .event -->
			<?php endwhile; ?>
		</div><!-- #isotope -->

	</div><!-- #content-wrapper -->
</div><!-- #events -->

<?php get_footer(); ?>