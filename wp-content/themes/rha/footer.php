<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rha
 */

?>

<footer id="colophon" class="site-footer">

	<div class="contact-info">
		<p class="title">
			<?= get_field('footer_title', 'option') ?>
		</p>

		<div class="links">
		<?php if (have_rows('contact', 'option')) : ?>
			<?php while (have_rows('contact', 'option')) : the_row();
				$image = get_sub_field('icon');
				$link = get_sub_field('link');
			?>

				<?php

				if ($link) :
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
				?>
					<a class="link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
						<img src="<?= $image; ?>" alt="">
						<?php echo esc_html($link_title); ?>
					</a>
				<?php endif; ?>

			<?php endwhile; ?>
		<?php endif; ?>
		</div>
		

		<?php $pdf = get_field('pdf', 'option') ?>
	</div><!-- .contact-info -->

	<?php if ($pdf) : ?>
		<a class="pdf" href="<?= $pdf['file']['url']; ?>" target="_blank">
			<span class="pdf-title">
				<?= $pdf['text']; ?>
			</span>
			<img src="<?= $pdf['icon']['url']; ?>" alt="">
		</a>
	<?php endif; ?>



</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>