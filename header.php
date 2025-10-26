<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package project-london
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php
$pl_enabled  = get_field('preloader_enable',  'header_options');
$pl_duration = (int) get_field('preloader_duration', 'header_options') ?: 3000;
$pl_text     = get_field('preloader_text',    'header_options') ?: 'Architecture · Interior design · Project management';
$pl_logo     = get_field('preloader_logo',    'header_options');
$dark_logo   = get_field('dark_logo',         'header_options');

if ( is_front_page() && $pl_enabled ): ?>
  <div id="pl-overlay" class="pl-overlay" data-duration="<?php echo esc_attr($pl_duration); ?>">
    <div class="pl-center">
      <div class="pl-logo-wrap">
        <?php
          $logo = $pl_logo ?: $dark_logo;
          if ($logo) {
            echo wp_get_attachment_image($logo['ID'], 'full', false, ['class' => 'pl-logo', 'alt' => esc_attr($logo['alt'] ?? '')]);
          }
        ?>
        <svg class="pl-ring" viewBox="0 0 120 120" aria-hidden="true">
          <circle class="pl-ring__bg" cx="60" cy="60" r="54" />
          <circle class="pl-ring__fg" cx="60" cy="60" r="54" />
        </svg>
      </div>
      <p class="pl-text"><?php echo esc_html($pl_text); ?></p>
    </div>
  </div>

  <script>
function ensureStartAtTop(onlyHome=true){
  if(onlyHome && !document.body.classList.contains('home')) return;
  try{ if('scrollRestoration' in history){ history.scrollRestoration='manual'; } }catch(e){}
  window.scrollTo(0,0);
  window.addEventListener('pageshow', function(e){ if(e.persisted) window.scrollTo(0,0); });
  window.addEventListener('beforeunload', function(){ window.scrollTo(0,0); });
}
ensureStartAtTop(true);
</script>

<script>
(function () {
  var d  = document;
  var ov = d.getElementById('pl-overlay');
  if (!ov) return;

  if ('scrollRestoration' in history) { history.scrollRestoration = 'manual'; }
  window.scrollTo(0, 0);
  window.addEventListener('pageshow', function(e) { if (e.persisted) window.scrollTo(0, 0); });

  var dur = parseInt(ov.getAttribute('data-duration') || '3000', 10);
  ov.style.setProperty('--pl-dur', dur + 'ms');

  d.documentElement.classList.add('pl-lock');
  d.body.classList.add('pl-lock');

  function setHeroVars() {
    var section = d.querySelector('.hero-section');
    var wrap    = d.querySelector('.hero-section-image-wrapper');
    if (!section || !wrap) return;
    var sectionTop = section.getBoundingClientRect().top + window.scrollY;
    var wrapTop    = wrap.getBoundingClientRect().top + window.scrollY;
    var shift      = Math.max(0, Math.round(wrapTop - sectionTop));
    d.documentElement.style.setProperty('--hero-video-shift', shift + 'px');
  }

  setHeroVars();
  window.addEventListener('resize', setHeroVars);

  function getTransitionMs(el) {
    try {
      var cs = getComputedStyle(el);
      var td = (cs.transitionDuration || '0s').split(',')[0].trim();
      return td.endsWith('ms') ? parseFloat(td) : parseFloat(td) * 1000;
    } catch (e) { return 300; }
  }

  function animateHeroVideoReturn() {
    var wrap  = d.querySelector('.hero-section-image-wrapper');
    var video = wrap ? wrap.querySelector('video') : null;
    if (!wrap || !video) {
      d.body.classList.remove('hero-video-top');
      return;
    }

    var startWrapH  = wrap.getBoundingClientRect().height;
    var startVideoH = video.getBoundingClientRect().height;

    d.body.classList.remove('hero-video-top');

    var endWrapH = wrap.getBoundingClientRect().height;

    wrap.style.height  = startWrapH + 'px';
    video.style.height = startVideoH + 'px';
    void wrap.offsetHeight;

    wrap.style.height = endWrapH + 'px';

    var onEnd = function(e){
      if (e.propertyName === 'height') {
        wrap.style.height = '';
        video.style.height = '';
        wrap.removeEventListener('transitionend', onEnd);
      }
    };
    wrap.addEventListener('transitionend', onEnd);
  }

  setTimeout(function () {
    var fadeMs = getTransitionMs(ov) || 300;

    d.body.classList.add('hero-reveal');

    setHeroVars();
    d.body.classList.add('hero-video-top');

    setTimeout(animateHeroVideoReturn, 2000);

    ov.classList.add('is-done');

    setTimeout(function () {
      d.documentElement.classList.remove('pl-lock');
      d.body.classList.remove('pl-lock');
      ov.remove();
    }, fadeMs + 50);

  }, dur);
})();
</script>

