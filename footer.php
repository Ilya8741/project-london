<?php

/**
 * The template for displaying the footer
 * @package project-london
 */
?>


<footer id="colophon" class="site-footer" data-theme="dark">
	<div class="site-footer-wrapper">
		<div class="site-footer-header">
			<?php if ($title = get_field('header_title', 'footer_options')) : ?>
				<h2 class="footer-title"><?php echo esc_html($title); ?></h2>
			<?php endif; ?>

			<?php if ($image = get_field('footer_image', 'footer_options')) : ?>
				<?php
				echo wp_get_attachment_image(
					$image['ID'],
					'full',
					false,
					[
						'class' => 'footer-main-image',
						'alt'   => esc_attr($image['alt'] ?? ''),
					]
				);
				?>
			<?php endif; ?>
		</div>

		<div class="footer-buttons">
			<?php
			$work_text = get_field('work_button_text', 'footer_options');
			$work_url  = get_field('work_button_url',  'footer_options');
			if ($work_text) : ?>
				<a href="<?php echo esc_url($work_url); ?>" class="footer-white-main-button main-button">
					<span><?php echo esc_html($work_text); ?></span>
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
						<path d="M1 1H13V13" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round"/>
						<path d="M1 13L13 1" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round"/>
					</svg>
				</a>
			<?php endif; ?>

			<?php
			$sub_text = get_field('subscribe_button_text', 'footer_options');
			$sub_url  = get_field('subscribe_button_url',  'footer_options');
			if ($sub_text) : ?>
				<a href="<?php echo esc_url($sub_url); ?>" class="footer-black-main-button main-button">
					<span><?php echo esc_html($sub_text); ?></span>
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
						<path d="M1 1H13V13" stroke="white" stroke-width="0.5" stroke-linejoin="round"/>
						<path d="M1 13L13 1" stroke="white" stroke-width="0.5" stroke-linejoin="round"/>
					</svg>
				</a>
			<?php endif; ?>
		</div>
		<div class="footer-info">
			<div class="footer-info-richtext">
				<?php if ($html = get_field('footer_info', 'footer_options')) : ?>
					<div class="footer-wysiwyg">
						<?php echo wp_kses_post($html); ?>
					</div>
				<?php endif; ?>

		<?php if ( have_rows('footer_social_icons', 'footer_options') ) : ?>
			<div class="footer-socials">
				<?php while ( have_rows('footer_social_icons', 'footer_options') ) : the_row(); 
				$img = get_sub_field('icon');        
				$url = (string) get_sub_field('icon_url');
				if ( empty($img) || empty($img['ID']) ) continue;

				$img_html = wp_get_attachment_image(
					$img['ID'],
					'full',
					false,
					[
					'class' => 'footer-socials__icon',
					'alt'   => esc_attr($img['alt'] ?? ''),
					]
				);
				?>
				<div class="footer-socials__item">
					<?php if ( $url !== '' ) : ?>
					<a class="footer-socials__link"
						href="<?php echo esc_url($url); ?>"
						target="_blank" rel="noopener nofollow"
						aria-label="social link">
						<?php echo $img_html; ?>
					</a>
					<?php else : ?>
					<?php echo $img_html; ?>
					<?php endif; ?>
				</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
		</div>
		<?php if ( have_rows('footer_menu', 'footer_options') ) : ?>
			<div class="footer-menu">
				<?php while ( have_rows('footer_menu', 'footer_options') ) : the_row();
				$link = get_sub_field('footer_link');         
				$text = trim((string) get_sub_field('footer_link_text'));
				if ( empty($link) || empty($link['url']) ) continue;

				$label  = $text !== '' ? $text : ($link['title'] ?? '');
				$target = !empty($link['target']) ? ' target="_blank" rel="noopener"' : '';
				?>
				
					<a class="footer-menu__link" href="<?php echo esc_url($link['url']); ?>"<?php echo $target; ?>>
					<?php echo esc_html($label); ?>
					</a>
				
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
		</div>

		<?php if (have_rows('copyright_menu', 'footer_options')) : ?>
			<div class="footer-copyright">
				<?php while (have_rows('copyright_menu', 'footer_options')) : the_row();
					$text = trim((string) get_sub_field('link_text'));
					$url  = trim((string) get_sub_field('link_url'));

					if ($text === '' && $url !== '') {
						$text = preg_replace('#^https?://#i', '', $url);
						$text = rtrim($text, '/');
					}

					if ($text === '' && $url === '') continue;
				?>
						<?php if ($url !== '') : ?>
							<a class="footer-copyright__link" href="<?php echo esc_url($url); ?>">
								<?php echo esc_html($text); ?>
							</a>
						<?php else : ?>
							<span class="footer-copyright__text">
								<?php echo esc_html($text); ?>
							</span>
						<?php endif; ?>
					
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</footer>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>