<div class="contact-page">
    <div class="contact-page-wrapper">
        <div class="contact-page-header">
            <h1 class="contact-page-title" data-aos="fade-right" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
                <?php the_sub_field('title'); ?>
            </h1>
            <div class="contact-page-text" data-aos="fade-left" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
                <?php the_sub_field('text'); ?>
            </div>

         <?php if (have_rows('contact_buttons')): ?>
  <div class="contact-buttons" data-aos="fade-right" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
    <?php $i = 0;
    while (have_rows('contact_buttons')): the_row();
      $i++;
      $button_text = get_sub_field('button_text');
      $popup_title = get_sub_field('popup_title');
      $popup_text = get_sub_field('popup_text');
      $contact_form = get_sub_field('contact_form', false, false);
      $button_link = get_sub_field('button_link'); // можно добавить ссылку в ACF, если нужно
      $tpl_id = 'contact-modal-' . $i;
    ?>

      <?php if ($popup_title): ?>
        <!-- Кнопка с модальным окном -->
        <button type="button" class="contact-button main-button" data-modal="#<?php echo esc_attr($tpl_id); ?>">
          <span><?php echo esc_html($button_text); ?></span>
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M1 1H13V13" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
            <path d="M1 13L13 1" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
          </svg>
        </button>

        <div id="<?php echo esc_attr($tpl_id); ?>" class="team-modal-template contact-team-modal-template" hidden>
          <div class="team-modal__inner">
            <div class="team-modal__text">
              <?php if ($popup_title): ?><h3 class="team-modal__title"><?php echo esc_html($popup_title); ?></h3><?php endif; ?>
              <?php if ($popup_text): ?><div class="team-modal__content"><?php echo wp_kses_post($popup_text); ?></div><?php endif; ?>
              <?php if ($contact_form): ?>
                <div class="team-modal__content contact-team-modal__content">
                  <?php
                  $contact_form_raw = get_sub_field('contact_form', false, false);
                  echo do_shortcode(shortcode_unautop($contact_form_raw));
                  ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

      <?php else: ?>
          <a href="mailto:team@eburycomms.com" class="contact-button-link main-button">
            <span><?php echo esc_html($button_text); ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
              <path d="M1 1H13V13" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
              <path d="M1 13L13 1" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
            </svg>
          </a>
      <?php endif; ?>

    <?php endwhile; ?>
  </div>
