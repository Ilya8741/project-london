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
			$start_text  = get_field('start_project_button', 'footer_options');
			$start_form  = get_field('start_project_form', 'footer_options', false);
			$footer_start_id = 'footer-start-modal';
			?>

				<?php if ($start_text): ?>
				<button type="button"
					class="footer-white-main-button main-button"
					data-modal="#<?php echo esc_attr($footer_start_id); ?>">
					<span><?php echo esc_html($start_text); ?></span>
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
						<path d="M1 1H13V13" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
						<path d="M1 13L13 1" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
					</svg>
				</button>

				<div id="<?php echo esc_attr($footer_start_id); ?>" class="team-modal-template contact-team-modal-template" hidden>
					<div class="team-modal__inner">
						<div class="team-modal__text">
							<h3 class="team-modal__title">Start a project</h3>
							<?php if ($start_form): ?>
								<div class="team-modal__content contact-team-modal__content">
									<?php echo do_shortcode(shortcode_unautop($start_form)); ?>
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
(function () {
  const TAG='[IG center]';
  const log=(...a)=>console.log(TAG, ...a);
  const warn=(...a)=>console.warn(TAG, ...a);

  // ===== helpers =====
  function waitFor(cond, {timeout=12000, step=100}={}) {
    return new Promise((resolve, reject)=>{
      const t0=Date.now();
      (function tick(){
        if (cond()) return resolve(true);
        if (Date.now()-t0>timeout) return reject(new Error('timeout'));
        setTimeout(tick, step);
      })();
    });
  }

  // точная формула stagePadding для 2.3 слайда при items:2
  // f=0.3 видимой части третьего слайда: P = f/(2*(1+f)) * (W + margin)
  function calcStagePadding(containerEl, marginPx){
    const W = (containerEl && containerEl.clientWidth) || window.innerWidth || 0;
    const m = +marginPx || 0;
    const f = 0.3;
    const P = (f/(2*(1+f))) * (W + m); // ≈ 0.11538*(W+m)
    return Math.max(0, Math.round(P));
  }

  // аккуратный снап активного к центру (только на десктопе)
  function snapToCenter($owl, speed=0){
    const inst = $owl.data('owl.carousel');
    if (!inst || !inst.options.center) return; // снапим ТОЛЬКО когда center включён
    const $act = $owl.find('.sbi-owl-item.active');
    if (!$act.length) return;
    const mid = Math.floor($act.length/2);
    const idx = jQuery($act.get(mid)).index();
    $owl.trigger('to.owl.carousel', [idx, speed, true]);
  }

  // подписки/отписки обработчиков в зависимости от режима
  function bindDesktopHandlers($owl){
    if ($owl.data('ig-bound-desktop')) return;
    unbindMobileHandlers($owl);
    $owl.data('ig-bound-desktop', 1);

    let t=0;
    $owl.on('changed.owl.carousel.igcenter', ()=>{
      clearTimeout(t);
      t = setTimeout(()=> snapToCenter($owl, 380), 16);
    });
    $owl.on('refreshed.owl.carousel.igcenter resized.owl.carousel.igcenter', ()=> snapToCenter($owl, 0));
  }
  function unbindDesktopHandlers($owl){
    if (!$owl.data('ig-bound-desktop')) return;
    $owl.off('.igcenter');
    $owl.removeData('ig-bound-desktop');
  }

  function bindMobileHandlers($owl){
    if ($owl.data('ig-bound-mobile')) return;
    unbindDesktopHandlers($owl);
    $owl.data('ig-bound-mobile', 1);
    // На мобиле ничего не снапим — «1 свайп = 1 шаг», без автоскроллов.
    // Оставляем нативное поведение Owl.
  }
  function unbindMobileHandlers($owl){
    if (!$owl.data('ig-bound-mobile')) return;
    $owl.off('.igmobile'); // вдруг что-то навешивали — снимаем
    $owl.removeData('ig-bound-mobile');
  }

  // применяем режим без destroy/init
  function applyMode(feed, {force=false}={}){
    const $ = jQuery;
    const $owl = $(feed);
    const inst = $owl.data('owl.carousel');
    if (!inst) return false;

    // не гоняем настройки в цикле
    if ($owl.data('ig-centering-inprogress')) return false;
    $owl.data('ig-centering-inprogress', 1);

    // базовые плавные скорости (не трогаем, если уже заданы)
    inst.options.smartSpeed    = inst.options.smartSpeed    ?? 450;
    inst.options.dragEndSpeed  = inst.options.dragEndSpeed  ?? 420;
    inst.options.autoplaySpeed = inst.options.autoplaySpeed ?? 450;

    const margin = inst.options.margin || 0;
    const mobile = window.innerWidth <= 600;
    const prevMode = $owl.data('ig-mode');
    if (!force && prevMode === (mobile ? 'm' : 'd')) {
      $owl.data('ig-centering-inprogress', 0);
      return true;
    }

    if (mobile) {
      // === MOBILE MODE ===
      inst.options.center = false;       // убрать центральный слайд
      inst.options.slideBy = 1;          // 1 свайп = 1 шаг
      inst.options.autoplay = false;     // исключаем «разгон»
      inst.options.autoplayHoverPause = true;
      inst.options.freeDrag = false;     // без инерции на произвольное расстояние
      inst.options.pullDrag = true;
      // responsive: явно фиксируем, чтобы плагин не вернул center назад
      inst.options.responsive = inst.options.responsive || {};
      inst.options.responsive[0]   = Object.assign({}, inst.options.responsive[0],   { items:2, center:false, slideBy:1 });
      inst.options.responsive[600] = Object.assign({}, inst.options.responsive[600], { center:true });

      // точный padding под 2.3 слайда
      const pad = calcStagePadding(feed, margin);
      if (inst.options.stagePadding !== pad) inst.options.stagePadding = pad;

      // одно обновление
      $owl.trigger('refresh.owl.carousel');

      // бинды только мобильные (фактически — ничего не делаем, главное снять десктопные)
      bindMobileHandlers($owl);
    } else {
      // === DESKTOP MODE ===
      inst.options.center = true;        // держим центральный
      inst.options.slideBy = 1;
      inst.options.stagePadding = 0;
      // autoplay — оставляем как было (если был включён темой), мы его не навязываем
      // применим responsive, чтобы при переходе обратно мобила выключала center
      inst.options.responsive = inst.options.responsive || {};
      inst.options.responsive[0]   = Object.assign({}, inst.options.responsive[0],   { items:2, center:false, slideBy:1 });
      inst.options.responsive[600] = Object.assign({}, inst.options.responsive[600], { center:true });

      $owl.trigger('refresh.owl.carousel');
      setTimeout(()=> snapToCenter($owl, 380), 30);

      // бинды для десктопа (снап после changed/resize)
      bindDesktopHandlers($owl);
    }

    $owl.data('ig-mode', mobile ? 'm' : 'd');
    $owl.data('ig-centering-inprogress', 0);
    return true;
  }

  async function setupOn(node){
    try {
      await waitFor(()=> window.jQuery && jQuery.fn && jQuery.fn.sbiOwlCarousel);
    } catch(e){ warn('sbiOwlCarousel not ready'); return; }

    const feeds = (node.querySelectorAll ? node.querySelectorAll('#sbi_images.sbi_carousel') : []);
    if (!feeds.length) return;

    for (const feed of feeds) {
      try { await waitFor(()=> feed.classList.contains('sbi-owl-loaded'), {timeout: 8000}); } catch(e){}
      applyMode(feed, {force:true});
    }
  }

  // старт
  setupOn(document);

  // только появление готового фида
  const mo = new MutationObserver(muts=>{
    for (const m of muts){
      if (m.type !== 'childList') continue;
      m.addedNodes.forEach(node=>{
        if (!(node instanceof Element)) return;
        if (node.matches && node.matches('#sbi_images.sbi_carousel.sbi-owl-loaded')) {
          setupOn(node.parentNode || document);
        } else {
          const inner = node.querySelector && node.querySelector('#sbi_images.sbi_carousel.sbi-owl-loaded');
          if (inner) setupOn(node);
        }
      });
    }
  });
  mo.observe(document.body, {subtree:true, childList:true});

  // debounce resize — переключаем режим только при реальном переходе
  (function bindResize(){
    let raf = 0;
    window.addEventListener('resize', ()=>{
      cancelAnimationFrame(raf);
      raf = requestAnimationFrame(()=>{
        document.querySelectorAll('#sbi_images.sbi_carousel.sbi-owl-loaded')
          .forEach(el => applyMode(el));
      });
    });
  })();

  log('ready');
})();
</script>


