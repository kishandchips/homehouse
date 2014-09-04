
</div><!-- #kanye-west -->

<footer id="footer" class="white">
	<div class="certificates">
		<ul>
			<li><img src="<?php bloginfo("stylesheet_directory"); ?>/img/securedownload.gif" alt=""></li>
			<li><img src="<?php bloginfo("stylesheet_directory"); ?>/img/logo-coolbrands.jpg" alt=""></li>
			<li><img src="<?php bloginfo("stylesheet_directory"); ?>/img/logo-baker-street-quarter.jpg" alt=""></li>
			<li><img src="<?php bloginfo("stylesheet_directory"); ?>/img/logo-the-audit-people.jpg" alt=""></li>
			<li><img src="<?php bloginfo("stylesheet_directory"); ?>/img/logo-verisign.jpg" alt=""></li>
			<li><img src="<?php bloginfo("stylesheet_directory"); ?>/img/logo-ejaf.png" alt=""></li>
		</ul>
	</div>

	<div class="sitemap pattern clearfix">
		<div class="left">
			<div class="logo">
			 <a href="<?php echo bloginfo('url'); ?> " title="Homehouse">
				<img src="<?php bloginfo("stylesheet_directory"); ?>/img/logo-footer.png" alt="">
			</a>
				
			</div>
<!-- 			<div class="contact-details">
				<div class="detail left">
					<p>20 Portman Square,</p>
					<p>London,</p>
					<p>W1H 6LW</p>
				</div>
				<div class="detail left">
					<p>Tel: 020 7670 2000</p>
					<p>Fax: 020 7670 2020</p>
				</div>			
			</div>	 -->	
		</div>

		<div class="right">
			<nav>
	            <?php 
	                $args = array(
	                    'theme_location' => 'footer_nav',
	                    'menu' => '',
	                    'container' => '',
	                );

	                wp_nav_menu( $args ); 
	            ?>
				<ul class="social">
					<li><a href="#" class="icon"><i class="icon-facebook"></i></a></li>
					<li><a href="#" class="icon"><i class="icon-twitter"></i></a></li>
				</ul>
			</nav>			
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>