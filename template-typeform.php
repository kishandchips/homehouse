<?php 
/*
	Template Name: Membership Typeform
*/
?>
<?php get_header(); ?>

<div id="page">

	<?php $images = get_field('slider_images'); ?>
	<?php if($images): ?>
		<?php if(count($images)>1): ?>

			<section class="hero flexslider thumbnails">
				<ul class="slides">
					<?php foreach ($images as $image): ?>
						<li style="background-image:url(<?php echo $image['url']; ?>)">
						</li>
					<?php endforeach; ?>
				</ul>
			</section><!-- hero flexslider -->

		<?php else: ?>
			<?php foreach ($images as $image): ?>

				<div class="hero image" style="background-image:url(<?php echo $image['url']; ?>)">
				</div><!-- hero image -->

			<?php endforeach; ?>
		<?php endif; ?>
	<?php endif; ?>

	<div id="content-wrapper" class="page-pattern">
		<section class="container">
				<?php if(get_field('sidebar')): ?>
					<div class="sidebar column col-1-5">
		 				<?php
							$parent = array_reverse(get_post_ancestors($post->ID));
							$first_parent = get_page($parent[0]);
						?>
						<h3 class="sidenav-title"><a href="<?php echo $first_parent->guid; ?>"><?php echo $first_parent->post_title; ?></a></h3>
						<?php get_sidebar(); ?>
					</div><!-- sidenav -->
				<?php endif; ?>
				<div class="inner-content column col-4-5">
					<div class="typeform">
						<!-- Change the width and height values to suit you best -->
						<div class="typeform-widget" data-url="https://spylefkaditis.typeform.com/to/oBn93J" data-text="HomeHouse Membership" style="width:100%;height:500px;"></div>
						<script>(function(){var qs,js,q,s,d=document,gi=d.getElementById,ce=d.createElement,gt=d.getElementsByTagName,id='typef_orm',b='https://s3-eu-west-1.amazonaws.com/share.typeform.com/';if(!gi.call(d,id)){js=ce.call(d,'script');js.id=id;js.src=b+'widget.js';q=gt.call(d,'script')[0];q.parentNode.insertBefore(js,q)}})()
						</script>
					</div>
				</div>	
		</section><!-- .container-->
	</div><!-- #content-wrapper -->
</div><!-- #page -->

<?php get_footer(); ?>