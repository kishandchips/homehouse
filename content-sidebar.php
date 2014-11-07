<div class="sidebar column">

	<?php $parent = array_reverse(get_post_ancestors($post->ID)); ?>
	<?php if(count($parent)): ?>	
		<?php $first_parent = get_page($parent[0]); ?>
		<h3 class="sidenav-title"><a href="<?php echo $first_parent->guid; ?>"><?php echo $first_parent->post_title; ?></a></h3>
	<?php else: ?>
		<h3 class="sidenav-title"><a href="<?php get_page_link($post->ID );; ?>"><?php the_title(); ?></a></h3>
	<?php endif; ?>

	<?php get_sidebar(); ?>
</div><!-- sidenav -->

<section class="inner-content column">
	<div class="mob-bar">
		<button aria-role="Mobile Sidebar Button" class="mob-button">
            <i class="icon-menu"></i>
            <span>Side Menu</span>
        </button>						
	</div>