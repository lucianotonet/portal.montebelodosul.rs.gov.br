<div class="jumbotron  jumbotron--slider  js-jumbotron-slider">

	<?php get_template_part('theme-slider');?>

	<div class="container">
		<div class="row">
				<div class="header-padding">

							<?php
$slider = new WP_Query(array(
	'post_type' => 'slider',
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'nopaging' => true,
));
$i = -1;
while ($slider->have_posts()):
	$slider->the_post();
	$i++;
	?>
																					<div class="hidden-slide text-center js--slide-text-<?php echo $i;
	echo 0 === $i ? '  shown' : ''; ?>">
																						<h3 class="jumbotron-title"><?php echo the_title(); ?></h3>
																						<?php if (strlen(get_the_content()) > 0): ?>
																						<div class="jumbotron-text">
																							<?php the_content();?>
																						</div>
																						<?php endif?>
									</div>
									<?php
endwhile;
wp_reset_postdata();
?>

							</div>
			<div class="span9">
			</div>
			<div class="span3">
				<?php dynamic_sidebar('above-slider');?>
			</div>
		</div>

	</div>
</div>