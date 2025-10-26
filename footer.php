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
			<div class="site-footer-header-links-wrapper">
				<?php if ($image1 = get_field('footer_image1', 'footer_options')) : ?>
					<?php if ($image_link1 = get_field('footer_image_link1', 'footer_options')) : ?>
						<a href="<?php echo esc_html($image_link1); ?>" target="_blank">
							<?php
							echo wp_get_attachment_image(
								$image1['ID'],
								'full',
								false,
								[
									'class' => 'footer-main-image',
									'alt'   => esc_attr($image1['alt'] ?? ''),
								]
							);
							?>
						</a>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ($image2 = get_field('footer_image2', 'footer_options')) : ?>
					<?php if ($image_link2 = get_field('footer_image_link2', 'footer_options')) : ?>
						<a href="<?php echo esc_html($image_link2); ?>" target="_blank">
							<?php
							echo wp_get_attachment_image(
								$image2['ID'],
								'full',
								false,
								[
									'class' => 'footer-main-image',
									'alt'   => esc_attr($image2['alt'] ?? ''),
								]
							);
							?>
						</a>
					<?php endif; ?>
				<?php endif; ?>
			</div>


		</div>

		<div class="footer-buttons">
			<?php
			$work_text  = get_field('work_button_text', 'footer_options');
			$work_title = get_field('footer_popup_title', 'footer_options');
			$work_form  = get_field('footer_contact_form', 'footer_options', false);
			$footer_tpl_id = 'footer-contact-modal';
			?>

			<?php if ($work_text): ?>
				<button type="button"
					class="footer-white-main-button main-button"
					data-modal="#<?php echo esc_attr($footer_tpl_id); ?>">
					<span><?php echo esc_html($work_text); ?></span>
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
						<path d="M1 1H13V13" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
						<path d="M1 13L13 1" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
					</svg>
				</button>

				<div id="<?php echo esc_attr($footer_tpl_id); ?>" class="team-modal-template contact-team-modal-template" hidden>
					<div class="team-modal__inner">
						<div class="team-modal__text">
							<?php if ($work_title): ?>
								<h3 class="team-modal__title"><?php echo esc_html($work_title); ?></h3>
							<?php endif; ?>
							<?php if ($work_form): ?>
								<div class="team-modal__content contact-team-modal__content">
									<?php echo do_shortcode(shortcode_unautop($work_form)); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php
			$sub_text = get_field('subscribe_button_text', 'footer_options') ?: 'Subscribe';
			$sub_url  = get_field('subscribe_button_url', 'footer_options');
			$default_url = 'https://projectlondon.us8.list-manage.com/subscribe?u=ca0f0110a4a4b3a9a3ee89dee&id=9e0d6a222e';
			?>

			<a href="<?php echo esc_url($sub_url ?: $default_url); ?>"
				class="footer-black-main-button main-button"
				target="_blank" rel="noopener">
				<span><?php echo esc_html($sub_text); ?></span>
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
					<path d="M1 1H13V13" stroke="white" stroke-width="0.5" stroke-linejoin="round" />
					<path d="M1 13L13 1" stroke="white" stroke-width="0.5" stroke-linejoin="round" />
				</svg>
			</a>

		</div>
		<div class="footer-info">
			<div class="footer-info-richtext">
				<?php if ($html = get_field('footer_info', 'footer_options')) : ?>
					<div class="footer-wysiwyg">
						<?php echo wp_kses_post($html); ?>
					</div>
				<?php endif; ?>

				<?php if (have_rows('footer_social_icons', 'footer_options')) : ?>
					<div class="footer-socials">
						<?php while (have_rows('footer_social_icons', 'footer_options')) : the_row();
							$img = get_sub_field('icon');
							$url = (string) get_sub_field('icon_url');
							if (empty($img) || empty($img['ID'])) continue;

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
								<?php if ($url !== '') : ?>
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
			<?php if (have_rows('footer_menu', 'footer_options')) : ?>
				<div class="footer-menu">
					<?php while (have_rows('footer_menu', 'footer_options')) : the_row();
						$link = get_sub_field('footer_link');
						$text = trim((string) get_sub_field('footer_link_text'));
						if (empty($link) || empty($link['url'])) continue;

						$label  = $text !== '' ? $text : ($link['title'] ?? '');
						$target = !empty($link['target']) ? ' target="_blank" rel="noopener"' : '';
					?>

						<a class="footer-menu__link" href="<?php echo esc_url($link['url']); ?>" <?php echo $target; ?>>
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
	<div class="team-modal footer-modal" aria-hidden="true">
		<div class="team-modal__overlay" data-close></div>
		<div class="team-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="footer-modal-title">
			<button class="team-modal__close" type="button" data-close aria-label="Close">
				<span aria-hidden="true" class="team-modal__close-button">
					<div class="team-modal__close-line"></div>
					<div class="team-modal__close-line"></div>
				</span>
			</button>
			<div class="team-modal__mount footer-team-modal__mount"></div>
		</div>
	</div>

