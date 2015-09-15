<div class="share">
	<span>Share</span>
	<ul class="social-icons">
		<li>
			<a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="Share on Facebook" target="_blank">
				<i class="icon-facebook"></i>
			</a>							
		</li>
		<li>
			<a href="http://twitter.com/share?text=<?php the_title(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="Share on Twitter" target="_blank">
				<i class="icon-twitter"></i>
			</a>
		</li>
		<li>
			<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="Share on google Plus" target="_blank">
				<i class="icon-googleplus"></i>
			</a>
		</li>
		<li>
			<a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site <?php the_permalink(); ?>"
			   title="Share by Email">
		  		<i class="icon-mail"></i>
			</a>			
		</li>
	</ul>
</div>