<?php endif; ?>


            <div class="team-modal" aria-hidden="true">
                <div class="team-modal__overlay" data-close></div>
                <div class="team-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="team-modal-title">
                    <button class="team-modal__close" type="button" data-close aria-label="Close">
                        <span aria-hidden="true" class="team-modal__close-button">
                            <div class="team-modal__close-line"></div>
                            <div class="team-modal__close-line"></div>
                        </span>
                    </button>
                    <div class="team-modal__mount contact-team-modal__mount"></div>
                </div>
            </div>
        </div>
        <div class="contact-page-info">
            <?php $image1 = get_sub_field('image'); ?>
            <?php if ($image1): ?>
                <div class="contact-page-media-wrapper" data-aos="fade-right" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
                    <img src="<?php echo esc_url($image1['url']); ?>" class="contact-page-info-image" alt="<?php echo esc_attr($image1['alt']); ?>">
                </div>
            <?php endif; ?>
            <div class="contact-page-info-block" data-aos="fade-left" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
                <?php if (have_rows('contact_info')): ?>
                    <ul class="hb-info__list contact-hb-info__list">
                        <?php while (have_rows('contact_info')): the_row();
                            $info_link = get_sub_field('link');
                            if ($info_link && !empty($info_link['url'])): ?>
                                <li class="hb-info__item contact-page-hb-info__item">
                                   <?php if ($info_link['url'] != '#'): ?>
                                    <a
                                        class="hb-info__link contact-page-hb-info__link"
                                        href="<?php echo esc_url($info_link['url']); ?>"
                                        target="<?php echo esc_attr($info_link['target'] ?: '_self'); ?>">
                                        <?php echo esc_html($info_link['title'] ?: ''); ?>
                                        <?php $get = get_sub_field('get_directions_url'); ?>
                                        <?php if ($get): ?>
                                            <a href="<?php echo esc_html($get); ?>" class="contact-page-get-link">
                                                Get directions
                                            </a>
                                        <?php endif; ?>
                                    </a>
                                    <?php else : ?>
                                       <p
                                        class="hb-info__link contact-page-hb-info__link">
                                        <?php echo esc_html($info_link['title'] ?: ''); ?>
                                        <?php $get = get_sub_field('get_directions_url'); ?>
                                        <?php if ($get): ?>
                                            <a href="<?php echo esc_html($get); ?>" class="contact-page-get-link">
                                                Get directions
                                            </a>
                                        <?php endif; ?>
                                    </p>
                                    <?php endif; ?>
                                </li>
                        <?php endif;
                        endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
  const root = document.querySelector('.contact-page');
  if (!root) return;

  const modal   = root.querySelector('.team-modal');
  const mount   = modal.querySelector('.team-modal__mount');
  const overlay = modal.querySelector('.team-modal__overlay');
  const closeBtns = modal.querySelectorAll('[data-close]');
  const html = document.documentElement;

  const STORAGE_KEY = 'contactModalToReopen';

  root.querySelectorAll('.contact-team-modal-template input[type="file"]').forEach((inp, i) => {
    if (inp.id) {
      console.log('[modal]', 'strip id in template:', inp.id);
      inp.removeAttribute('id');
    }
    const lbl = inp.closest('.file-drop')?.querySelector('label.file-drop__label[for]');
    if (lbl) lbl.removeAttribute('for');
  });

  function openModalFromTemplate(selector, trigger) {
    const tpl = root.querySelector(selector);
    if (!tpl) return;

    mount.innerHTML = tpl.innerHTML;
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    html.classList.add('is-locked');

    modal.dataset.origin = selector;
    if (trigger) trigger.setAttribute('aria-expanded', 'true');

    const ev = new CustomEvent('team-modal:mounted', { detail: { mount } });
    document.dispatchEvent(ev);

    trapFocus(modal);
  }

  function closeModal() {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    html.classList.remove('is-locked');
    mount.innerHTML = '';
    delete modal.dataset.origin;
    releaseFocus();
  }

  root.addEventListener('click', function(e) {
    const btn = e.target.closest('.contact-button');
    if (!btn) return;
    const sel = btn.getAttribute('data-modal');
    if (sel) openModalFromTemplate(sel, btn);
  });

  closeBtns.forEach(b => b.addEventListener('click', closeModal));
  overlay.addEventListener('click', closeModal);
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
  });

  let lastFocused = null;
  function trapFocus(container) {
    lastFocused = document.activeElement;
    const focusables = container.querySelectorAll(
      'a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])'
    );
    if (focusables.length) focusables[0].focus();
    container.addEventListener('keydown', onTab);
    function onTab(e) {
      if (e.key !== 'Tab') return;
      const list = Array.from(focusables).filter(el => !el.hasAttribute('disabled'));
      if (!list.length) return;
      const first = list[0], last = list[list.length - 1];
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    }
  }
  function releaseFocus() { if (lastFocused) lastFocused.focus(); }

  const pendingModal = sessionStorage.getItem(STORAGE_KEY);
  if (pendingModal) {
    setTimeout(() => {
      openModalFromTemplate(pendingModal);
      sessionStorage.removeItem(STORAGE_KEY);
    }, 0);
  }

  root.addEventListener('submit', function(e) {
    const form = e.target.closest('.wpcf7 form');
    if (!form) return;
    const isInsideModal = modal.classList.contains('is-open');
    const origin = modal.dataset.origin;
    if (isInsideModal && origin) {
      try { sessionStorage.setItem(STORAGE_KEY, origin); } catch (err) {}
    } else {
      const tpl = form.closest('.contact-team-modal-template[id]');
      if (tpl) {
        const sel = '#' + tpl.id;
        try { sessionStorage.setItem(STORAGE_KEY, sel); } catch (err) {}
      }
    }
  }, true); 

  ['wpcf7mailsent','wpcf7invalid','wpcf7mailfailed'].forEach(evtName => {
    document.addEventListener(evtName, function(e) {
      const formWrap = e.target;
      if (!formWrap || !formWrap.querySelector || !formWrap.querySelector('form')) return;
      if (modal.classList.contains('is-open')) return;

      if (mount.contains(formWrap)) {
        const origin = modal.dataset.origin;
        if (origin) { openModalFromTemplate(origin); return; }
      }
      const tpl = formWrap.closest('.contact-team-modal-template[id]');
      if (tpl) openModalFromTemplate('#' + tpl.id);
    });
  });
})();
</script>


