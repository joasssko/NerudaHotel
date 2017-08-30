<?php get_header()?>

<section id="slider">
	
</section>


<section id="hoteles">
	<div class="container">
		<div class="row">
			
			<?php $hoteles = get_posts(array('post_type' => 'hoteles'))?>
			
		</div>
	</div>
</section>

<?php get_footer()?>