</footer>

<script>
	(function() {
		const root = document.querySelector('.site-footer');
		if (!root) return;

		const modal = root.querySelector('.footer-modal');
		const mount = modal.querySelector('.team-modal__mount');
		const overlay = modal.querySelector('.team-modal__overlay');
		const closeBtns = modal.querySelectorAll('[data-close]');
		const html = document.documentElement;

		function openModalFromTemplate(selector, trigger) {
			const tpl = root.querySelector(selector);
			if (!tpl) return;
			mount.innerHTML = tpl.innerHTML;
			modal.classList.add('is-open');
			modal.setAttribute('aria-hidden', 'false');
			html.classList.add('is-locked');
			if (trigger) trigger.setAttribute('aria-expanded', 'true');
			const ev = new CustomEvent('team-modal:mounted', {
				detail: {
					mount
				}
			});
			document.dispatchEvent(ev);
			trapFocus(modal);
		}

		function closeModal() {
			modal.classList.remove('is-open');
			modal.setAttribute('aria-hidden', 'true');
			html.classList.remove('is-locked');
			mount.innerHTML = '';
			releaseFocus();
		}

		root.addEventListener('click', function(e) {
			const trigger = e.target.closest('[data-modal]');
			if (!trigger || !root.contains(trigger)) return;
			e.preventDefault();
			const sel = trigger.getAttribute('data-modal');
			if (sel) openModalFromTemplate(sel, trigger);
		});

		closeBtns.forEach(b => b.addEventListener('click', closeModal));
		overlay.addEventListener('click', closeModal);
		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
		});

		let lastFocused = null;

		function trapFocus(container) {
			lastFocused = document.activeElement;
			const focusables = container.querySelectorAll('a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])');
			if (focusables.length) focusables[0].focus();
			container.addEventListener('keydown', onTab);

			function onTab(e) {
				if (e.key !== 'Tab') return;
				const list = Array.from(focusables).filter(el => !el.hasAttribute('disabled'));
				if (!list.length) return;
				const first = list[0],
					last = list[list.length - 1];
				if (e.shiftKey && document.activeElement === first) {
					e.preventDefault();
					last.focus();
				} else if (!e.shiftKey && document.activeElement === last) {
					e.preventDefault();
					first.focus();
				}
			}
		}

		function releaseFocus() {
			if (lastFocused) lastFocused.focus();
		}
	})();

	document.addEventListener('DOMContentLoaded', function() {
		const buttons = document.querySelectorAll('.wpcf7-submit.contact-form-button');
		if (!buttons.length) return;

		buttons.forEach(btn => {
			if (btn.tagName.toLowerCase() !== 'input') return;
			const newBtn = document.createElement('button');
			newBtn.type = 'submit';
			newBtn.className = btn.className;
			newBtn.innerHTML =
				'<span>' + (btn.value || 'Submit') + '</span>' +
				'<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">' +
				'<path d="M1 1H13V13" stroke="white" stroke-width="0.5" stroke-linejoin="round"/>' +
				'<path d="M1 13L13 1" stroke="white" stroke-width="0.5" stroke-linejoin="round"/>' +
				'</svg>';
			btn.parentNode.replaceChild(newBtn, btn);
		});
	});
</script>


</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>