<script>
(function () {
  if (window.__fileDropBound) return;
  window.__fileDropBound = true;

  const NS = '[file-drop]';

  function fmtMB(bytes) {
    return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
  }

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

  function forcePaintFrom(el) {
    const dialog = el.closest('.team-modal__dialog') || el.closest('.team-modal') || document.body;
    const prev = dialog.style.transform;
    dialog.style.willChange = 'transform';
    dialog.style.transform = 'translateZ(0)';
    void dialog.offsetHeight;
    dialog.style.transform = prev || '';
    dialog.style.willChange = '';
  }

  function renderFileMeta(wrap, file) {
    if (!wrap) return;
    const meta = ensureMeta(wrap);
    const labelText = wrap.querySelector('.file-drop__text');

    if (file) {
      const name = file.name || '';
      const size = Number.isFinite(file.size) ? fmtMB(file.size) : '';
      const out  = size ? (name + ' • ' + size) : name;
      meta.textContent = out;
      wrap.classList.add('has-file');
      if (labelText) labelText.style.visibility = 'hidden';
      forcePaintFrom(meta);
      requestAnimationFrame(() => { if (meta.textContent !== out) { meta.textContent = out; forcePaintFrom(meta); } });
      setTimeout(() => { if (meta.textContent !== out) { meta.textContent = out; forcePaintFrom(meta); } }, 60);
    } else {
      meta.textContent = '';
      wrap.classList.remove('has-file');
      if (labelText) labelText.style.visibility = '';
      forcePaintFrom(meta);
    }
  }

  function markError(wrap, msg) {
    wrap.classList.add('file-drop--error');
    const meta = ensureMeta(wrap);
    if (msg) meta.textContent = msg;
  }
  function clearError(wrap) {
    wrap.classList.remove('file-drop--error');
  }

  let uid = 0;
  function ensureUniqueIdForInput(wrap) {
    const input = wrap.querySelector('input[type="file"]');
    if (!input) return;

    const label = wrap.querySelector('label.file-drop__label');
    if (!label) return;

    let id = input.id;
    if (!id || document.querySelectorAll('#' + CSS.escape(id)).length > 1) {
      id = 'file-input-' + Date.now() + '-' + (uid++);
      console.log(NS, 'assign unique id:', id, { prevId: input.id });
      input.id = id;
    }
    if (label.getAttribute('for') !== id) {
      console.log(NS, 'sync label.for ->', id);
      label.setAttribute('for', id);
    }
  }

  function onChangeCapture(e) {
    const input = e.target;
    if (!(input instanceof HTMLInputElement)) return;
    if (input.type !== 'file') return;

    const wrap = input.closest('.file-drop');
    if (!wrap) return;

    console.log(NS, 'change/input fired', {
      inputId: input.id,
      filesLength: input.files ? input.files.length : 0,
      accept: input.getAttribute('accept') || null,
      required: input.required || input.classList.contains('wpcf7-validates-as-required')
    });

    clearError(wrap);

    if (input.files && input.files.length) {
      const file = input.files[0];

      const maxMB = parseFloat(wrap.getAttribute('data-max') || '0');
      if (maxMB > 0 && Number.isFinite(file.size)) {
        const sizeMB = file.size / (1024 * 1024);
        console.log(NS, 'size check', { sizeMB: sizeMB.toFixed(2), maxMB });
        if (sizeMB > maxMB) {
          markError(wrap, `File is too large (${fmtMB(file.size)}), max ${maxMB} MB`);
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
            return (file.type || '').startsWith(prefix);
          }
          return (file.type || '') === rule;
        });
        console.log(NS, 'accept check', { fileType: file.type, accept, ok });
        if (!ok) {
          markError(wrap, `File type not allowed (${file.type || 'unknown'})`);
          try { input.value = ''; } catch(_) {}
          renderFileMeta(wrap, null);
          return;
        }
      }

      renderFileMeta(wrap, file);
    } else {
      renderFileMeta(wrap, null);
    }
  }

  function initWrap(wrap) {
    ensureUniqueIdForInput(wrap);
    renderFileMeta(wrap, null);

    const input = wrap.querySelector('input[type="file"]');
    if (input && input.files && input.files.length) {
      renderFileMeta(wrap, input.files[0]);
    }

    console.log(NS, 'initialized wrap', {
      inputId: input ? input.id : null,
      hasLabel: !!wrap.querySelector('label.file-drop__label')
    });
  }

  function initScope(scope) {
    scope.querySelectorAll('.file-drop').forEach(initWrap);
  }

  function initGlobal() {
    document.addEventListener('change', onChangeCapture, true);
    document.addEventListener('input',  onChangeCapture, true);

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => initScope(document));
    } else {
      initScope(document);
    }

    document.addEventListener('team-modal:mounted', (e) => {
      const mount = e.detail?.mount || e.target;
      console.log(NS, 'team-modal:mounted -> initScope');
      initScope(mount);
      setTimeout(() => initScope(mount), 30);
    });
  }

  initGlobal();
})();
</script>
