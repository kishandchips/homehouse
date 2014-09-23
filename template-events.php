<?php 
/*
	Template Name: Events
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="events" class="has-sidebar">
<?php else: ?>
	<div id="events">
<?php endif; ?>

	<div id="content-wrapper">
		<div id="filters">
			<button class="button filter-heading js-toggle">
				Filter Events
				<i class='icon-arrow-down'></i>
			</button>

			<div class="filters-menu">
				<ul>
					<li>
						<b class="filter-heading">Filter by House</b>
						<ul class="filter-list">
							<li><button class="button filter" data-filter="*">All</button></li>
							<li><button class="button filter" data-filter=".house-19">House No.19</button></li>
							<li><button class="button filter" data-filter=".house-20">House No.20</button></li>
							<li><button class="button filter" data-filter=".house-21">House No.21</button></li>
						</ul>
					</li>
					<li>
						<b class="filter-heading">Filter A-Z</b>
						<ul class="filter-list">
							<li><button class="button sort" data-sort-by="name">Ascending</button></li>
							<li><button class="button sort-desc" data-sort-by="name">Descending</button></li>
						</ul>
					</li>
					<li>
						<b class="filter-heading">Filter by Date</b>
						<ul class="filter-list">
							<li><button class="button sort" data-sort-by="date">Ascending</button></li>
							<li><button class="button sort-desc" data-sort-by="date">Descending</button></li>
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
				'meta_query' => array(
					array(
						'key' => 'event_start_date',
						'value' => date('Y-m-d'),
						'compare' => '>=', // compares the event_start_date against today's date so we only display events that haven't happened yet
						'type' => 'DATE'
					)
				),
			); ?>

			<?php $loop = new WP_Query( $args ); ?>
			
			<?php while($loop->have_posts()): $loop->the_post(); ?>
				<?php $event_id = get_post_meta($post->ID, 'event_id', true); ?>

				<?php $catArray = get_the_terms($post,'category'); ?>
				<pre>
					
				</pre>

				<article id="event_data-<?php echo $event_id ?>" class="item event <?php foreach ($catArray as $cat): ?><?php echo $cat->slug; ?><?php endforeach; ?>" data-date="<?php the_time("ymdHis"); ?>">

					<div class="row">
						<div class="column col-2-3 pad expand">
							<?php $event_thumbnail_url = get_post_meta($post->ID, 'event_thumbnail_url', true); ?>

							<div class="rect bg" style="background-image:url(<?php echo $event_thumbnail_url; ?>)">
								<div class="valign">
									<h3 id="event_title-<?php echo $event_id ?>" class="title large">
										<?php the_title(); ?>
									</h3>
									<p>
										<a href="<?php the_permalink(); ?>"  class="button primary small">View Event</a>								
									</p>							
								</div>
							</div>
						</div>
						<div class="column col-1-3 pad expand">
							<div class="square pattern">
								<div class="event-desc valign">
									<?php the_excerpt(); ?>
									<p>
										<a href="<?php the_permalink(); ?>" class="button primary small">Read More</a>
									</p>
								</div>
							</div>
						</div>
					</div>		
				</article><!-- .event -->
			<?php endwhile; ?>
		</div><!-- #isotope -->

	</div><!-- #content-wrapper -->
</div><!-- #events -->
<?php get_footer(); ?>