<script>
/**
 * GLOBAL modal manager for any section
 * - Opens templates by [data-modal="#id"] into the nearest .team-modal within the same section/page part
 * - Re-inits CF7 on mount
 * - Normalizes file inputs (unique id/for, meta, size/type checks)
 * - Keeps focus trapped; supports close on overlay / [data-close] / Esc
 * - Restores last-opened modal after CF7 AJAX submit (sessionStorage)
 */

(function () {
  // ---------- Utilities ----------
  const html = document.documentElement;
  const STORAGE_KEY = 'globalModalToReopen';

  function closestContainerWithModal(fromEl) {
    let el = fromEl;
    while (el && el !== document) {
      if (el.querySelector && el.querySelector('.team-modal')) return el;
      el = el.parentElement;
    }
    return document;
  }

  function getModalParts(container) {
    const modal = container.querySelector('.team-modal');
    if (!modal) return {};
    const mount = modal.querySelector('.team-modal__mount');
    const overlay = modal.querySelector('.team-modal__overlay');
    const dialog = modal.querySelector('.team-modal__dialog');
    return { modal, mount, overlay, dialog };
  }

  function ensureId(el, prefix) {
    if (!el) return null;
    if (!el.id) {
      el.id = prefix + '-' + Date.now() + '-' + Math.random().toString(36).slice(2, 8);
    }
    return el.id;
  }

  // ---------- Submit button decorator (input->button) ----------
  function decorateSubmitButtons(scope) {
    const buttons = scope.querySelectorAll('.wpcf7-submit.contact-form-button');
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
  }

  // ---------- CF7 re-init ----------
  function initCF7(scope) {
    try {
      const forms = scope.querySelectorAll('.wpcf7 form');
      if (!forms.length) return;
      if (window.wpcf7?.init) {
        forms.forEach(f => window.wpcf7.init(f));
      } else if (window.wpcf7?.initForm) {
        forms.forEach(f => window.wpcf7.initForm(f));
      }
    } catch (_) {}
  }

  const FileDrop = (function () {
    function fmtMB(bytes) { return (bytes / (1024 * 1024)).toFixed(2) + ' MB'; }

    function ensureMeta(wrap) {
      let meta = wrap.querySelector('.file-drop__meta');
      if (!meta) {
        meta = document.createElement('div');
        meta.className = 'file-drop__meta';
        meta.setAttribute('aria-live', 'polite');
        wrap.appendChild(meta);
      }
      return meta;
    }

    function renderFileMeta(wrap, file) {
      const meta = ensureMeta(wrap);
      const labelText = wrap.querySelector('.file-drop__text');
      if (file) {
        const name = file.name || '';
        const size = Number.isFinite(file.size) ? fmtMB(file.size) : '';
        const out  = size ? (name + ' • ' + size) : name;
        meta.textContent = out;
        wrap.classList.add('has-file');
        if (labelText) labelText.style.visibility = 'hidden';
      } else {
        meta.textContent = '';
        wrap.classList.remove('has-file');
        if (labelText) labelText.style.visibility = '';
      }
    }

    function markError(wrap, msg) {
      wrap.classList.add('file-drop--error');
      const meta = ensureMeta(wrap);
      if (msg) meta.textContent = msg;
    }
    function clearError(wrap) { wrap.classList.remove('file-drop--error'); }

    let uid = 0;
    function ensureUniqueIdForInput(wrap) {
      const input = wrap.querySelector('input[type="file"]');
      const label = wrap.querySelector('label.file-drop__label');
      if (!input || !label) return;

      if (!input.id || document.querySelectorAll('#' + CSS.escape(input.id)).length > 1) {
        input.id = 'file-input-' + Date.now() + '-' + (uid++);
      }
      if (label.getAttribute('for') !== input.id) {
        label.setAttribute('for', input.id);
      }
    }

    function initWrap(wrap) {
      ensureUniqueIdForInput(wrap);
      const input = wrap.querySelector('input[type="file"]');
      if (!input) return;

      renderFileMeta(wrap, input.files && input.files[0] ? input.files[0] : null);

      function validateAndRender() {
        clearError(wrap);
        const f = input.files && input.files[0];
        if (!f) { renderFileMeta(wrap, null); return; }

        const maxMB = parseFloat(wrap.getAttribute('data-max') || '0');
        if (maxMB > 0 && Number.isFinite(f.size)) {
          const sizeMB = f.size / (1024 * 1024);
          if (sizeMB > maxMB) {
            markError(wrap, `File is too large (${fmtMB(f.size)}), max ${maxMB} MB`);
            try { input.value = ''; } catch(_) {}
            renderFileMeta(wrap, null);
            return;
          }
        }

        const accept = (input.getAttribute('accept') || '').trim();
        if (accept) {
          const ok = accept.split(',').map(s => s.trim()).some(rule => {
            if (!rule) return true;
            if (rule.endsWith('/*')) {
              const prefix = rule.slice(0, -1);
              return (f.type || '').startsWith(prefix);
            }
            return (f.type || '') === rule;
          });
          if (!ok) {
            markError(wrap, `File type not allowed (${f.type || 'unknown'})`);
            try { input.value = ''; } catch(_) {}
            renderFileMeta(wrap, null);
            return;
          }
        }

        renderFileMeta(wrap, f);
      }

      input.addEventListener('change', validateAndRender, true);
      input.addEventListener('input',  validateAndRender, true);
    }

    function sanitizeAllTemplates(scope) {
      scope.querySelectorAll('.team-modal-template input[type="file"]').forEach(inp => {
        if (inp.id) inp.removeAttribute('id');
        const lbl = inp.closest('.file-drop')?.querySelector('label.file-drop__label[for]');
        if (lbl) lbl.removeAttribute('for');
      });
    }

    function initScope(scope) {
      sanitizeAllTemplates(scope);
      scope.querySelectorAll('.file-drop').forEach(initWrap);
    }

    return { initScope };
  })();

  // ---------- Focus trap ----------
  function trapFocus(modal) {
    const focusables = () => modal.querySelectorAll('a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])');
    modal.__lastFocused = document.activeElement;

    function onTab(e) {
      if (e.key !== 'Tab') return;
      const list = Array.from(focusables()).filter(el => !el.hasAttribute('disabled'));
      if (!list.length) return;
      const first = list[0];
      const last  = list[list.length - 1];
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    }

    const listNow = Array.from(focusables()).filter(el => !el.hasAttribute('disabled'));
    if (listNow.length) listNow[0].focus();

    modal.addEventListener('keydown', onTab);
    modal.__onTabHandler = onTab;
  }

  function releaseFocus(modal) {
    if (modal.__onTabHandler) {
      modal.removeEventListener('keydown', modal.__onTabHandler);
      modal.__onTabHandler = null;
    }
    if (modal.__lastFocused && document.contains(modal.__lastFocused)) {
      modal.__lastFocused.focus();
    }
  }

  // ---------- Open/Close ----------
  function afterMount(container, selector) {
    const { modal, mount, dialog } = getModalParts(container);
    if (!modal || !mount) return;

    const title = mount.querySelector('.team-modal__title');
    if (title && dialog) {
      const titleId = ensureId(title, 'team-modal-title');
      dialog.setAttribute('aria-labelledby', titleId);
    }

    initCF7(mount);
    decorateSubmitButtons(mount);

    FileDrop.initScope(mount);

    const ev = new CustomEvent('team-modal:mounted', { detail: { mount } });
    document.dispatchEvent(ev);

    modal.dataset.origin = selector;

    trapFocus(modal);
  }

  function openModalFromTemplate(container, selector, trigger) {
    const { modal, mount } = getModalParts(container);
    if (!modal || !mount) return;
    const tpl = container.querySelector(selector) || document.querySelector(selector);
    if (!tpl) return;

    const wasOpen = modal.classList.contains('is-open');

    mount.innerHTML = tpl.innerHTML;
    if (!wasOpen) {
      modal.classList.add('is-open');
      modal.setAttribute('aria-hidden', 'false');
      html.classList.add('is-locked');
    }

    if (modal.__currentTrigger) modal.__currentTrigger.setAttribute('aria-expanded', 'false');
    modal.__currentTrigger = trigger || null;
    if (modal.__currentTrigger) modal.__currentTrigger.setAttribute('aria-expanded', 'true');

    afterMount(container, selector);
  }

  function closeModal(container) {
    const { modal, mount } = getModalParts(container);
    if (!modal || !mount) return;

    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    html.classList.remove('is-locked');
    mount.innerHTML = '';

    if (modal.__currentTrigger) {
      modal.__currentTrigger.setAttribute('aria-expanded', 'false');
      modal.__currentTrigger = null;
    }
    delete modal.dataset.origin;

    releaseFocus(modal);
  }

  // ---------- Global delegates ----------
  document.addEventListener('click', function (e) {
    const trigger = e.target.closest('[data-modal]');
    if (!trigger) return;

	if (trigger.hasAttribute('data-modal-local')) return;

    const selector = trigger.getAttribute('data-modal');
    if (!selector) return;

    const container = closestContainerWithModal(trigger);
    const { modal, overlay } = getModalParts(container);
    if (!modal) return;

    e.preventDefault();
    openModalFromTemplate(container, selector, trigger);

    if (!modal.__boundClose) {
      modal.__boundClose = true;

      // overlay click
      overlay && overlay.addEventListener('click', () => closeModal(container));

      // buttons with [data-close]
      modal.addEventListener('click', (evt) => {
        if (evt.target.hasAttribute('data-close') || evt.target.closest('[data-close]')) {
          closeModal(container);
        }
      });

      // Esc
      document.addEventListener('keydown', (evt) => {
        if (evt.key === 'Escape' && modal.classList.contains('is-open')) {
          closeModal(container);
        }
      });
    }
  });

  function initGlobal() {
    FileDrop.initScope(document);
    decorateSubmitButtons(document);
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initGlobal);
  } else {
    initGlobal();
  }

  // ---------- Restore modal after CF7 submit ----------

  document.addEventListener('submit', function (e) {
    const form = e.target.closest('.wpcf7 form');
    if (!form) return;

    const container = closestContainerWithModal(form);
    const { modal } = getModalParts(container);
    const modalId = ensureId(modal, 'team-modal');

    let selector = modal?.dataset?.origin || '';
    if (!selector) {
      const tpl = form.closest('.team-modal-template[id]');
      if (tpl) selector = '#' + tpl.id;
    }
    if (!selector) return;

    try {
      sessionStorage.setItem(STORAGE_KEY, JSON.stringify({ modalId, selector }));
    } catch (_) {}
  }, true);

  ['wpcf7mailsent','wpcf7invalid','wpcf7mailfailed'].forEach(evtName => {
    document.addEventListener(evtName, function (e) {
      const wrap = e.target; // .wpcf7
      if (!wrap) return;

      const container = closestContainerWithModal(wrap);
      const { modal } = getModalParts(container);
      if (!modal) return;

      if (modal.classList.contains('is-open')) return;

      const raw = sessionStorage.getItem(STORAGE_KEY);
      if (!raw) return;
      try {
        const data = JSON.parse(raw);
        if (!data || !data.selector) return;
        if (data.modalId && modal.id && data.modalId !== modal.id) return;

        openModalFromTemplate(container, data.selector);
      } catch (_) {}
    });
  });

  function restoreFromStorageOnLoad() {
    const raw = sessionStorage.getItem(STORAGE_KEY);
    if (!raw) return;
    try {
      const { modalId, selector } = JSON.parse(raw) || {};
      if (!selector) return;
      const modal = modalId ? document.getElementById(modalId) : document.querySelector('.team-modal');
      if (!modal) return;
      const container = modal.closest('[class]') || document;
      openModalFromTemplate(container, selector);
    } catch (_) {}
    sessionStorage.removeItem(STORAGE_KEY);
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', restoreFromStorageOnLoad);
  } else {
    restoreFromStorageOnLoad();
  }
})();
</script>
<script>
(function(){
  var isHome = document.body.classList.contains('home');
  try {
    var seen = sessionStorage.getItem('pl_seen') === '1' || localStorage.getItem('pl_seen') === '1';
    if (!isHome && !seen) {
      sessionStorage.setItem('pl_seen','1');
      localStorage.setItem('pl_seen','1');
    }
  } catch(e) {}
})();
</script>



</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>