<?php endif; ?>

	<div id="page" class="site">

		<header id="masthead" class="site-header">
			<div class="site-header-wrapper">
				<div class="site-header-wrapper-main">

				<?php if ($image = get_field('logo', 'header_options')) : ?>
					<a href="/">
					<?php
					echo wp_get_attachment_image(
						$image['ID'],
						'full',
						false,
						[
							'class' => 'header-main-logo',
							'alt'   => esc_attr($image['alt'] ?? '')
						]
					);
					?>
					
					</a>
				<?php endif; ?>
				<?php if ($image1 = get_field('dark_logo', 'header_options')) : ?>
					<a href="/">
					<?php
					echo wp_get_attachment_image(
						$image1['ID'],
						'full',
						false,
						[
							'class' => 'header-dark-logo',
							'alt'   => esc_attr($image1['alt'] ?? ''),
						]
					);
					?>
					</a>
				<?php endif; ?>
				<button class="header-open">
					<div class="header-open-line">
					</div>
					<div class="header-open-line">
					</div>
				</button>
				</div>
			</div>
			<div class="header-burger-menu">
				<div class="header-burger-menu-wrapper">

					<?php
					$main_image = get_field('mega_menu_image', 'header_options'); // Image
					?>

					<div class="hb-grid">
						<div class="hb-media">
							<?php if ($main_image): ?>
								<img
									id="hb-img-0"
									class="hb-media__img is-active"
									src="<?php echo esc_url($main_image['url']); ?>"
									alt="<?php echo esc_attr($main_image['alt'] ?? ''); ?>"
									loading="lazy" />
							<?php endif; ?>

							<?php
							if (have_rows('header_menu', 'header_options')):
								$i = 1;
								while (have_rows('header_menu', 'header_options')): the_row();
									$img = get_sub_field('image'); // Image
									if ($img): ?>
										<img
											id="hb-img-<?php echo esc_attr($i); ?>"
											class="hb-media__img"
											src="<?php echo esc_url($img['url']); ?>"
											alt="<?php echo esc_attr($img['alt'] ?? ''); ?>"
											loading="lazy" />
							<?php
										$i++;
									endif;
								endwhile;
								reset_rows();
							endif;
							?>
						</div>

						<div class="hb-side">
							<div class="hb-menu-with-img">
								<?php if (have_rows('header_menu', 'header_options')): ?>
									<nav class="hb-menu" aria-label="Header menu">
										<div class="hb-menu__list">
											<?php
											$i = 1;
											while (have_rows('header_menu', 'header_options')): the_row();
												$link = get_sub_field('link'); // Link
												$img_id_attr = 'hb-img-' . $i;
												$has_image   = get_sub_field('image');
												if (!$has_image) {
													$img_id_attr = 'hb-img-0';
												}

												if ($link && !empty($link['url'])): ?>
														<a
															class="hb-menu__link"
															href="<?php echo esc_url($link['url']); ?>"
															target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
															data-img-id="<?php echo esc_attr($img_id_attr); ?>">
															<?php echo esc_html($link['title'] ?: ''); ?>
															<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
																<path d="M1 1H17.4571V17" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
																<path d="M1 17L17.4571 1" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
															</svg>
														</a>
											<?php endif;
												$i++;
											endwhile; ?>
										</div>
									</nav>
								<?php endif; ?>
							
							</div>
							<div class="info-with-button">

							
							<?php if (have_rows('header_info', 'header_options')): ?>
								<div class="hb-info">
									<ul class="hb-info__list">
										<?php while (have_rows('header_info', 'header_options')): the_row();
											$info_link = get_sub_field('info_link'); // Link
											if ($info_link && !empty($info_link['url'])): ?>
												<li class="hb-info__item">
													<a
														class="hb-info__link"
														href="<?php echo esc_url($info_link['url']); ?>"
														target="<?php echo esc_attr($info_link['target'] ?: '_self'); ?>">
														<?php echo esc_html($info_link['title'] ?: ''); ?>
													</a>
												</li>
										<?php endif;
										endwhile; ?>
									</ul>
								</div>
							<?php endif; ?>

							<?php
							$btn_url  = get_field('word_button_url',  'header_options');
							$btn_text = get_field('work_button_text', 'header_options');
							if ($btn_text): ?>
								<a class="main-button header-work-button" href="<?php echo esc_url($btn_url); ?>">
									<span><?php echo esc_html($btn_text); ?></span>
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
										<path d="M1 1H13V13" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
										<path d="M1 13L13 1" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
									</svg>
								</a>
							<?php endif; ?>
							</div>
						</div>
					</div>

				</div>
			</div>

		</header>
<script>
(function () {
  var header = document.querySelector('.site-header-wrapper-main');
  if (!header) return;

  var DARK_SELECTOR = '[data-theme="dark"], .bg-dark, .section--dark';

  function isHeaderOverDarkByTop() {
    var hb = header.getBoundingClientRect();
    var sampleY = Math.max(0, Math.round(hb.top + 20)); 

    var darks = document.querySelectorAll(DARK_SELECTOR);
    for (var i = 0; i < darks.length; i++) {
      var r = darks[i].getBoundingClientRect();
      if (r.top <= sampleY && r.bottom >= sampleY) return true;
    }
    return false;
  }

  var ticking = false;
  function update() {
    ticking = false;
    header.classList.toggle('on-dark', isHeaderOverDarkByTop());
  }

  function onScroll() {
    if (!ticking) {
      ticking = true;
      requestAnimationFrame(update);
    }
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onScroll);
  document.addEventListener('DOMContentLoaded', update);
  update();
})();
</script>
